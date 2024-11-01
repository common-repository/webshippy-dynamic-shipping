<?php

/**
 * Fired during plugin activation
 *
 * @since      1.0.0
 *
 * @package    Ws_Dynamic_Shipping
 * @subpackage Ws_Dynamic_Shipping/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ws_Dynamic_Shipping
 * @subpackage Ws_Dynamic_Shipping/includes
 * @author     Denes Nagy <denes@colorandcode.hu>
 */
class Ws_Dynamic_Shipping_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {


	    if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
	      include_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	    }

	    if ( ! current_user_can( 'activate_plugins' ) ) {
	      // Deactivate the plugin.
	      deactivate_plugins( plugin_basename( __FILE__ ) );

	      $error_message = __( 'You do not have proper authorization to activate a plugin!', 'ws-dynamic-shipping' );
	      die( esc_html( $error_message ) );
	    }

	    if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ||
	    	! in_array( 'webshippy/webshippy.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	      // Deactivate the plugin.
	      deactivate_plugins( plugin_basename( __FILE__ ) );

	      // Throw an error in the WordPress admin console.
	      $error_message = __( '"Webshippy Dynamic Shipping" is not working because you need to install and activate the following plugins: "WooCommerce", "Webshippy Order Sync"', 'ws-dynamic-shipping' );

	      die( wp_kses_post( $error_message ) );
	    }
	}

}
