<?php
ini_set('display_errors', '0');     # don't show any errors...
//error_reporting(E_ALL | E_STRICT);

// For debugging - show template file
/*add_action('wp_head', 'show_template');
function show_template() {
    global $template;
    print_r($template);
}*/


/*-----------------------------------------------------------------------------------*/
/* Include Advanced Custom fields file */
/*-----------------------------------------------------------------------------------*/
require_once get_template_directory() . '/plugins/theme-advanced-custom-fields.php';



/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = get_template_directory() . '/functions/';
$includes_path = get_template_directory() . '/includes/';

// Define the theme-specific key to be sent to PressTrends.
define( 'WOO_PRESSTRENDS_THEMEKEY', 'n1dn6c7iqygev2hdokl203wf3s73mabgf' );

// WooFramework
require_once ($functions_path . 'admin-init.php' );			// Framework Init
 
/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks
				'includes/theme-comments.php', 			// Custom comments/pingback loop
				'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php',			// Theme widgets
				'includes/theme-install.php',			// Theme Installation
				'includes/theme-woocommerce.php',		// WooCommerce overrides
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );
				
foreach ( $includes as $i ) {
	locate_template( $i, true );
}

/*-----------------------------------------------------------------------------------*/
/* CUSTOM FUNCTIONS
/*-----------------------------------------------------------------------------------*/

/**
 * Check if WooCommerce is active and load custom libraries
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	if ( class_exists( 'WC_Shipping' ) ) {
		// load in custom shipping function
		require_once dirname(__FILE__) . '/functions/classes/class-wc-guymark-shipping.php';
	}
	
	
	if ( class_exists( 'WC_Payment_Gateway' ) ) {
		// load in the quotation gateway
		require_once dirname(__FILE__) . '/functions/classes/class-wc-gateway-quote.php';
	}
}


/*
 * Replace unwanted chars in a string
 */
function db_make_readable( $string ) {
	$replacements = array('-', '_');
	$formatted_string = str_replace($replacements, " ", $string);
	
	return $formatted_string;
}



/**
 * Get a limited length excerpt.
 */
function the_excerpt_max_charlength( $charlength, $excerpt) {
	
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}



/**
 * Get the post thumb or default image with specified size
 * Requires a default image to fall back to. /images/default_thumbnail.jpg
 * 
 * @var $ID = Image ID (not post ID).
 * @var $size = Size as defined by wordpress media sizes, http://codex.wordpress.org/Function_Reference/the_post_thumbnail
 * @var $profile = Support a profile image fallback if required
 */
function DB_get_image_with_fallback( $ID, $size="", $profile = false ) {
	
	if( $size == "" ) $size = 'thumbnail';
	
	if( $profile ) {
		$default_image	= get_template_directory_uri() . "/images/no_profile.jpg";
	} else {
		$default_image	= get_template_directory_uri() . "/images/default_image.png";
	}
	
	$thumb			= wp_get_attachment_image_src($ID, $size);
	
	$image			= $thumb[0] ? $thumb[0] : $default_image;
	
	return $image;
}




/**
 * Load custom header script for theme
 */
function DB_header_scripts() {
	wp_enqueue_script('jquery');
	if( is_home() || is_front_page() ) {
		// load in footer
		 wp_register_script('cycle',  get_template_directory_uri() . '/includes/js/jquery.cycle2.min.js', array(), '2', true); // cycle
		 wp_enqueue_script('cycle'); // Enqueue it!
	}
}
if (!is_admin()) add_action('wp_enqueue_scripts', 'DB_header_scripts');



/**
 * Local function for debug
 */
function print_pre( $debug_val ) {
	echo "<pre>";
		print_r($debug_val);
	echo "</pre>";
}


/**
 * Removes 'Appearance' -> 'Customize'.
 */
function remove_submenus() {
	global $submenu;
	unset($submenu['themes.php'][6]);
}
add_action('admin_menu', 'remove_submenus');



/**
 * Register taxonomy for images
 */
