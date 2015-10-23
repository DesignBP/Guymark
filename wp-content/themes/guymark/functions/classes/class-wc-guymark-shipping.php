<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/*
Plugin Name: Quote Shipping plugin
Plugin URI: http://designbp.ltd.uk
Description: Quote Shipping plugin, displays a quote message for users outside of allowed countries
Version: 1.0.0
Author: Darren Bayliss (@darren_bayliss)
Author URI: http://designbp.ltd.uk
*/

class WC_Quote_Shipping_Method extends WC_Shipping_Method {
	/**
	 * Constructor for your shipping class
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->id					= 'payment_on_quote'; // Id for your shipping method. Should be uunique.
		$this->method_title			= __( 'Payment On Quote' );  // Title shown in admin
		$this->method_description	= __( 'An alternative shipping method for countries outside the allowed list set in the global shipping settings. Enabled by default.' ); // Description shown in admin
		
		$this->enabled				= "yes"; // This can be added as an setting but for this example its forced enabled
		$this->title				= "Payment On Quote"; // This can be added as a setting but for this example its forced.
		
		$this->init();
	}
	
	/**
	 * Init your settings
	 *
	 * @access public
	 * @return void
	 */
	function init() {
		// Load the settings API
		$this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
		$this->init_settings(); // This is part of the settings API. Loads settings you previously init.
		
		// Save settings in admin if you have any defined
		add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
	}
	
	/**
	 * calculate_shipping function.
	 *
	 * @access public
	 * @param mixed $package
	 * @return void
	 */
	public function calculate_shipping( $package ) {
		$rate = array(
			'id'		=> $this->id,
			'label'		=> $this->title,
			'cost'		=> 0,
    		'taxes'		=> false
		);
			
		// Register the rate
		$this->add_rate( $rate );
	}
}



add_filter( 'woocommerce_shipping_methods', 'guymark_shipping_method' );

function guymark_shipping_method( $methods ) {
		$methods[] = 'WC_Quote_Shipping_Method';
		return $methods;
	}
?>
