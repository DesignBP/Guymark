<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Wishlist email format
 *
 * An email sent to the customer when they email their wishlists.
 *
 * @class 		WC_Email_Guymark_Wishlist
 * @version		1
 * @package		includes
 * @author 		@darren_bayliss
 * @extends 	WC_Emails
 */
class WC_Email_Guymark_Wishlist extends WC_Emails {
	
	// instantiate with these vars in array
	var $wishlist_body_vars;
	
	
	/**
	 * Constructor
	 *
	 * @access public
	 * @return void
	 */
	function __construct( $wishlist_body_vars ) {
		
		
		
		$this->template_html 	= 'woocommerce/emails/wishlist-body.php';
		$this->template_plain 	= 'woocommerce/emails/plain/wishlist-body.php';
		
		$this->combined_vars	= $wishlist_body_vars;
		
		$this->wishlist_id		= $wishlist_body_vars['wishlist_id'];
		$this->wishlist_title	= $wishlist_body_vars['wishlist_title'];
		$this->wishlist_items	= $wishlist_body_vars['wishlist_items'];
		$this->senders_name		= $wishlist_body_vars['senders_name'];
		$this->senders_note		= $wishlist_body_vars['senders_note'];
		$this->wishlist_url		= $wishlist_body_vars['wishlist_url'];
		$this->recipients		= $wishlist_body_vars['recipients'];
		
		$this->from				= woocommerce_wishlist_get_from_address();
		
		var_dump($this->combined_vars);
		
		// Call parent constuctor
		parent::__construct();
	}

	/**
	 * trigger function.
	 *
	 * @access public
	 * @return void
	 */
	function trigger() {
		global $woocommerce;
		
		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
	}

	/**
	 * get_content_html function.
	 *
	 * @access public
	 * @return string
	 */
	function get_content_html() {
		ob_start();
		woocommerce_get_template( $this->template_html, $this->combined_vars);
		return ob_get_clean();
	}

	/**
	 * get_content_plain function.
	 *
	 * @access public
	 * @return string
	 */
	function get_content_plain() {
		ob_start();
		woocommerce_get_template( $this->template_plain, $this->combined_vars);
		return ob_get_clean();
	}
}
