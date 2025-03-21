<?php
use Automattic\WooCommerce\Blocks\Integrations\IntegrationInterface;

/**
 * Class for integrating with WooCommerce Blocks
 */
    class Cart_Item_Blocks_Integration implements IntegrationInterface {

	/**
	 * The name of the integration.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'design';
	}

	/**
	 * When called invokes any initialization/setup for the integration.
	 */
	public function initialize() {
		require_once NBDESIGNER_PLUGIN_DIR . 'includes/block_woo/cart-item-extend-store-endpoint.php';
		$this->register_shipping_workshop_block_frontend_scripts();
		$this->register_shipping_workshop_block_editor_scripts();
		$this->register_shipping_workshop_block_editor_styles();
		$this->register_main_integration();
		$this->extend_store_api();
		$this->save_shipping_instructions();
		$this->show_shipping_instructions_in_order();
		/**
		 * [backend-step-09-extra-credit]
		 * 💰 Extra credit: Display the selection on the order confirmation page.
		 *
		 * To accomplish this, you'll need to add an action to the 
		 * `woocommerce_order_details_after_customer_details` hook. Uncomment the function call in 
		 * the next line, and implement the function body of `show_shipping_instructions_in_order_confirmation`.
		 * 
		 * 💡 Similar to [backend-step-08] respectively [backend-step-08-extra-credit], you'll need 
		 * to get the `shipping_workshop_alternate_shipping_instruction` and 
		 * `shipping_workshop_alternate_shipping_instruction_other_text` and print them out.
		 */
		// $this->show_shipping_instructions_in_order_confirmation();

		/**
		 * [backend-step-10-extra-credit]
		 * 💰 Extra credit: Display the selection in the order confirmation email.
		 *
		 * To accomplish this, you'll need to add an action to the 
		 * `woocommerce_email_customer_details` hook. Uncomment the function call in 
		 * the next line, and implement the function body of `show_shipping_instructions_in_order_email`.
		 * 
		 * 💡 Similar to [backend-step-08] respectively [backend-step-08-extra-credit], you'll need 
		 * to get the `shipping_workshop_alternate_shipping_instruction` and 
		 * `shipping_workshop_alternate_shipping_instruction_other_text` and print them out.
		 */
		// $this->show_shipping_instructions_in_order_email();
	}

	/**
	 * Extends the cart schema to include the shipping-workshop value.
	 */
	private function extend_store_api() {
		Cart_Item_Extend_Store_Endpoint::init();
	}

    private function save_shipping_instructions() {
        /**
         * Complete the below `woocommerce_store_api_checkout_update_order_from_request` action.
		 * This will update the order metadata with the shipping-workshop alternate shipping instruction.
         *
         * The documentation for this hook is at: https://github.com/woocommerce/woocommerce-blocks/blob/b73fbcacb68cabfafd7c3e7557cf962483451dc1/docs/third-party-developers/extensibility/hooks/actions.md#woocommerce_store_api_checkout_update_order_from_request
         */
        add_action(
            'woocommerce_store_api_checkout_update_order_from_request',
            function( \WC_Order $order, \WP_REST_Request $request ) {
                $shipping_workshop_request_data = $request['extensions'][$this->get_name()];
                /**
				 * [backend-step-03]
                 * 📝 From the `$shipping_workshop_request_data` array, get the 
				 * `alternateShippingInstruction` and `otherShippingValue` entries. Store them in 
				 * their own variables, $alternate_shipping_instruction and $other_shipping_value.
                 */
				
				/**
				 * [backend-step-04]
                 * 📝 Using `$order->update_meta_data` update the order metadata.
                 * Set the value of the `shipping_workshop_alternate_shipping_instruction` key to 
				 * `$alternate_shipping_instruction`.
				 * Set the value of the `shipping_workshop_alternate_shipping_instruction_other_text` 
				 * key to `$other_shipping_value`.
				 
                 */
				
				/**
                 * [backend-step-04-extra-credit-1]
				 * 💰 Extra credit: Instead of the `shipping_workshop_alternate_shipping_instruction`
				 * key, show the translation-ready value.
                 */

				/**
                 * [backend-step-04-extra-credit-2]
				 * 💰 Extra credit: Avoid setting `shipping_workshop_alternate_shipping_instruction_other_text` if
                 * `$alternate_shipping_instruction_other_text` is not a string, or if it is empty.
                 */
				
				 /**
				  * [backend-step-05]
				  * 💡 Don't forget to save the order using `$order->save()`.
				  */
            },
            10,
            2
        );
    }

    /**
     * Adds the address in the order page in WordPress admin.
     */
    private function show_shipping_instructions_in_order() {
        add_action(
            'woocommerce_admin_order_data_after_shipping_address',
            function( \WC_Order $order ) {
                /**
                 * [backend-step-06]
				 * 📝 Get the `shipping_workshop_alternate_shipping_instruction` from the order metadata using `$order->get_meta`.
                 */

                /**
				 * [backend-step-07]
                 * 📝 Get the `shipping_workshop_alternate_shipping_instruction_other_text` from the order metadata using `$order->get_meta`.
                 */

				echo '<div>';
                echo '<strong>' . __( 'Shipping Instructions', 'shipping-workshop' ) . '</strong>';
                /**
				 * [backend-step-08] 
				 * 📝 Output the alternate shipping instructions here!
				 */

				 /**
				 * [backend-step-08-extra-credit]
				 * 💰 Extra credit: Don't show the other value if the `shipping_workshop_alternate_shipping_instruction` is not `other`.
				 * 
				 * Output the shipping instructions in the order admin by echoing them here.
				 */
                echo '</div>';
            }
        );
    }

	/**
     * Adds the address on the order confirmation page.
     */
	private function show_shipping_instructions_in_order_confirmation() {
		/**
		 * [backend-step-09-extra-credit]
		 * Add your code here …
		 */
	}

	/**
	 * Adds the address on the order confirmation email.
	 */
	public function show_shipping_instructions_in_order_email() {
		/**
		 * [backend-step-10-extra-credit]
		 * Add your code here …
		 */
	}

	/**
	 * Registers the main JS file required to add filters and Slot/Fills.
	 */
	private function register_main_integration() {
		$script_path = 'build/index.js';
		$style_path  = 'build/style-index.css';

		$script_url = NBDESIGNER_PLUGIN_URL . $script_path;
		$style_url  = NBDESIGNER_PLUGIN_URL . $style_path;

		$script_asset_path = NBDESIGNER_PLUGIN_DIR . 'build/index.asset.php';
		$script_asset      = file_exists( $script_asset_path )
			? require $script_asset_path
			: [
				'dependencies' => [],
				'version'      => $this->get_file_version(  ),
			];
		wp_register_script(
			'cart-blocks-integration',
			$script_url,
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);
		wp_set_script_translations(
			'cart-blocks-integration',
			'cart',
			NBDESIGNER_PLUGIN_DIR . '/languages'
		);
	}

	/**
	 * Returns an array of script handles to enqueue in the frontend context.
	 *
	 * @return string[]
	 */
	public function get_script_handles() {
		return [ 'cart-blocks-integration', 'cart-block-frontend' ];
	}

	/**
	 * Returns an array of script handles to enqueue in the editor context.
	 *
	 * @return string[]
	 */
	public function get_editor_script_handles() {
		return [ 'cart-blocks-integration', 'cart-block-editor' ];
	}

	/**
	 * An array of key, value pairs of data made available to the block on the client side.
	 *
	 * @return array
	 */
	public function get_script_data() {
		$data = [
			'cart-active' => true,
		];

		return $data;

	}

	public function register_shipping_workshop_block_editor_styles() {
		$style_url = NBDESIGNER_PLUGIN_URL . 'build/style-cart-block.css';
		wp_enqueue_style(
			'cart-block',
			$style_url,
			[],
			$this->get_file_version( $style_url )
		);
	}

	public function register_shipping_workshop_block_editor_scripts() {
		$script_path       = 'build/cart-block.js';
		$script_url        = NBDESIGNER_PLUGIN_URL . $script_path;
		$script_asset_path = NBDESIGNER_PLUGIN_DIR . 'build/cart-block.asset.php';
		$script_asset      = file_exists( $script_asset_path )
			? require $script_asset_path
			: [
				'dependencies' => [],
				'version'      => $this->get_file_version( ),
			];

		wp_register_script(
			'cart-block-editor',
			$script_url,
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);

		wp_set_script_translations(
			'cart-block-editor',
			'cart',
			NBDESIGNER_PLUGIN_DIR . '/languages'
		);
	}

	public function register_shipping_workshop_block_frontend_scripts() {
		$script_path       = 'build/cart-block-frontend.js';
		$script_url        = NBDESIGNER_PLUGIN_URL . $script_path;
		$script_asset_path = NBDESIGNER_PLUGIN_DIR . 'build/cart-block-frontend.asset.php';
		$script_asset      = file_exists( $script_asset_path )
			? require $script_asset_path
			: [
				'dependencies' => [],
				'version'      => $this->get_file_version(  ),
			];

		wp_register_script(
			'cart-block-frontend',
			$script_url,
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);
		wp_set_script_translations(
			'cart-block-frontend',
			'cart',
			NBDESIGNER_PLUGIN_DIR . '/languages'
		);
	}

	/**
	 * Get the file modified time as a cache buster if we're in dev mode.
	 *
	 * @param string $file Local path to the file.
	 * @return string The cache buster value to use for the given file.
	 */
	protected function get_file_version( $file ) {
		return NBDESIGNER_VERSION;
	}
}