function guymark_register_taxonomy_for_images() {
	register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init', 'guymark_register_taxonomy_for_images' );



/**
 * Add a category filter to images
 */
function guymark_add_image_category_filter() {
	
	$screen = get_current_screen();
	if ( 'upload' == $screen->id ) {
		$dropdown_options = array( 'show_option_all' => __( 'View all categories', 'woocommerce' ), 'hide_empty' => false, 'hierarchical' => true, 'orderby' => 'name', );
		wp_dropdown_categories( $dropdown_options );
	}
}
add_action( 'restrict_manage_posts', 'guymark_add_image_category_filter' );




/**
 * Disable credit card payments if outside of allowed countries
 *
 */
add_filter( 'woocommerce_available_payment_gateways', 'payment_gateway_disable_country');

function payment_gateway_disable_country( $available_gateways ) {
	global $woocommerce;
	
	$pay_for_order	= (bool) $_GET['pay_for_order'];
	
	if( isset($_GET['order_id']) && $pay_for_order ) {
		$order_id		= (int) $_GET['order_id'];
		$order_root_key	= (string) $_GET['order'];
		// Does the order with this id set?
		if( ($order_check = new WC_Order($order_id)) && $pay_for_order ) {
			// Check if the key is the same as passed (match order id and key)
			if( $order_check->order_custom_fields['_order_key'][0] == $order_root_key){
				// Remove quote option
				unset(  $available_gateways['quote'] );
			}else {
				return $available_gateways;
			}
		}
	}else {
		$flat_fee_countries = get_option('woocommerce_flat_rate_settings');
		
		// Remove credit card option / display quote option depending on country selected
		if ( isset( $available_gateways['securetrading'] ) && !in_array($woocommerce->customer->get_country(), $flat_fee_countries['countries']) ) {
			unset( $available_gateways['securetrading'] );
		}else {
			unset( $available_gateways['quote'] );
		}
	}
	return $available_gateways;
}



add_filter( 'woocommerce_available_shipping_methods', 'hide_all_shipping_when_country_not_in_list', 10, 1 );
/**
 * Hide ALL shipping options when outside of allowed countries
 *
 */
function hide_all_shipping_when_country_not_in_list( $available_methods ) {
	global $woocommerce;
	
	$flat_fee_countries = get_option('woocommerce_flat_rate_settings');
	if( isset( $available_methods['flat_rate'] ) && in_array( $woocommerce->customer->get_country(), $flat_fee_countries['countries'] ) ) {
		// remove standard shipping option
		unset( $available_methods['payment_on_quote'] );
		
	}elseif( isset($available_methods['flat_rate']) ) {
		unset( $available_methods['flat_rate'] );
	}
	return $available_methods;
}



// Exclude categories from search

// Categories to exclude, called by filter
function DB_cats_to_exclude() {
	
	// Cats to exclude
	$names = array(
				'home-page-slides',
			);
	
	$cat_ids = array();
	
	foreach( $names as $cat ) {
		$id = get_term_by( 'slug', $cat, 'category');
		if( $id ) {
			$cat_ids[] = '-' . $id->term_id;
		}
	}
	
	return implode(',' , $cat_ids);
}


add_filter( 'pre_get_posts', 'DB_search_filter' );
function DB_search_filter( $query ) {
 	
 	if( $cats_exclude = DB_cats_to_exclude() ) {
		if ( $query->is_search && !is_admin() ) {
			$query->set( 'cat', ''.$cats_exclude.'' );
		}
	}
	return $query;
}


// Breadcrumb filtering as products featured twice (TODO)
/*add_filter( 'woo_breadcrumbs_trail', 'DB_breadcrumbs_trail' );
function DB_breadcrumbs_trail( $trail, $args ) {
	//print_pre($trail);
}*/




function PJ_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'PJ_excerpt_more');


function PJ_editor_styles() {
    add_editor_style( 'editor.css' );
	$font_url = 'http://fonts.googleapis.com/css?family=Lato:300,400,700';
    add_editor_style( str_replace( ',', '%2C', $font_url ) );
}
add_action( 'init', 'PJ_editor_styles' );


add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args' );
 
function custom_woocommerce_get_catalog_ordering_args( $args ) {
  $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
 
	if ( 'manufacturer' == $orderby_value ) {
		$args['orderby'] = 'meta_value';
		$args['order'] = 'ASC';
		$args['meta_key'] = 'manufacturer';
	}
 
	return $args;
}
 
add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );
 
function custom_woocommerce_catalog_orderby( $sortby ) {
	$sortby['manufacturer'] = 'Sort by manufacturer: a-z';
	return $sortby;
}





if(!is_admin()){
	add_action('pre_get_posts', 'set_per_page');
}
function set_per_page( $query ) {
	if ( !$query->is_main_query() ) return $query;
	global $wp_the_query;
	
	
	// PJ: Show only products which are available for purchase.
	if(is_product_category()){
		if(!empty($_GET['filter'])){
			$filter = strtolower($_GET['filter']);
			if($filter == "shop"){
				$query->set('meta_query', array(
					array(
						'key'     => 'available_for_purchase',
						'value'   => 1
					)
				));
			}
		}
		// set_query_var( 'product_cat', "test, auditdata-spares");
	}

	return $query;
}








?>
