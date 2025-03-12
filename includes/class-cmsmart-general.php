<?php
if (!defined('ABSPATH'))
    exit;

if (!class_exists('NBD_Cmsmart_General')) {

    class NBD_Cmsmart_General
    {
        protected static $instance;

        public static function instance()
        {
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        public function init()
        {
            if (is_admin()) {
                $this->admin_hook();
                $this->ajax();
            }

        }
        public function ajax()
        {
            $ajax_events = array(
                'printcart_generate_key_api' => true,
                'printcart_check_connection_dashboard' => true,
                'printcart_save_api_key' => true,
                'printcart_get_store' => true,
                'printcart_import_product' => true,
                'printcart_save_settings' => true,
            );
            foreach ($ajax_events as $ajax_event => $nopriv) {
                add_action('wp_ajax_' . $ajax_event, array($this, $ajax_event));
                if ($nopriv) {
                    add_action('wp_ajax_nopriv_' . $ajax_event, array($this, $ajax_event));
                }
            }
        }

        public function admin_hook()
        {
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 40, 1);
        }
        public function admin_enqueue_scripts($hook)
        {
            if ($hook == 'toplevel_page_nbdesigner') {
                $dimension_unit = nbdesigner_get_option('nbdesigner_dimensions_unit', 'cm');
                $default_font_subset = nbdesigner_get_option('nbdesigner_default_font_subset');
                $first_imported_product = nbdesigner_get_option('nbdesigner_cmsmart_first_imported_product');
                $create_your_own_page_id = nbd_get_page_id('create_your_own');
                $designer_page_id = nbd_get_page_id('designer');
                $gallery_page_id = nbd_get_page_id('gallery');
                $logged_page_id = nbd_get_page_id('logged');
                $user = wp_get_current_user();
                $user_email = $user->user_email;
                $user_name = ($user->user_firstname ? $user->user_firstname . ' ' : '') . $user->user_lastname;
                $name = $user->display_name ? $user->display_name : $user_name;
                $site_title = get_bloginfo();
                $home_url = home_url();
                $demo_data_path = NBDESIGNER_PLUGIN_DIR . 'data/demo_datas.json';
                $products = json_decode(file_get_contents($demo_data_path), true);
                $product_sample = array();
                foreach ($products as $key => $product) {
                    $templates = [];
                    if (isset($product['templates']) && !empty($product['templates'])) {
                        $templates_str = nbd_file_get_contents($product['templates']);
                        if ($templates_str) {
                            $templates = json_decode($templates_str, true);
                        }
                    }
                    $product_sample[] = array(
                        'id' => $key,
                        'name' => $product['name'],
                        'image' => $product['image'],
                        'templates' => count($templates),
                        'print_options' => isset($product['print_options']) ? 1 : 0,
                    );
                }
                wp_enqueue_media();
                wp_register_script('printcart-general', NBDESIGNER_PLUGIN_URL . 'assets/js/cmsmart-general.js', array(), NBDESIGNER_VERSION);
                wp_register_style('pc-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', array(), '5.1.3');
                wp_register_script('pc-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array(), '5.1.3', true);
                wp_localize_script('printcart-general', 'printcart_detail', array(
                    'ajax_url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('nbdesigner_add_cat'),
                    'user_email' => $user_email,
                    'name' => $name,
                    'site_title' => $site_title,
                    'home_url' => $home_url,
                    'product_sample' => $product_sample,
                    'dimension_unit' => $dimension_unit,
                    'default_font_subset' => $default_font_subset,
                    'create_your_own_page_id' => $create_your_own_page_id,
                    'designer_page_id' => $designer_page_id,
                    'gallery_page_id' => $gallery_page_id,
                    'logged_page_id' => $logged_page_id,
                    'first_imported_product' => $first_imported_product,
                ));
                wp_enqueue_script('angularjs');
                wp_enqueue_script('pc-bootstrap');
                wp_enqueue_style('pc-bootstrap');
                wp_enqueue_script('printcart-general');
                wp_enqueue_style('nbdesigner_general_css', NBDESIGNER_CSS_URL . 'admin-general.css', array(), NBDESIGNER_VERSION);
             }
        }
        public function printcart_import_product()
        {
            $result = array(
                'flag' => 0,
            );
            $product_id = $_POST['product_id'];

            $demo_data_path = NBDESIGNER_PLUGIN_DIR . 'data/demo_datas.json';
            $demo_datas = json_decode(file_get_contents($demo_data_path), true);
            $settings_str = nbd_file_get_contents($demo_datas[$product_id]['settings']);
            $data = maybe_unserialize($settings_str);
            $new_product_id = $this->add_product($data);
            if ($new_product_id) {
                update_option('nbdesigner_cmsmart_first_imported_product', 'yes');

                $result['flag'] = 1;
                if ($data['nbo_enable'] && isset($demo_datas[$product_id]['print_options'])) {
                    $print_options_str = nbd_file_get_contents($demo_datas[$product_id]['print_options']);
                    $print_options_data = unserialize($print_options_str);
                    $this->create_or_update_print_option($product_id,$new_product_id, $print_options_data);
                }

                if (isset($demo_datas[$product_id]['templates'])) {
                    $templates_str = nbd_file_get_contents($demo_datas[$product_id]['templates']);

                    $templates = json_decode($templates_str, true);

                    $this->add_templates($templates, $product_id, $new_product_id);

                }
            }

            wp_send_json($result);
            die();
        }
        public function add_templates( $templates, $product_id, $new_product_id ){
            global $wpdb;
            if ( !extension_loaded( 'zip' ) ) {
                return false;
            }

            $tems           = array_splice( $templates, 0, 1 );
            if( isset( $tems[0] ) ){
                $tem        = $tems[0];
                $temp_name  = substr( md5( uniqid() ), 0, 5 ) . rand( 1, 100 ) . time();
                $temp_path  = NBDESIGNER_DATA_DIR . '/import/' . $product_id . '/' . $tem['folder'] . '.zip';
                $temp_dir   = NBDESIGNER_CUSTOMER_DIR . '/' . $temp_name;
                nbd_download_remote_file( $tem['temp_url'], $temp_path );

                $zip = new ZipArchive();
                if ( !$zip->open( $temp_path, ZIPARCHIVE::CREATE ) ) {
                    return false;
                }

                $zip->extractTo( $temp_dir );
                $zip->close();

                unset( $tem['temp_url'] );
                $tem['product_id']      = $new_product_id;
                $tem['variation_id']    = 0;
                $tem['folder']          = $temp_name;
                $user_id                = wp_get_current_user()->ID;
                $tem['user_id']         = $user_id;
                $date                   = new DateTime();
                $tem['created_date']    = $date->format( 'Y-m-d H:i:s' );

                $wpdb->insert( "{$wpdb->prefix}nbdesigner_templates", $tem );

                $templates_path = NBDESIGNER_DATA_DIR . '/import/' . $product_id . '/templates.json';
                file_put_contents( $templates_path, json_encode( $templates ) );
            }
            return true;
        }
        public function create_or_update_print_option( $product_id, $new_product_id, $data ){
            $print_options_path = NBDESIGNER_DATA_DIR . '/import/' . $product_id . '/print_options.txt';
            $media_objects      = unserialize( $data['media_objects'] );
            if( count( $media_objects ) ){
                $media          = array_splice( $media_objects, 0, 1 );
                $key            = array_key_first( $media );
                $key_arr        = explode( '-', $key );
                $url            = $media[ $key ];
                $uploaded_id    = nbd_add_attachment( $url );
                $option_fields  = unserialize( $data['fields'] );

                $reference      = &$option_fields;
                foreach( $key_arr as $k ) {
                    if ( !array_key_exists( $k, $reference ) ) {
                        $reference[$k] = [];
                    }
                    $reference = &$reference[$k];
                }
                $reference      = $uploaded_id;
                unset( $reference );

                $data['fields']         = serialize( $option_fields );
                $data['media_objects']  = serialize( $media_objects );
                file_put_contents( $print_options_path, serialize( $data ) );
            } else {
                if( isset( $data['media_objects'] ) ){
                    $this->save_print_option( $product_id, $new_product_id, $data );
                }
            }
        }
        public function save_print_option( $product_id, $new_product_id, $data ){
            global $wpdb;

            unset( $data['media_objects'] );
            unset( $data['id'] );
            $date                   = new DateTime();
            $data['modified']       = $date->format( 'Y-m-d H:i:s' );
            $data['created']        = $date->format( 'Y-m-d H:i:s' );
            $data['created_by']     = wp_get_current_user()->ID;
            $data['product_cats']   = serialize( array() );
            $data['product_ids']    = serialize(array( $new_product_id ));

            $wpdb->insert( "{$wpdb->prefix}nbdesigner_options", $data );
            $option_id              = $wpdb->insert_id;
            set_transient( 'nbo_product_' . $new_product_id , $option_id );
        }
        public function add_product( $data ){
            $product    = new WC_Product();

            $product->set_name( $data['name'] );
            $product->set_description( $data['description'] );
            $product->set_regular_price( $data['regular_price'] );
            $product->set_sale_price( $data['sale_price'] );
            $product->set_status( "publish" );
            $product->set_catalog_visibility( "visible" );
            $product->set_stock_status( "instock" );

            if( $data['image'] ){
                $media_id = nbd_add_attachment( $data['image'] );
                if( $media_id ){
                    $product->set_image_id( $media_id );
                }
            }

            $product_id = $product->save();

            update_post_meta( $product_id, '_nbdesigner_enable', $data['enable_design'] );
            update_post_meta( $product_id, '_nbdesigner_enable_upload', $data['enable_upload'] );
            update_post_meta( $product_id, '_nbdesigner_enable_upload_without_design', $data['upload_without_design'] );
            update_post_meta( $product_id, '_nbo_enable', $data['nbo_enable'] );

            if( $data['setting_upload'] ){
                update_post_meta( $product_id, '_nbdesigner_upload', $data['setting_upload'] );
            }

            if( $data['option'] ){
                update_post_meta( $product_id, '_nbdesigner_option', $data['option'] );
            }

            if( $data['setting_design'] ){
                $product_config = unserialize( $data['setting_design'] );
                $default_bg_id  = get_option('nbdesigner_default_background');
                $default_ov_id  = get_option('nbdesigner_default_overlay');
                foreach ( $product_config as $key => $_config ){
                    $im_id = nbd_add_attachment( $_config['img_src'] );
                    $product_config[$key]['img_src'] = $im_id ? $im_id : $default_bg_id;

                    $ov_id = nbd_add_attachment( $_config['img_overlay'] );
                    $product_config[$key]['img_overlay'] = $ov_id ? $ov_id : $default_ov_id;
                }

                $setting_design = serialize( $product_config );
                update_post_meta( $product_id, '_designer_setting', $setting_design );
            }

            return $product_id;
        }
    }
}
$cmsmart_admin_general = NBD_Cmsmart_General::instance();
$cmsmart_admin_general->init();