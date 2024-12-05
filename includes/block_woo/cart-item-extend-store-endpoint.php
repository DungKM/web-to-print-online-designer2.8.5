<?php
use Automattic\WooCommerce\Blocks\Package;
use Automattic\WooCommerce\Blocks\StoreApi\Schemas\CartSchema;
use Automattic\WooCommerce\Blocks\StoreApi\Schemas\CartItemSchema;
use Automattic\WooCommerce\Blocks\StoreApi\Schemas\CheckoutSchema;

/**
 * Shipping Workshop Extend Store API.
 */
class Cart_Item_Extend_Store_Endpoint {
	/**
	 * Stores Rest Extending instance.
	 *
	 * @var ExtendRestApi
	 */
	private static $extend;

	/**
	 * Plugin Identifier, unique to each plugin.
	 *
	 * @var string
	 */
	const IDENTIFIER = 'online_design';

	/**
	 * Bootstraps the class and hooks required data.
	 *
	 */
	public static function init() {
		self::$extend = Automattic\WooCommerce\StoreApi\StoreApi::container()->get( Automattic\WooCommerce\StoreApi\Schemas\ExtendSchema::class );
		self::extend_store();
	}

	/**
	 * Registers the actual data into each endpoint.
	 */
	public static function extend_store() {
		/**
		 * [backend-step-02]
		 * 📝 Once the `extend_checkout_schema` method is complete (see [backend-step-01]) you can 
		 * uncomment the code below.
		 */
		
		if ( is_callable( [ self::$extend, 'register_endpoint_data' ] ) ) {
			self::$extend->register_endpoint_data(
				[
					'endpoint'        => CartItemSchema::IDENTIFIER,
					'namespace'       => self::IDENTIFIER,
					'schema_callback' => [ 'Cart_Item_Extend_Store_Endpoint', 'extend_checkout_schema' ],
					'data_callback' => [ 'Cart_Item_Extend_Store_Endpoint', 'extend_data_schema' ],
					'schema_type'     => ARRAY_A,
				]
			);
		}
        
	}
	public static function extend_data_schema($item){
		// echo '<pre>';
		// print_r($item);
		// echo '</pre>';
		// die();
		$output = array();
		$product_id                     = $item['product_id'];
        $variation_id                   = $item['variation_id'];
        $cart_item_key                  = $item['key'];
        $product_id                     = get_wpml_original_id( $product_id );
        $_product                       = apply_filters( 'woocommerce_cart_item_product', $item['data'], $item, $cart_item_key );
        $product_permalink              = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $item ) : '', $item, $cart_item_key );

		if(isset($item['nbd_item_meta_ds'])){
			$output['cart_item_key'] 	= $cart_item_key;
			$layout = nbd_get_product_layout( $product_id );
			$nbd = $item['nbd_item_meta_ds']['nbd'];
			$nbu = $item['nbd_item_meta_ds']['nbu'];
			$enable_edit_design             = nbdesigner_get_option('nbdesigner_show_button_edit_design_in_cart', 'yes') == 'yes' ? true : false;
			$show_edit_link                 = apply_filters('nbd_show_edit_design_link_in_cart', $enable_edit_design, $item);
			if($nbd){
				$redirect       = is_cart() ? 'cart' : 'checkout';
				
            	
                if( $show_edit_link ){
                    $link_edit_design = add_query_arg(
                        array(
                            'task'          => 'edit',
                            'product_id'    => $product_id,
                            'nbd_item_key'  => $nbd,
                            'cik'           => $cart_item_key,
                            'view'          => $layout,
                            'rd'            => $redirect),
                        getUrlPageNBD('create'));
                    if( $product_permalink ){
                        $att_query = parse_url( $product_permalink, PHP_URL_QUERY );
                        $link_edit_design .= '&'.$att_query;
                    }    
                    if( $layout == 'v' ){
                        $link_edit_design = add_query_arg(
                            array(
                                'nbdv-task'     => 'edit',
                                'task'          => 'edit',
                                'product_id'    => $product_id,
                                'nbd_item_key'  => $nbd,
                                'cik'           => $cart_item_key,
                                'rd'            => 'cart'),
                            $product_permalink );
                    }
                    if($item['variation_id'] > 0){
                        $link_edit_design .= '&variation_id=' . $item['variation_id'];
                    }
                    $output['edit_design'] = $link_edit_design;
                }
				$images = Nbdesigner_IO::get_list_images(NBDESIGNER_CUSTOMER_DIR .'/'. $nbd .'/preview', 1);
                asort( $images );
                $imgs = array();
                foreach ($images as $key => $image) {
                	$imgs[] = Nbdesigner_IO::convert_path_to_url($image);
                }
				$output['nbd_item_key'] 	= $nbd;
				$output['images'] 			= $imgs;
			}
			if($nbu){
				$files          = Nbdesigner_IO::get_list_files( NBDESIGNER_UPLOAD_DIR . '/' . $nbu );
				$create_preview = nbdesigner_get_option('nbdesigner_create_preview_image_file_upload');
				$imgs = array();
				foreach ( $files as $file ) {
                    $ext        = pathinfo( $file, PATHINFO_EXTENSION );
                    $src        = Nbdesigner_IO::get_thumb_file( pathinfo( $file, PATHINFO_EXTENSION ), '');
                    $file_url   = Nbdesigner_IO::wp_convert_path_to_url( $file );
                    if(  $create_preview == 'yes' && ( $ext == 'png' || $ext == 'jpg' || $ext == 'pdf' ) ){
                        $dir        = pathinfo( $file, PATHINFO_DIRNAME );
                        $filename   = pathinfo( $file, PATHINFO_BASENAME );
                        if( file_exists($dir.'_preview/'.$filename) ){
                            $src = Nbdesigner_IO::wp_convert_path_to_url( $dir.'_preview/'.$filename );
                        }else if( $ext == 'pdf' && file_exists($dir.'_preview/'.$filename.'.jpg' ) ){
                            $src = Nbdesigner_IO::wp_convert_path_to_url( $dir.'_preview/'.$filename.'.jpg' );
                        }else{
                            $src = Nbdesigner_IO::get_thumb_file( $ext, '' );
                        }
                    }else {
                        $src = Nbdesigner_IO::get_thumb_file( $ext, '' );
                    }
                    // $upload_html .= '<div class="nbd-cart-item-upload-preview-wrap"><a target="_blank" href='.$file_url.'><img class="nbd-cart-item-upload-preview" src="' . $src . '"/></a><p class="nbd-cart-item-upload-preview-title">'. basename($file).'</p></div>';
                    $imgs[] = array(
                    	'file_url'		=> $file_url,
                    	'src'			=> $src,
                    	'name'			=> basename($file),
                    );

                }
                if( $show_edit_link ){
                    $link_reup_design = add_query_arg(
                        array(
                            'task'          => 'reup',
                            'product_id'    => $product_id,
                            'nbu_item_key'  => $nbu,
                            'cik'           => $cart_item_key,
                            'rd'            => 'cart'),
                        getUrlPageNBD('create'));
                    if($cart_item['variation_id'] > 0){
                        $link_reup_design .= '&variation_id=' . $cart_item['variation_id'];
                    }
                    $link_reup_design = apply_filters( 'nbu_cart_item_reup_link', $link_reup_design, $item, $cart_item_key, 'cart' );
                    $output['edit_design'] = $link_reup_design;
                }
                $output['images'] 			= $imgs;
                $output['nbu_item_key'] 	= $nbu;
			}
		}
    	return $output;
	}

	/**
	 * Register shipping workshop schema into the Checkout endpoint.
	 *
	 * @return array Registered schema.
	 *
	 */
	public static function extend_checkout_schema() {
        /**
         * [backend-step-01]
		 * 📝 Uncomment the code below and update the values in the array, following the instructions.
         *
         * We need to describe the shape of the data we're adding to the Checkout endpoint. Since we expect the shopper
         * to supply an option from the select box and MAYBE enter text into the `other` field, we need to describe two things.
         *
         * This function should return an array. Since we're adding two keys on the client, this function should
         * return an array with two keys. Each key describes the shape of the data for each field coming from the client.
         *
         */
        return array(
			'properties' => array(
				'nbd_item_key' => array(
					'type' => 'string',
				),
				'cart_item_key' => array(
					'type' => 'string',
				),
			),
		);
    }
}
