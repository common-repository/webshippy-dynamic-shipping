<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Ws_Dynamic_Shipping
 * @subpackage Ws_Dynamic_Shipping/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Ws_Dynamic_Shipping
 * @subpackage Ws_Dynamic_Shipping/admin
 * @author     Denes Nagy <denes@colorandcode.hu>
 */
class Ws_Dynamic_Shipping_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Include shipping method classes
	 */
	public function add_shipping_methods()
	{

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ws-prime-shipping-method.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ws-prio-nextday-shipping-method.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ws-gls-shipping-method.php';

	}

}
