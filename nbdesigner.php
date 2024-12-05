<?php
/**
 * @package Nbdesigner
 */
/*
Plugin Name: NBDesigner
Plugin URI: https://cmsmart.net/wordpress-plugins/woocommerce-online-product-designer-plugin
Description: A Woocommerce printing ecosystem.
Version: 2.8.5
Author: NetbaseTeam
Author URI: https://cmsmart.net/
License: GPLv2 or later
Text Domain: web-to-print-online-designer
Domain Path: /langs
WC requires at least: 3.0.0
*/

if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}
$upload_dir = wp_upload_dir();
$basedir    = $upload_dir['basedir'];
$baseurl    = $upload_dir['baseurl'];
if( is_multisite() ){
    if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
        require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
    }
    if( in_array('wordpress-mu-domain-mapping/domain_mapping.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )
        || is_plugin_active_for_network( 'wordpress-mu-domain-mapping/domain_mapping.php' ) ){ 
        $dm_domain      = $_SERVER[ 'HTTP_HOST' ];
        $baseurl_arr    = explode( 'wp-content', $baseurl );
        if( isset( $baseurl_arr[1] ) ){
            $protocol   = ( !empty($_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) ? 'https://' : 'http://';
            $baseurl    = $protocol . $dm_domain . '/wp-content' . $baseurl_arr[1];
        }
    }
}
$nbd_plugin_dir_url = plugin_dir_url( __FILE__ );
if ( function_exists( 'icl_get_home_url' ) ) {
    if ( class_exists( 'SitePress' ) ) {
        global $sitepress;
        $wpml_language_negotiation_type = $sitepress->get_setting('language_negotiation_type');
        if( $wpml_language_negotiation_type == 2 ){
            $nbd_plugin_dir_url = str_replace(untrailingslashit(get_option('home')), untrailingslashit(icl_get_home_url()), $nbd_plugin_dir_url);
        }
    }
}
nbd_define( 'NBDESIGNER_VERSION',                '2.8.5' );
nbd_define( 'NBDESIGNER_NUMBER_VERSION',         285 );
nbd_define( 'NBDESIGNER_MINIMUM_WP_VERSION',     '4.1.1' );
nbd_define( 'NBDESIGNER_MINIMUM_PHP_VERSION',    '5.6.0' );
nbd_define( 'NBDESIGNER_MINIMUM_WC_VERSION',     '3.0.0' );
nbd_define( 'NBDESIGNER_PLUGIN_URL',             $nbd_plugin_dir_url );
nbd_define( 'NBDESIGNER_PLUGIN_DIR',             plugin_dir_path( __FILE__ ) );
nbd_define( 'NBDESIGNER_PLUGIN_BASENAME',        plugin_basename( __FILE__ ) );
nbd_define( 'NBDESIGNER_MODE_DEV',               FALSE );
nbd_define( 'NBDESIGNER_MODE_DEBUG',             FALSE );
nbd_define( 'NBDESIGNER_DATA_DIR',               $basedir . '/nbdesigner' );
nbd_define( 'NBDESIGNER_DATA_URL',               $baseurl . '/nbdesigner' );
nbd_define( 'NBDESIGNER_FONT_DIR',               NBDESIGNER_DATA_DIR . '/fonts' );
nbd_define( 'NBDESIGNER_FONT_URL',               NBDESIGNER_DATA_URL . '/fonts' );
nbd_define( 'NBDESIGNER_ART_DIR',                NBDESIGNER_DATA_DIR . '/cliparts' );
nbd_define( 'NBDESIGNER_ART_URL',                NBDESIGNER_DATA_URL . '/cliparts' );
nbd_define( 'NBDESIGNER_DOWNLOAD_DIR',           NBDESIGNER_DATA_DIR . '/download' );
nbd_define( 'NBDESIGNER_DOWNLOAD_URL',           NBDESIGNER_DATA_URL . '/download' );
nbd_define( 'NBDESIGNER_TEMP_DIR',               NBDESIGNER_DATA_DIR . '/temp' );
nbd_define( 'NBDESIGNER_LOG_DIR',                NBDESIGNER_DATA_DIR . '/logs' );
nbd_define( 'NBDESIGNER_TEMP_URL',               NBDESIGNER_DATA_URL . '/temp' );
nbd_define( 'NBDESIGNER_ADMINDESIGN_DIR',        NBDESIGNER_DATA_DIR . '/admindesign' );
nbd_define( 'NBDESIGNER_ADMINDESIGN_URL',        NBDESIGNER_DATA_URL . '/admindesign' );
nbd_define( 'NBDESIGNER_PDF_DIR',                NBDESIGNER_DATA_DIR . '/pdfs' );
nbd_define( 'NBDESIGNER_PDF_URL',                NBDESIGNER_DATA_URL . '/pdfs' );
nbd_define( 'NBDESIGNER_CUSTOMER_DIR',           NBDESIGNER_DATA_DIR . '/designs' );
nbd_define( 'NBDESIGNER_CUSTOMER_URL',           NBDESIGNER_DATA_URL . '/designs' );
nbd_define( 'NBDESIGNER_UPLOAD_DIR',             NBDESIGNER_DATA_DIR . '/uploads' );
nbd_define( 'NBDESIGNER_UPLOAD_URL',             NBDESIGNER_DATA_URL . '/uploads' );
nbd_define( 'NBDESIGNER_SUGGEST_DESIGN_DIR',     NBDESIGNER_DATA_DIR . '/suggest_designs' );
nbd_define( 'NBDESIGNER_SUGGEST_DESIGN_URL',     NBDESIGNER_DATA_URL . '/suggest_designs' );
nbd_define( 'NBDESIGNER_DATA_CONFIG_DIR',        NBDESIGNER_DATA_DIR . '/data' );
nbd_define( 'NBDESIGNER_DATA_CONFIG_URL',        NBDESIGNER_DATA_URL . '/data' );
nbd_define( 'NBDESIGNER_ASSETS_URL',             NBDESIGNER_PLUGIN_URL . 'assets/' );
nbd_define( 'NBDESIGNER_JS_URL',                 NBDESIGNER_PLUGIN_URL . 'assets/js/' );
nbd_define( 'NBDESIGNER_CSS_URL',                NBDESIGNER_PLUGIN_URL . 'assets/css/' );
nbd_define( 'NBDESIGNER_TEMPLATES',              'nbdesigner_templates' );
nbd_define( 'NBDESIGNER_CATEGORY_TEMPLATES',     'nbdesigner_category_templates' );
nbd_define( 'NBDESIGNER_AUTHOR_SITE',            'https://cmsmart.net/' );
nbd_define( 'NBDESIGNER_SKU',                    'WPP1074' );
nbd_define( 'NBDESIGNER_PAGE_STUDIO',            'design-studio' );
nbd_define( 'NBDESIGNER_PAGE_CREATE_YOUR_OWN',   'create-your-own' );

//nbd_define('PCLZIP_TEMPORARY_DIR', NBDESIGNER_DATA_DIR);
function nbd_define( $name, $value ) {
    if ( ! defined( $name ) ) {
        define( $name, $value );
    }
}

require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-util.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-template-loader.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-settings.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-debug.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-helper.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-import-export-product.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-update-data.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.category.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/table/class.product.templates.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-install.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.nbdesigner.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.my.design.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.vista.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.resource.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-compatibility.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.product-builder.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.request-quote.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.template-tags.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.template-mapping.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-updates.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-shortcodes.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.appearance.customize.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-api.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.artwork.actions.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.design.guideline.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class.advanced.upload.php' );

require_once( NBDESIGNER_PLUGIN_DIR . 'includes/launcher/class.designer.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/launcher/util.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/launcher/class.withdraw.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/launcher/class.design.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/launcher/class.launcher.php' );

require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-live-chat.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-faq.php' );

require_once(NBDESIGNER_PLUGIN_DIR . 'includes/background-processes.php' );

if ( ! empty( $_GET['page'] ) ) {
	if (!function_exists('wp_get_current_user')) {
        include(ABSPATH . "wp-includes/pluggable.php");
    }
    if ( $_GET['page'] == 'nbd-setup' && current_user_can('administrator') ) {
        require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-setup-wizard.php' );
    }
}
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/options/admin-options.php' );
require_once( NBDESIGNER_PLUGIN_DIR . 'includes/options/frontend-options.php' );

register_activation_hook( __FILE__, array( 'Nbdesigner_Plugin', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Nbdesigner_Plugin', 'plugin_deactivation' ) );
$prefix = is_network_admin() ? 'network_admin_' : '';
add_filter( $prefix.'plugin_action_links_' . NBDESIGNER_PLUGIN_BASENAME, array('Nbdesigner_Plugin', 'nbdesigner_add_action_links') );
add_filter( 'plugin_row_meta', array( 'Nbdesigner_Plugin', 'nbdesigner_plugin_row_meta' ), 10, 2 );
if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}
$nb_designer = new Nbdesigner_Plugin();
$nb_designer->init();

$nb_design_endpoint = new My_Design_Endpoint();
$nb_design_endpoint->init();

$nb_compatibility = new Nbdesigner_Compatibility();
$nb_compatibility->init();

require_once( NBDESIGNER_PLUGIN_DIR . 'includes/class-widget.php' );

/**
 * With the upgrade to WordPress 4.7.1, some non-image files fail to upload on certain server setups. 
 * This will be fixed in 4.7.3, see the Trac ticket: https://core.trac.wordpress.org/ticket/39550
 * 
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7.2', '<=' ) || nbdesigner_get_option( 'nbd_force_upload_svg' ) == 'yes' ) {
    add_filter( 'wp_check_filetype_and_ext', 'wp39550_disable_real_mime_check', 10, 4 );
}
function wp39550_disable_real_mime_check( $data, $file, $filename, $mimes ) {
    $wp_filetype        = wp_check_filetype( $filename, $mimes );
    $ext                = $wp_filetype['ext'];
    $type               = $wp_filetype['type'];
    $proper_filename    = $data['proper_filename'];
    return compact( 'ext', 'type', 'proper_filename' );
}
if( nbdesigner_get_option( 'nbdesigner_redefine_K_PATH_FONTS', 'yes' ) == 'yes' ){
    nbd_define( 'K_PATH_FONTS', NBDESIGNER_DATA_DIR . '/php-fonts/' );
}
if( nbdesigner_get_option( 'nbdesigner_disable_nonce', 'no' ) == 'yes' ){
    nbd_define( 'NBDESIGNER_ENABLE_NONCE', FALSE );
}else{
    nbd_define( 'NBDESIGNER_ENABLE_NONCE', TRUE );
}
do_action( 'nbd_loaded' );

add_action('wp_ajax_test_free_pick','test_free_pick');
add_action('wp_ajax_nopriv_test_free_pick','test_free_pick');
function test_free_pick() {
    $curl = curl_init($url);
    $url  =  $_REQUEST['src'];
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);
    curl_close($curl);
    echo $resp;
    wp_die();
}

// --------------------------------------------

add_action( 'wp_ajax_nbdesigner_add_background_cat', 'nbdesigner_add_background_cat' );
add_action( 'wp_ajax_nbdesigner_delete_background_cat', 'nbdesigner_delete_background_cat' );
add_action( 'wp_ajax_nbdesigner_delete_background', 'nbdesigner_delete_background' );
add_action( 'wp_ajax_nopriv_nbdesigner_get_background', 'nbdesigner_get_background' );

function bagr_define(){
    nbd_define('NBDESIGNER_BACKGROUND_DIR', NBDESIGNER_DATA_DIR.'/backgrounds');
    nbd_define('NBDESIGNER_BACKGROUND_URL', NBDESIGNER_DATA_URL.'/backgrounds');
}

function _nbdesigner_get_background(){
    if (!wp_verify_nonce($_REQUEST['nonce'], 'nbdesigner-get-data') && NBDESIGNER_ENABLE_NONCE) {
        die('Security error');
    }   
    $result = array();
    $path = NBDESIGNER_DATA_DIR . '/backgrounds';
    $cats = Nbdesigner_IO::get_list_folder($path, 1);
    foreach ($cats as $key => $cat){
        $result['cat'][] = array(
            'name'  => basename($cat),
            'id'    => $key                
        );
        $list = Nbdesigner_IO::get_list_files($path . '/' . basename($cat), 1);
        $backgrounds = preg_grep('/\.(svg)(?:[\?\#].*)?$/i', $list);
        foreach($backgrounds as $k => $background) {
            $result['backgrounds'][] = array(
                'name'  => basename($background),
                'id'    => $k,
                'cat'   => array($key),
                'file'  => '',
                'url'   => Nbdesigner_IO::wp_convert_path_to_url($background)
            );
        }               
    }       
    $result['flag'] = 1;

    echo json_encode($result);
    wp_die();         
}

function nbdesigner_get_background(){
    global $nb_designer;
    if (!wp_verify_nonce($_REQUEST['nonce'], 'nbdesigner-get-data') && NBDESIGNER_ENABLE_NONCE) {
        die('Security error');
    }       
    $result = array();
    $path_cat = NBDESIGNER_DATA_DIR . '/background_cat.json';
    $path_background = NBDESIGNER_DATA_DIR . '/backgrounds.json';
    $result['flag'] = 1;
    $result['cat'] = $nb_designer->nbdesigner_read_json_setting($path_cat);
    $result['backgrounds'] = $nb_designer->nbdesigner_read_json_setting($path_background);   
    echo json_encode($result);
    wp_die();        
}

function bagr_nbdesigner_manager_backgrounds() {
    defined('NBDESIGNER_BACKGROUND_URL') or bagr_define();
    global $nb_designer;
    $notice = '';
    $current_background_cat_id = 0;
    $background_id = 0;
    $update = false;
    $cats = array("0");
    $list = $nb_designer->nbdesigner_read_json_setting(NBDESIGNER_DATA_DIR . '/backgrounds.json');
    $cat = $nb_designer->nbdesigner_read_json_setting(NBDESIGNER_DATA_DIR . '/background_cat.json');
    $total = sizeof($list);
    $limit = 40;
    if (is_array($cat))
        $current_background_cat_id = sizeof($cat);
    if (isset($_GET['id'])) {
        $background_id = $_GET['id'];
        $update = true;
        if (isset($list[$background_id])) {
            $background_data = $list[$background_id];
            $cats = $background_data->cat;
        }
    }
    $page = filter_input(INPUT_GET, "p", FILTER_VALIDATE_INT);
    $current_cat = filter_input(INPUT_GET, "cat_id", FILTER_VALIDATE_INT);

    if (isset($_POST[$nb_designer->plugin_id . '_hidden']) && wp_verify_nonce($_POST[$nb_designer->plugin_id . '_hidden'], $nb_designer->plugin_id) && current_user_can('edit_nbd_background')) {
        $background = array();
        $background['id'] = $_POST['nbdesigner_background_id'];
        $background['cat'] = $cats;
        if (isset($_POST['nbdesigner_background_cat'])) $background['cat'] = $_POST['nbdesigner_background_cat'];
        if (isset($_FILES['svg'])) {
            $files = $_FILES['svg'];
            foreach ($files['name'] as $key => $value) {
                $file = array(
                  'name'     => $files['name'][$key],
                  'type'     => $files['type'][$key],
                  'tmp_name' => $files['tmp_name'][$key],
                  'error'    => $files['error'][$key],
                  'size'     => $files['size'][$key]
                );                    
                $uploaded_file_name = basename($file['name']);
                $allowed_file_types = array('svg', 'png', 'jpg', 'jpeg');
                if (Nbdesigner_IO::checkFileType($uploaded_file_name, $allowed_file_types)) {
                    $upload_overrides = array('test_form' => false);
                    $uploaded_file = wp_handle_upload($file, $upload_overrides);
                    if (isset($uploaded_file['url'])) {
                        $new_path_background = Nbdesigner_IO::create_file_path(NBDESIGNER_BACKGROUND_DIR, $uploaded_file_name);
                        $background['file'] = $uploaded_file['file'];
                        $background['url'] = $uploaded_file['url'];
                        $background['name'] = $_POST['bg_name'][$key];
                        if (!copy($background['file'], $new_path_background['full_path'])) {
                            $notice = apply_filters('nbdesigner_notices', nbd_custom_notices('error', __('Failed to copy.', 'web-to-print-online-designer')));
                        }else{
                            $background['file'] = $new_path_background['date_path'];
                            $background['url'] = $new_path_background['date_path'];
                            
                        }                                               
                        if ($update) {
                            nbdesigner_update_list_backgrounds($background, $background_id);
                        } else {
                            nbdesigner_update_list_backgrounds($background);
                        }
                        $notice = apply_filters('nbdesigner_notices', nbd_custom_notices('success', __('Your background has been saved.', 'web-to-print-online-designer')));

                    } else {
                        $notice = apply_filters('nbdesigner_notices', nbd_custom_notices('error', sprintf(__( 'Error while upload file, please try again! <a target="_blank" href="%s">Force upload SVG</a>', 'web-to-print-online-designer'), esc_url(admin_url('admin.php?page=nbdesigner&tab=general#nbdesigner_option_download_type')))));
                    }
                } else {
                    $notice = apply_filters('nbdesigner_notices', nbd_custom_notices('error', __('Incorrect file extensions.', 'web-to-print-online-designer')));
                }
            }
        }
        $list = $nb_designer->nbdesigner_read_json_setting(NBDESIGNER_DATA_DIR . '/backgrounds.json');
        $cats = $background['cat'];
        $total = sizeof($list);
        
    }
    $current_cat_id = 0;
    $name_current_cat = 'uploaded';
    if($total){
        if(isset($current_cat)){
            $current_cat_id = $current_cat;
            $new_list = array();
            foreach($list as $background){  
                if(in_array((string)$current_cat, $background->cat)) $new_list[] = $background;
                if(($current_cat == 0) && sizeof($background->cat) == 0) $new_list[] = $background;
            }
            foreach($cat as $c){
                if($c->id == $current_cat){
                    $name_current_cat = $c->name;
                    break;
                } 
                $name_current_cat = 'uploaded';
            }
            $list = $new_list;
            $total = sizeof($list);               
        }else{
            $name_current_cat = 'uploaded';
        }
        if(isset($page)){
            $_tp = ceil($total / $limit);
            if($page > $_tp) $page = $_tp;
            $_list = array_slice($list, ($page-1)*$limit, $limit);
        }else{
            $_list = $list;
            if($total > $limit) $_list = array_slice($list, 0, $limit); 
        }
    } else{
        $_list = array();
    }        
    if(isset($current_cat)){
        $url = add_query_arg(array('cat_id' => $current_cat), admin_url('admin.php?page=nbdesigner_manager_backgrounds'));
    }else{
        $url = admin_url('admin.php?page=nbdesigner_manager_backgrounds');   
    }
    require_once NBDESIGNER_PLUGIN_DIR . 'includes/class.nbdesigner.pagination.php';
    $paging = new Nbdesigner_Pagination();
    $config = array(
        'current_page'  => isset($page) ? $page : 1, 
        'total_record'  => $total,
        'limit'         => $limit,
        'link_full'     => $url.'&p={p}',
        'link_first'    => $url              
    );          
    $paging->init($config);
    include_once(__DIR__ . '/views/nbdesigner-manager-backgrounds.php');
}

function nbdesigner_add_background_cat() {  
    global $nb_designer;  
    $data = array(
            'mes'   =>  __('You do not have permission to add/edit background category!', 'web-to-print-online-designer'),
            'flag'  => 0
        );          
    if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('edit_nbd_background')) {
        echo json_encode($data);
        wp_die();
    }
    $path = NBDESIGNER_DATA_DIR . '/background_cat.json';
    $cat = array(
        'name' => sanitize_text_field($_POST['name']),
        'id' => $_POST['id']
    );
    $nb_designer->nbdesigner_update_json_setting($path, $cat, $cat['id']);
    $data['mes'] = __('Category has been added/edited successfully!', 'web-to-print-online-designer');
    $data['flag'] = 1;        
    echo json_encode($data);
    wp_die();
}

function nbdesigner_delete_background_cat() {
    global $nb_designer;
    $data = array(
            'mes'   =>  __('You do not have permission to delete bakground category!', 'web-to-print-online-designer'),
            'flag'  => 0
        );          
    if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('delete_nbd_background')) {
        echo json_encode($data);
        wp_die();
    }
    $path = NBDESIGNER_DATA_DIR . '/background_cat.json';
    $id = $_POST['id'];
    $nb_designer->nbdesigner_delete_json_setting($path, $id, true);
    $background_path = NBDESIGNER_DATA_DIR . '/backgrounds.json';
    $nb_designer->nbdesigner_update_json_setting_depend($background_path, $id);
    $data['mes'] = __('Category has been delete successfully!', 'web-to-print-online-designer');
    $data['flag'] = 1;        
    echo json_encode($data);
    wp_die();
}

function nbdesigner_update_list_backgrounds($background, $id = null) {
    global $nb_designer;
    $path = NBDESIGNER_DATA_DIR . '/backgrounds.json';
    if (isset($id)) {
        $nb_designer->nbdesigner_update_json_setting($path, $background, $id);
        return;
    }
    $list_background = array();
    $list = $nb_designer->nbdesigner_read_json_setting($path);
    if (is_array($list)) {
        $list_background = $list;
        $id = sizeOf($list_background);
        $background['id'] = (string) $id;
    }
    $list_background[] = $background;
    $res = json_encode($list_background);
    file_put_contents($path, $res);
}

function nbdesigner_delete_background() {
    global $nb_designer;
    $data = array(
            'mes'   =>  __('You do not have permission to delete background!', 'web-to-print-online-designer'),
            'flag'  => 0
        );
    if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || 
        !current_user_can('delete_nbd_background')) {
        echo json_encode($data);
        wp_die();
    }
    $id = $_POST['id'];
    $path = NBDESIGNER_DATA_DIR . '/backgrounds.json';
    $list = $nb_designer->nbdesigner_read_json_setting($path);
    $file_background = $list[$id]->file;
    if(file_exists($file_background)){
        unlink($file_background);
    }else{
        $file_background = NBDESIGNER_BACKGROUND_DIR . $list[$id]->file;
        unlink($file_background);
    }        
    $nb_designer->nbdesigner_delete_json_setting($path, $id);
    $data['mes'] = __('Background has been deleted successfully!', 'web-to-print-online-designer');
    $data['flag'] = 1;
    echo json_encode($data);
    wp_die();
}

