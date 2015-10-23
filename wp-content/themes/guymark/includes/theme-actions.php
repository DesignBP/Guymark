<?php


/*-----------------------------------------------------------------------------------*/
/* Clean up head */
/*-----------------------------------------------------------------------------------*/
// Clean up head
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action( 'wp_head', 'woo_version');

function my_woocommerce_loaded_function() {
	global $woocommerce;
 
	// remove WC generator tag from <head>
	remove_action( 'wp_head', array( $woocommerce, 'generator' ) );
}

// called only after woocommerce has finished loading
add_action( 'woocommerce_init', 'my_woocommerce_loaded_function' );




/*-----------------------------------------------------------------------------------*/
/* woo_feedburner_link() */
/*-----------------------------------------------------------------------------------*/
/**
 * woo_feedburner_link()
 *
 * Replace the default RSS feed link with the Feedburner URL, if one
 * has been provided by the user.
 *
 * @package WooFramework
 * @subpackage Filters
 */

add_filter( 'feed_link', 'woo_feedburner_link', 10 );

function woo_feedburner_link ( $output, $feed = null ) {

	global $woo_options;

	$default = get_default_feed();

	if ( ! $feed ) $feed = $default;

	if ( $woo_options[ 'woo_feed_url' ] && ( $feed == $default ) && ( ! stristr( $output, 'comments' ) ) ) $output = esc_url( $woo_options[ 'woo_feed_url' ] );

	return $output;

} // End woo_feedburner_link()


/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>
