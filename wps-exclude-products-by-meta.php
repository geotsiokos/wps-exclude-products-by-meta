<?php
/**
 * Plugin Name: WPS Exclude Products by meta
 * Plugin URI: https://github.com/geotsiokos/wps-pos-visibility-options/blob/master/wps-pos-visibility-options.php
 * Description: Exclude Exclude Products by meta from search results when using the Product Search Field by <a href="https://woo.com/products/woocommerce-product-search/">WooCommerce Product Search</a>
 * Version: 1.0.0
 * Author: gtsiokos
 * Author URI: http://www.netpad.gr
 * Donate-Link: http://www.netpad.gr
 * License: GPLv3
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
class WPS_Exclude_Products_By_Meta {

	public static function init() {
		add_action('woocommerce_product_search_service_post_ids_for_request', array( __CLASS__, 'woocommerce_product_search_service_post_ids_for_request' ), 10, 2 );
	}

	public static function woocommerce_product_search_service_post_ids_for_request( &$product_ids, $context ) {
		if ( !is_user_logged_in() ) {
			foreach ( $product_ids as $key => $product_id ) {
				$meta_value = get_post_meta( $product_id, 'is_hidden_for_anonymous', true );
				if ( $meta_value ) {
					unset( $product_ids[$key] );
				}
			}
		}
	}
} WPS_Exclude_Products_By_Meta::init();