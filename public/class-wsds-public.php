<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Ws_Dynamic_Shipping
 * @subpackage Ws_Dynamic_Shipping/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Ws_Dynamic_Shipping
 * @subpackage Ws_Dynamic_Shipping/public
 * @author     Denes Nagy <denes@colorandcode.hu>
 */
class Ws_Dynamic_Shipping_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Get available shipping methods for shipping rates hook
	 * @param  array $rates Available rates
	 * @return array        Updated rates
	 */
	public function get_available_shipping_methods($rates)
	{
		if ( is_cart() || is_checkout()) {
			$ws_prefix = "webshippy_";
			$is_free = $this->check_free_shipping($rates);
			$ws_api = new Ws_Dynamic_Shipping_API();

			// prepare API call data
			$country_code = $this->customer_shipping_country();
			$zip_code = $this->customer_shipping_zip();
			$cart_contents = $this->get_cart_contents();

			// check WS API for available methods
			$available_methods = $ws_api->get_shipping_methods( $zip_code, $country_code, $cart_contents );
			// simplify available methods list
			$accepted_methods = $this->flatten_methods_list($available_methods);

			foreach ( $rates as $rate_id => $rate ) {
				// only affect WS methods
				if ( strpos( $rate->method_id, $ws_prefix ) !== false ) {
					// WS id from local methods
					$ws_id = (int) substr($rate->method_id, strpos($rate->method_id, $ws_prefix) + strlen($ws_prefix));

					// remove unavailable method
					if ( !in_array( $ws_id, $accepted_methods ) ) {
						unset( $rates[$rate_id] );
					}
					elseif ($is_free) {
						// set cost to 0 when free_shipping is present
						$rates[$rate_id]->cost = 0;
						$rates[$rate_id]->taxes = array();
					}
				}
			}
		}

		return $rates;
	}

	/**
	 * Get cart items data from current cart state
	 * @return array Cart conetents data
	 */
	protected function get_cart_contents()
	{
		$cart_contents = array();

		// Get WC cart object
		$cart = WC()->cart->get_cart();

		// Check cart is empty
		if (empty($cart)) {
			return $cart_contents;
		}

		foreach($cart as $key => $item ) {
			// Get current item's product object
			$product = wc_get_product($item["variation_id"] ? $item["variation_id"] : 
 $item["product_id"]);

			if ( !$product->is_virtual() ) {
		        $cart_contents[] = (object) array(
		        	'sku' => $product->get_sku(),
		        	'quantity' => $item['quantity'],
		        );
			}
	    }

	    return $cart_contents;
	}

	/**
	 * Get shipping country code by order's current state
	 * @return string Country code
	 */
	protected function customer_shipping_country()
	{
		$customer_shipping_country = WC()->customer->get_shipping_country();

		if( empty($customer_shipping_country) ){
		    $package = WC()->shipping->get_packages()[0];
		    if( ! isset($package['destination']['country']) ) {
			    $customer_shipping_country = $package['destination']['country'];
			}
		}

		return $customer_shipping_country;
	}

	/**
	 * Get shipping zip code by order's current state
	 * @return string Zip code
	 */
	protected function customer_shipping_zip()
	{
		return WC()->customer->get_shipping_postcode();
	}

	/**
	 * Create simple list from available methods data
	 * @param  array $methods_data Available methods
	 * @return array               Simple list of methods IDs
	 */
	protected function flatten_methods_list($methods_data)
	{
		$method_list = array();

		foreach ($methods_data as $method) {
			$method_list[] = $method->id;
		}

		return $method_list;
	}

	/**
	 * Check free_shipping is present in available shipping methods
	 * @param  array $rates Shipping rates
	 * @return bool        Free shipping is present
	 */
	protected function check_free_shipping($rates)
	{
		$is_free = false;
        foreach ($rates as $rate_id => $rate) {
            if ('free_shipping' === $rate->method_id) {
                $is_free = true;
                break;
            }
        }

        return $is_free;
	}

	/**
	 * Disable WC rates cache
	 * @return array	Packages
	 */
	public function disable_shipping_rates_cache($value, $name) {
		return false;
	}
}
