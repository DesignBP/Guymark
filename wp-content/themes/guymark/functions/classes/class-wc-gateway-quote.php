<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Quote Payment Gateway
 *
 * Provides a Quote Payment Gateway.
 *
 * @class 		WC_Gateway_Quote
 * @extends		WC_Payment_Gateway
 * @version		1.0.0
 * @author 		Darren Bayliss
 */
class WC_Gateway_Quote extends WC_Payment_Gateway {

    /**
     * Constructor for the gateway.
     *
     * @access public
     * @return void
     */
	public function __construct() {
        $this->id				= 'quote';
        $this->icon 			= apply_filters('woocommerce_cheque_icon', '');
        $this->has_fields 		= false;
        $this->method_title     = __( 'Quote', 'woocommerce' );

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables
		$this->title       = $this->get_option( 'title' );
		$this->description = $this->get_option( 'description' );

		// Actions
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
    	add_action( 'woocommerce_thankyou_quote', array( $this, 'thankyou_page' ) );

    	// Customer Emails
    	add_action( 'woocommerce_email_before_order_table', array( $this, 'email_instructions' ), 10, 2 );
    }


    /**
     * Initialise Gateway Settings Form Fields
     *
     * @access public
     * @return void
     */
    function init_form_fields() {

    	$this->form_fields = array(
			'enabled' => array(
							'title' => __( 'Enable/Disable', 'woocommerce' ),
							'type' => 'checkbox',
							'label' => __( 'Enable Quote Payment', 'woocommerce' ),
							'default' => 'yes'
						),
			'title' => array(
							'title' => __( 'Title', 'woocommerce' ),
							'type' => 'text',
							'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
							'default' => __( 'Request a shipping Quote', 'woocommerce' ),
							'desc_tip'      => true,
						),
			'description' => array(
							'title' => __( 'Customer Message', 'woocommerce' ),
							'type' => 'textarea',
							'description' => __( 'Let the customer know the next steps required before the order can be shipped.', 'woocommerce' ),
							'default' => __( "Once you have submitted your order for quote, we'll review delivery costs and send you an email with a direct pay link.", 'woocommerce' )
						)
			);

    }


	/**
	 * Admin Panel Options
	 * - Options for bits like 'title' and availability on a country-by-country basis
	 *
	 * @access public
	 * @return void
	 */
	public function admin_options() {

    	?>
    	<h3><?php _e( 'Quote Request', 'woocommerce' ); ?></h3>
    	<p><?php _e( 'Allows user to request a quote if outside of key delivery locations.', 'woocommerce' ); ?></p>
    	<table class="form-table">
    	<?php
    		// Generate the HTML For the settings form.
    		$this->generate_settings_html();
    	?>
		</table><!--/.form-table-->
    	<?php
    }


    /**
     * Output for the order received page.
     *
     * @access public
     * @return void
     */
	function thankyou_page() {
		if ( $description = $this->get_description() )
        	echo wpautop( wptexturize( $description ) );
	}


    /**
     * Add content to the WC emails.
     *
     * @access public
     * @param WC_Order $order
     * @param bool $sent_to_admin
     * @return void
     */
	function email_instructions( $order, $sent_to_admin ) {
    	if ( $sent_to_admin ) return;

    	if ( $order->status !== 'on-hold') return;

    	if ( $order->payment_method !== 'quote') return;

		if ( $description = $this->get_description() )
        	echo wpautop( wptexturize( $description ) );
	}


    /**
     * Process the payment and return the result
     *
     * @access public
     * @param int $order_id
     * @return array
     */
	function process_payment( $order_id ) {
		global $woocommerce;

		$order = new WC_Order( $order_id );

		// Mark as on-hold (we're awaiting the cheque)
		$order->update_status('on-hold', __( 'Awaiting admin quote', 'woocommerce' ));

		// Reduce stock levels
		$order->reduce_order_stock();

		// Remove cart
		$woocommerce->cart->empty_cart();

		// Return thankyou redirect
		return array(
			'result' 	=> 'success',
			'redirect'	=> add_query_arg('key', $order->order_key, add_query_arg('order', $order_id, get_permalink(woocommerce_get_page_id('thanks'))))
		);

	}

}

add_action( 'plugins_loaded', 'init_WC_Gateway_Quote' );
function init_WC_Gateway_Quote() {
	class WC_Gateway_Quote extends WC_Payment_Gateway {}
}

function add_WC_Gateway_Quote( $methods ) {
	$methods[] = 'WC_Gateway_Quote'; 
	return $methods;
}

add_filter( 'woocommerce_payment_gateways', 'add_WC_Gateway_Quote' );
