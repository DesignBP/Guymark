<?php
/*
Plugin Name: WooCommerce SecureTrading Gateway
Plugin URI: http://woothemes.com/woocommerce
Description: Extends WooCommerce. Provides a <a href="http://www.securetrading.com" target="_blank">SecureTrading</a> gateway for WooCommerce.
Version: 1.4.2
Author: Krokedil
Author URI: http://krokedil.com
*/

/*  Copyright 2011-2014  Krokedil Produktionsbyrå AB  (email : info@krokedil.se)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    
*/

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) )
	require_once( 'woo-includes/woo-functions.php' );

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '64e9286cb83e0b34b0c669844749be0e', '18631' );

// Init SecureTrading Gateway after WooCommerce has loaded
add_action('plugins_loaded', 'init_securetrading_gateway', 0);

function init_securetrading_gateway() {
	
	// If the WooCommerce payment gateway class is not available, do nothing
	if ( !class_exists( 'WC_Payment_Gateway' ) ) return;
	
	class WC_Gateway_Securetrading extends WC_Payment_Gateway {
			
		public function __construct() { 
			global $woocommerce;
	        $this->id				= 'securetrading';
	        $this->method_title 	= __('SecureTrading', 'woothemes');
	        $this->icon 			= plugins_url(basename(dirname(__FILE__))."/images/securetrading_logo.png");
	        $this->has_fields 		= false;
	        $this->liveurl			= 'https://payments.securetrading.net/process/payments/choice';
	        $this->version			= 1;
	        $this->log = 			WC_St_Compatibility::new_wc_logger();
	        
	        // Load the form fields.
			$this->init_form_fields();
			
			// Load the settings.
			$this->init_settings();
			
			// Define user set variables
	      	$this->enabled			= ( isset( $this->settings['enabled'] ) ) ? $this->settings['enabled'] : '';
	      	$this->title			= ( isset( $this->settings['title'] ) ) ? $this->settings['title'] : '';
			$this->description		= ( isset( $this->settings['description'] ) ) ? $this->settings['description'] : '';
			$this->sitereference	= ( isset( $this->settings['sitereference'] ) ) ? $this->settings['sitereference'] : '';
			$this->password			= ( isset( $this->settings['password'] ) ) ? $this->settings['password'] : '';
			$this->parentcss		= ( isset( $this->settings['parentcss'] ) ) ? $this->settings['parentcss'] : '';
			$this->childcss			= ( isset( $this->settings['childcss'] ) ) ? $this->settings['childcss'] : '';
			$this->parentjs			= ( isset( $this->settings['parentjs'] ) ) ? $this->settings['parentjs'] : '';
			$this->childjs			= ( isset( $this->settings['childjs'] ) ) ? $this->settings['childjs'] : '';
			$this->debug			= ( isset( $this->settings['debug'] ) ) ? $this->settings['debug'] : '';
		
			
			// Actions
			add_action( 'woocommerce_api_wc_gateway_securetrading', array(&$this, 'check_securetrading_response') );
			add_action( 'valid-securetrading-request', array(&$this, 'successful_request') );
			add_action( 'woocommerce_receipt_securetrading', array(&$this, 'receipt_page') );
			
			/* 1.6.6 */
			add_action( 'woocommerce_update_options_payment_gateways', array( &$this, 'process_admin_options' ) );
			
			/* 2.0.0 */
			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
	    } 


		/**
    	 * Initialise Gateway Settings Form Fields
    	 */
    	function init_form_fields() {
    	
    		$this->form_fields = array(
				'enabled' => array(
								'title' => __( 'Enable/Disable', 'woothemes' ), 
								'type' => 'checkbox', 
								'label' => __( 'Enable SecureTrading', 'woothemes' ), 
								'default' => 'yes'
							), 
				'title' => array(
								'title' => __( 'Title', 'woothemes' ), 
								'type' => 'text', 
								'description' => __( 'This controls the title which the user sees during checkout.', 'woothemes' ), 
								'default' => __( 'SecureTrading', 'woothemes' )
							),
				'description' => array(
								'title' => __( 'Description', 'woothemes' ), 
								'type' => 'textarea', 
								'description' => __( 'This controls the title which the user sees during checkout.', 'woothemes' ), 
								'default' => __( 'Pay via Credit Card, Debit Card and other payment methods such as PayPal and Ukash with SecureTrading secure card processing.', 'woothemes' ),
							),
				'sitereference' => array(
								'title' => __( 'SecureTrading SiteReference', 'woothemes' ), 
								'type' => 'text', 
								'description' => __( 'Please enter your SecureTrading SiteReference; this is needed in order to take payment!', 'woothemes' ), 
								'default' => ''
							),
				'password' => array(
								'title' => __( 'SecureTrading Password', 'woothemes' ), 
								'type' => 'text', 
								'description' => __( 'Please enter your SecureTrading Password; this is needed in order to take payment!', 'woothemes' ), 
								'default' => ''
							),
				'parentcss' => array(
								'title' => __( 'Parent CSS', 'woothemes' ), 
								'type' => 'text', 
								'description' => __( 'The name of the parent CSS file (without the file extension ".css") uploaded to SecureTrading via the MyST file manager. Leave blank to use the ST default.', 'woothemes' ), 
								'default' => ''
							),
				'childcss' => array(
								'title' => __( 'Child CSS', 'woothemes' ), 
								'type' => 'text', 
								'description' => __( 'The name of the child CSS file (without the file extension ".css") uploaded to SecureTrading via the MyST file manager. Leave blank to use the ST default.', 'woothemes' ), 
								'default' => ''
							),
				'parentjs' => array(
								'title' => __( 'Parent JS', 'woothemes' ), 
								'type' => 'text', 
								'description' => __( 'The name of the parent JS file (without the file extension ".js") uploaded to SecureTrading via the MyST file manager. Leave blank to use the ST default.', 'woothemes' ), 
								'default' => ''
							),
				'childjs' => array(
								'title' => __( 'Child JS', 'woothemes' ), 
								'type' => 'text', 
								'description' => __( 'The name of the child JS file (without the file extension ".js") uploaded to SecureTrading via the MyST file manager. Leave blank to use the ST default.', 'woothemes' ), 
								'default' => ''
							),
				'debug' => array(
							'title' => __( 'Debug', 'woothemes' ), 
							'type' => 'checkbox', 
							'label' => __( 'Enable logging (<code>woocommerce/logs/securetrading.txt</code>)', 'woothemes' ), 
							'default' => 'no'
						)
				);
    
		} // End init_form_fields()
		
		
		/**
	 	* Admin Panel Options 
	 	* - Options for bits like 'title' and availability on a country-by-country basis
	 	*
	 	* @since 1.0.0
	 	*/
		public function admin_options() {
	
	    	?>
	    	<h3><?php _e('SecureTrading', 'woothemes'); ?></h3>
	    	
	    	<p><?php printf(__('SecureTrading works by sending the user to <a href="http://www.securetrading.com">SecureTrading</a> to enter their payment information. Instructions on how to set up the SecureTrading account settings can be found in the <a target="_blank" href="%s">documentation</a>.', 'woothemes'), 'http://wcdocs.woothemes.com/user-guide/extensions/securetrading/' ); ?></p>
	    	
	    	
    		<table class="form-table">
    		<?php
    			// Generate the HTML For the settings form.
    			$this->generate_settings_html();
    		?>
			</table><!--/.form-table-->
    		<?php
    	} // End admin_options()
    
	    
	    
	    /**
		 * There are no payment fields for SecureTrading, but we want to show the description if set.
		 **/
		function payment_fields() {
			if ($this->description) echo wpautop(wptexturize($this->description));
		}
	    
	    	    
		/**
	 	* Generate the SecureTrading button link
	 	**/
		public function generate_securetrading_form( $order_id ) {
			global $woocommerce;

			$order = new WC_Order( $order_id );
			$securetrading_adr = $this->liveurl;	
						
			// Create MD5 hash
			$string_to_hash = $this->sitereference . get_option('woocommerce_currency') . $order->order_total . $this->password;
			$check_key = md5($string_to_hash);	
				
			
			$securetrading_args = array_merge(
				array(
					'sitereference' 		=> $this->sitereference,
					'version' 				=> $this->version,
					
					'orderreference'		=> ltrim( $order->get_order_number(), '#'),
					
					// Currency
					'currencyiso3a' 		=> get_option('woocommerce_currency'),
					
					// Address info
					'billingfirstname'		=> $order->billing_first_name,
					'billinglastname'		=> $order->billing_last_name,
					'billingpremise'		=> $order->billing_address_1,
					'billingstreet'			=> $order->billing_address_2,
					'billingtown'			=> $order->billing_city,
					'billingpostcode'		=> $order->billing_postcode,
					'billingcounty'			=> $order->billing_state,
					'billingcountry'		=> $order->billing_country,
					'billingcountryiso2a'	=> $order->billing_country,
					'billingemail'			=> $order->billing_email,
					'billingtelephone'		=> $order->billing_phone,
					'billingtelephonetype'	=> 'M',
					
					'customerpremise'		=> $order->shipping_address_1,
					'customerstreet'		=> $order->shipping_address_2,
					'customertown'			=> $order->shipping_city,
					'customerpostcode'		=> $order->shipping_postcode,
					'customercounty'		=> $order->shipping_state,
					'customercountry'		=> $order->shipping_country,
					'customercountryiso2a'	=> $order->shipping_country,
				
					// Payment Info
					'mainamount'			=> $order->order_total,
					
					// Security
					'sitesecurity'			=> $check_key
				)
			);

			// Parent CSS
			if( !empty($this->parentcss)) {
				
				$securetrading_args['parentcss'] = $this->parentcss;
			}
			
			// Child CSS
			if( !empty($this->childcss)) {
				
				$securetrading_args['childcss'] = $this->childcss;
			}
			
			// Parent JS
			if( !empty($this->parentjs)) {
				
				$securetrading_args['parentjs'] = $this->parentjs;
			}
			
			// Child JS
			if( !empty($this->childjs)) {
				
				$securetrading_args['childjs'] = $this->childjs;
			}
			
			// Apply filters to the $args array
			$securetrading_args = apply_filters('securetrading_checkout_form', $securetrading_args);
			
			// Prepare the form	
			$securetrading_args_array = array();
			foreach ($securetrading_args as $key => $value) {
				$securetrading_args_array[] = '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
			}
			
			// The form
			if ($this->debug=='yes') $this->log->add( 'securetrading', 'Printing form' );
			
						WC_St_Compatibility::wc_enqueue_js( '
							jQuery("body").block({
								message: "' . esc_js( __( 'Thank you for your order. We are now redirecting you to SecureTrading to make payment.', 'woocommerce' ) ) . '",
								baseZ: 99999,
								overlayCSS:
								{
									background: "#fff",
									opacity: 0.6
								},
								css: {
									padding:        "20px",
									zindex:         "9999999",
									textAlign:      "center",
									color:          "#555",
									border:         "3px solid #aaa",
									backgroundColor:"#fff",
									cursor:         "wait",
									lineHeight:		"24px",
								}
							});
							jQuery("#submit_securetrading_payment_form").click();
						' );
					
			return '<form action="'.$securetrading_adr.'" method="post" id="securetrading_payment_form">
					' . implode('', $securetrading_args_array) . '
					<input type=hidden name="_charset_" value="UTF-8"/>
					<input type="submit" class="button alt" id="submit_securetrading_payment_form" value="'.__('Pay via SecureTrading', 'woothemes').'" /> <a class="button cancel" href="'.$order->get_cancel_order_url().'">'.__('Cancel order &amp; restore cart', 'woothemes').'</a>
					</form>';
			
		}

		
		/**
		 * Process the payment and return the result
		 **/
		function process_payment( $order_id ) {
			
			$order = new WC_Order( $order_id );
			
			// Prepare redirect url
			if( WC_St_Compatibility::is_wc_version_gte_2_1() ) {
	    		$redirect_url = $order->get_checkout_payment_url( true );
			} else {
	    		$redirect_url = add_query_arg('order', $order->id, add_query_arg('key', $order->order_key, get_permalink(get_option('woocommerce_pay_page_id'))));
			}
			
			return array(
				'result' 	=> 'success',
				'redirect'	=> $redirect_url
			);
			
		}

		
		/**
		 * receipt_page
		 **/
		function receipt_page( $order ) {
			
			echo '<p>'.__('Thank you for your order, please click the button below to pay with SecureTrading.', 'woothemes').'</p>';
			
			echo $this->generate_securetrading_form( $order );
			
		}
		
		
		/**
	 	* Check SecureTrading Response validity
	 	**/
		function check_securetrading_request_is_valid() {
			global $woocommerce;
		
			if ($this->debug=='yes') $this->log->add( 'securetrading', 'Checking SecureTrading response is valid...' );
			
			// Send back post vars to SecureTrading
        	$params = array( 
        		'body' => $_REQUEST
        	);
        	
        	// Post back to get a response
        	$response = wp_remote_post( $this->liveurl, $params );
			//var_dump($response);
			// check to see if the request was valid
        	if ( !is_wp_error($response) ) {
            	if ($this->debug=='yes') $this->log->add( 'securetrading', 'Received valid response from SecureTrading' );
            	return true;
        	}
        
        	if ($this->debug=='yes') :
        		$this->log->add( 'securetrading', 'Received invalid response from SecureTrading' );
        		if (is_wp_error($response)) :
        			$this->log->add( 'securetrading', 'Error response: ' . $response->get_error_message() );
        		endif;
        	endif;
        
        	return false;
				
		}
		
		
		/**
		 * Check for SecureTrading Response
		 **/
		function check_securetrading_response() {
				
			if (isset($_GET['wc-api']) && $_GET['wc-api'] == 'WC_Gateway_Securetrading'):
				global $woocommerce;
				
				if ($this->debug=='yes') $this->log->add( 'securetrading', 'Receiving response from SecureTrading' );
				
				header('HTTP/1.1 200 OK');
	        	
	        	$_REQUEST = stripslashes_deep($_REQUEST);
	        	
	        	$order = new WC_Order( $this->get_order_id( $_GET['orderreference'] ) );
	        					
				//if ($this->check_securetrading_request_is_valid()) :
				
					// Create MD5 hash from the return values
					$string_to_hash = $_REQUEST['baseamount'] . $_REQUEST['errorcode'] . $_REQUEST['orderreference'] . $_REQUEST['transactionreference'] . $this->password;
					
					$responsesitesecurity = $_REQUEST['responsesitesecurity'];
					
					$check_key = md5($string_to_hash);
					
					// Compare hash with the one recieved from ST
					if ($check_key == $responsesitesecurity) :
						do_action("valid-securetrading-request", $_REQUEST);
					else:
						if ($this->debug=='yes') :
        					$this->log->add( 'securetrading', 'MD5 hash did not match. Our Check key: ' . $check_key );
        					$this->log->add( 'securetrading', 'Recieved key (responsesitesecurity): ' . $responsesitesecurity );
        					$this->log->add( 'securetrading', '$_REQUEST: ' . json_encode($_REQUEST) );
        					
        				endif;
					endif;
					
	       		//endif;
	       		
	       	endif;
				
		}
		
		
		/**
	 	* Successful Payment!
	 	**/
		function successful_request( $securetrading_return_values ) {
			global $woocommerce;
			
		    if ( !empty($securetrading_return_values['orderreference']) ) {
		    
				$order_id 	  	= $this->get_order_id( $securetrading_return_values['orderreference'] );
				$order 			= new WC_Order( (int) $order_id );
				$order_key		= $order->order_key;
				
				// Prepare redirect url
				if( WC_St_Compatibility::is_wc_version_gte_2_1() ) {
	    			$redirect_url = WC_St_Compatibility::get_checkout_order_received_url($order);
				} else {
	    			$redirect_url = add_query_arg('key', $order->order_key, add_query_arg('order', $order_id, get_permalink(get_option('woocommerce_thanks_page_id'))));
				}
								
		    	if ($order->status !== 'completed') {

		    		// Update the order
		    		if ( (int)$securetrading_return_values['errorcode'] !== 0 ) {
						
						// Payment failed
						$order->add_order_note( __('SecureTrading payment failed. SecureTrading Transaction Reference: ', 'woothemes') . $securetrading_return_values['transactionreference'] );
						
					} else {
			    		
			    		// Payment valid
			    		$order->add_order_note( __('SecureTrading payment completed. SecureTrading Transaction Reference: ', 'woothemes') . $securetrading_return_values['transactionreference'] );
            
			        	$order->payment_complete();
			        	$woocommerce->cart->empty_cart();
						wp_redirect( $redirect_url ); 
			    		exit;
			    	
			    	}
			        	
				}

		    }
		
		} // End function
		
		
		/**
		 * Get the order ID. Check to see if SON and SONP is enabled and
		 *
		 * @global type $wc_seq_order_number
		 * @global type $wc_seq_order_number_pro
		 * @param type $order_number
		 * @return type
		 */
		private function get_order_id( $order_number ) {
	
			// Get Order ID by order_number() if the Sequential Order Number plugin is installed
			if ( class_exists( 'WC_Seq_Order_Number' ) ) {
	
				global $wc_seq_order_number;
	
				$order_id = $wc_seq_order_number->find_order_by_order_number( $order_number );
	
				if ( 0 === $order_id ) {
					$order_id = $order_number;
				}
				
			// Get Order ID by order_number() if the Sequential Order Number Pro plugin is installed
			} elseif ( class_exists( 'WC_Seq_Order_Number_Pro' ) ) {
				
				global $wc_seq_order_number_pro;
	
				$order_id = $wc_seq_order_number_pro->find_order_by_order_number( $order_number );
	
				if ( 0 === $order_id ) {
					$order_id = $order_number;
				}
	
			} else {
			
				$order_id = $order_number;
			}
	
			return $order_id;
	
		} // end function

	} // Close class woocommerce_securetrading
	
	
	// Include the WooCommerce Compatibility Utility class
	// The purpose of this class is to provide a single point of compatibility functions for dealing with supporting multiple versions of WooCommerce (currently 2.0.x and 2.1)
	require_once 'classes/class-wc-st-compatibility.php';
	

} // Close init_securetrading_gateway

/**
 * Add the gateway to WooCommerce
 **/
function add_securetrading_gateway( $methods ) {
	$methods[] = 'WC_Gateway_Securetrading'; 
	return $methods;
}

add_filter('woocommerce_payment_gateways', 'add_securetrading_gateway' );


// WC 2.0 Update notice
class WC_Gateway_Securetrading_Update_Notice {
	
	public function __construct() {
		
		// Add admin notice about the callback change
		//add_action('admin_notices', array(&$this, 'krokedil_admin_notice'));
		//add_action('admin_init', array(&$this, 'krokedil_nag_ignore'));
	}
	
	/* Display a notice about the changes to the Invoice fee handling */
	function krokedil_admin_notice() {
	
		global $current_user ;
		$user_id = $current_user->ID;
		
		/* Check that the user hasn't already clicked to ignore the message */
		if ( ! get_user_meta($user_id, 'securetrading_callback_change_notice') && current_user_can( 'manage_options' ) ) {
			echo '<div class="updated fade"><p class="alignleft">';
			printf(__('The SecureTrading callback URL has changed. You will need to contact the SecureTrading support and send in a new STPP redirect form. Please visit <a target="_blank" href="%1$s"> the payment gateway documentation</a> for more info.', 'woothemes'), 'http://wcdocs.woothemes.com/user-guide/extensions/securetrading/#section-6');
			echo '</p><p class="alignright">';
			printf(__('<a class="submitdelete" href="%1$s"> Hide this message</a>', 'woothemes'), '?securetrading_nag_ignore=0');
			echo '</p><br class="clear">';
			echo '</div>';
		}
		
	}

	/* Hide the notice about the changes to the Invoice fee handling if ignore link has been clicked */
	function krokedil_nag_ignore() {
		global $current_user;
		$user_id = $current_user->ID;
		/* If user clicks to ignore the notice, add that to their user meta */
		if ( isset($_GET['securetrading_nag_ignore']) && '0' == $_GET['securetrading_nag_ignore'] ) {
			add_user_meta($user_id, 'securetrading_callback_change_notice', 'true', true);
		}
	}
}
$wc_securetrading_update_notice = new WC_Gateway_Securetrading_Update_Notice;