<?php
/**
 * Webshippy Prio Next Day shipping method for woocommerce
 *
 * @since      1.2.0
 *
 * @package    Ws_Dynamic_Shipping
 * @subpackage Ws_Dynamic_Shipping/admin
 */

/**
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	function ws_prio_nexday_shipping_method_init() {
		if ( ! class_exists( 'WC_WS_Prio_Nextday_Shipping_Method' ) ) {
			class WC_WS_Prio_Nextday_Shipping_Method extends WC_Shipping_Method {
				/**
				 * Constructor for your shipping class
				 *
				 * @access public
				 * @return void
				 */
				public function __construct() {
					$this->id                 = 'webshippy_3'; // Id for your shipping method. Should be uunique.
					$this->method_title       = __( 'Webshippy Prio Next Day' );  // Title shown in admin
					$this->method_description = __( 'Pre-defined shipping method for Webshippy Dynamic Shipping' ); // Description shown in admin


					$this->init();
				}

				/**
				 * Init your settings
				 *
				 * @access public
				 * @return void
				 */
				public function init() {
					// Load the settings API
					$this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
					$this->init_settings(); // This is part of the settings API. Loads settings you previously init.

					$this->title = $this->get_option( 'title' );
					$this->tax_status = $this->get_option( 'tax_status' );
					// $this->cost  = $this->get_option( 'cost' );

					// Save settings in admin if you have any defined
					add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
				}

               /**
                * Define settings field for this shipping
                * @return void
                */
               public function init_form_fields() {

                   $this->form_fields = array(
	                    'title'            => array(
	                   		'title'       => __( 'Title', 'woocommerce' ),
	                   		'type'        => 'text',
	                   		'description' => __( 'this controls the title which the user sees during checkout.', 'woocommerce' ),
	                   		'default'     => __( 'Kiszállítás a következő munkanapon.', 'ws-dynamic-shipping' ),
	                   		'desc_tip'    => true,
	                    ),
	                    'cost'       => array(
							'title'       => __( 'Shipping cost', 'woocommerce' ),
							'type'        => 'price',
							'placeholder' => wc_format_localized_price( 0 ),
							'default'     => '990',
	                    ),
						'tax_status' => array(
							'title'   => __( 'Tax status', 'woocommerce' ),
							'type'    => 'select',
							'class'   => 'wc-enhanced-select',
							'default' => 'taxable',
							'options' => array(
								'taxable' => __( 'Taxable', 'woocommerce' ),
								'none'    => _x( 'None', 'Tax status', 'woocommerce' ),
							),
						),
	               );
               }

				/**
				 * See if free shipping is available based on the package and cart.
				 *
				 * @param array $package Shipping package.
				 * @return bool
				 */
				public function is_available( $package ) {
					$is_available = true;
					return apply_filters( 'woocommerce_shipping_' . $this->id . '_is_available', $is_available, $package, $this );
				}

				/**
				 * calculate_shipping function.
				 *
				 * @access public
				 * @param mixed $package
				 * @return void
				 */
				public function calculate_shipping( $package = Array() ) {
					$rate = array(
						'label' => $this->title,
						'cost' => $this->get_option( 'cost' ),
						'calc_tax' => 'per_order'
					);

					// Register the rate
					$this->add_rate( $rate );
				}
			}
		}
	}

	add_action( 'woocommerce_shipping_init', 'ws_prio_nexday_shipping_method_init' );

	function add_ws_prio_nexday_shipping_method( $methods ) {
		$methods['webshippy_3'] = 'WC_WS_Prio_Nextday_Shipping_Method';
		return $methods;
	}

	add_filter( 'woocommerce_shipping_methods', 'add_ws_prio_nexday_shipping_method' );
}
