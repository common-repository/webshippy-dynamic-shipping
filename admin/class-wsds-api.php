<?php

/**
 * Handling Webshippy API request
 *
 * @since      1.0.0
 *
 * @package    Ws_Dynamic_Shipping
 * @subpackage Ws_Dynamic_Shipping/admin
 */

/**
 * Handling Webshippy API request
 *
 * Connects the WS API and handles communication
 * mainly get obtain the available shipping methods
 *
 * @package    Ws_Dynamic_Shipping
 * @subpackage Ws_Dynamic_Shipping/admin
 * @author     Denes Nagy <denes@colorandcode.hu>
 */
class Ws_Dynamic_Shipping_API {
    protected $api_url = 'https://app.webshippy.com/betaapi/';
    protected $api_key;

	public function __construct()
    {
        $this->api_key = esc_attr(get_option('webshippy_secrect'));
    }

    public function get_shipping_methods($zip_code, $country_code, $cart_contents )
    {
    	$args = array(
    		'headers' => array(
    			'accept' => 'application/json',
    			'Api-Key' => $this->api_key,
    		)
    	);

    	$data = array(
			'countryCode' => $country_code,
			'zipCode' => $zip_code,
			'cart' => json_encode($cart_contents),
    	);

    	$url = $this->api_url . 'shipping?' . http_build_query($data);
 		$request = wp_remote_get($url, $args);

        if( is_wp_error( $request ) ) {
			$available_methods = array();
            error_log($request->get_error_message());
		} else {
			$body = wp_remote_retrieve_body($request);
			$available_methods = json_decode($body);
		}

        return $available_methods;
    }
}
