<?php
/*-----------------------------------------------------------------------------------*/
/* This theme supports WooCommerce, woo! */
/*-----------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/*-----------------------------------------------------------------------------------*/
/* Any WooCommerce overrides and functions can be found here
/*-----------------------------------------------------------------------------------*/


// Load a local copy of the cart js and dequeu woocommerce version as we've made changes to the front end code
// wp_dequeue_script('wc-add-to-cart');
// wp_enqueue_script( 'wc-add-to-cart', get_bloginfo( 'stylesheet_directory' ). '/includes/js/add-to-cart.js' , array( 'jquery' ), false, true );


// Add html5 shim
add_action('wp_footer', 'wootique_html5_shim');
function wootique_html5_shim() {
?>
<!-- Load Google HTML5 shim to provide support for <IE9 -->
<!--[if lt IE 9]>
<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
}

// Disable WooCommerce styles
if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	// WooCommerce 2.1 or above is active
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	// WooCommerce is less than 2.1
	define( 'WOOCOMMERCE_USE_CSS', false );
}

/*-----------------------------------------------------------------------------------*/
/* Header
/*-----------------------------------------------------------------------------------*/

// Hook in the search
function woo_search() { woo_do_atomic( 'woo_search' ); }
add_action('woo_search', 'wootique_header_search');
function wootique_header_search() {
	?>
	<div id="search-top">
		
		<div class="screen-reader-text"><?php _e('Search by keyword, brand or code', 'woothemes'); ?></div>
		
		<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url(); ?>">
			<input type="text" value="<?php the_search_query(); ?>" name="s" id="s"  class="field s" />
			<button type="submit" name="submit" value="" class="search-button" />&nbsp;</button>
		</form>

	</div>
	<?php
}

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Adjust markup on all WooCommerce pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


add_action('woocommerce_after_main_content', 'woostore_after_content', 20);
add_action('woocommerce_after_main_content2', 'woostore_after_content2', 20);
add_action('woocommerce_after_main_content3', 'woostore_after_content3', 20);
function woostore_after_content() {
	?>
		<?php if ( is_search() && is_post_type_archive() ) { add_filter( 'woo_pagination_args', 'woocommerceframework_add_search_fragment', 10 ); } ?>
		<?php woo_pagenav(); ?>

        <?php woo_main_after(); ?>


		<?php woo_content_after(); ?>
	<?php
}
function woostore_after_content3() {
	if ( is_search() && is_post_type_archive() ) { add_filter( 'woo_pagination_args', 'woocommerceframework_add_search_fragment', 10 ); }
	woo_pagenav();
}
function woostore_after_content2() {
	
	woo_main_after();
	woo_content_after(); 

}


function woocommerceframework_add_search_fragment ( $settings ) {
	$settings['add_fragment'] = '&post_type=product';
	return $settings;
} // End woocommerceframework_add_search_fragment()

// Add the WC sidebar in the right place
add_action( 'woo_main_after', 'woocommerce_get_sidebar', 10);

// Remove breadcrumb (we're using the WooFramework default breadcrumb)
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
add_action( 'woocommerce_before_main_content', 'woostore_breadcrumb', 01, 0);

function woostore_breadcrumb() {
	woo_breadcrumbs();
}

// Remove pagination (we're using the WooFramework default pagination)
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 ); // <2.0
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); // 2.0+


// Adjust the star rating in the sidebar
add_filter('woocommerce_star_rating_size_sidebar', 'woostore_star_sidebar');

function woostore_star_sidebar() {
	return 12;
}

// Adjust the star rating in the recent reviews
add_filter('woocommerce_star_rating_size_recent_reviews', 'woostore_star_reviews');

function woostore_star_reviews() {
	return 12;
}

// Change columns in product loop to 3
add_filter('loop_shop_columns', 'woostore_loop_columns');

function woostore_loop_columns() {
	return 3;
}

// Change columns in related products output to 3

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

if ( ! function_exists('woocommerce_output_related_products') && version_compare( WOOCOMMERCE_VERSION, "2.1" ) < 0 ) {
	function woocommerce_output_related_products() {
		    woocommerce_related_products( 3,3 );
	}
}

add_filter( 'woocommerce_output_related_products_args', 'wootique_related_products' );
function wootique_related_products() {
	$args = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);
	return $args;
}

if ( ! function_exists( 'woo_upsell_display' ) ) {
	function woo_upsell_display() {
	    // Display up sells in correct layout.
	    woocommerce_upsell_display( -1, 3 );
	}
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woo_upsell_display', 15 );

// If theme lightbox is enabled, disable the WooCommerce lightbox and make product images prettyPhoto galleries
/*add_action( 'wp_footer', 'woocommerce_prettyphoto' );
function woocommerce_prettyphoto() {
	global $woo_options;
	if ( $woo_options[ 'woo_enable_lightbox' ] == "true" ) {
		update_option( 'woocommerce_enable_lightbox', false );
		?>
			<script>
				jQuery(document).ready(function(){
					jQuery('.images a').attr('rel', 'prettyPhoto[product-gallery]');
				});
			</script>
		<?php
	}
}*/

// Display 12 products per page
add_filter('loop_shop_per_page', create_function('$cols', 'return 8;'));


// Wishlist links
add_action('woo_nav_before', 'woocommerce_inventory_link', 5);
add_action('woo_nav_before', 'woocommerce_header_cart_links', 10);
add_action('woo_nav_before', 'wootique_checkout_button', 10);

function woocommerce_inventory_link() {
	
	if( !class_exists('WC_Wishlists_User') && !class_exists('WC_Wishlists_Pages') ) return;
	
	$lists = WC_Wishlists_User::get_wishlists();
	$inventory_page = WC_Wishlists_Pages::get_url_for('wishlists');
	$list_count = count($lists);
	$list_count2 = $list_count . " list";
	
	if($list_count > 0){
		$list_count2 = $list_count2 . "s";
	}
	
	
	
	$button_text = "Inventory";
	
	if( count($lists) == 0 ) {
		//no lists create inventory
		$button_text = "Create an Inventory";
	} else if( count($lists) <= 1 ) {
		// Inventory - singluar
		$button_text = "View Inventory";
	} else { 
		// Inventory - multiple
		$button_text = "View Inventories";
	}
	?>
	<ul class="inventory-links">
		<li><b>Inventory</b> | <?php echo $list_count2; ?></li>
		<li><a href="<?php echo $inventory_page; ?>" title="<?php echo $button_text; ?>">View</a></li>
	</ul>
    <a class="mobile-links inventory" href="<?php echo $inventory_page; ?>">
        <div class="numbers">| <?php echo str_pad($list_count, 3, "0", STR_PAD_LEFT); ?></div>
    </a>
	<?php
}

function woocommerce_cart_link() {
	global $woocommerce;
	?>
		<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="'<?php _e( 'View your basket', 'woothemes' ); ?>'" class="cart-button">
			<?php echo sprintf(_n( 'Backet | %d item | ', 'Basket | %d items | ', $woocommerce->cart->get_cart_contents_count(), 'woothemes'), $woocommerce->cart->get_cart_contents_count()) . $woocommerce->cart->get_cart_total(); ?>
		</a>
	<?php
}

// additional function  to call cart link, so we don;t mess with the js callback and trigger events
function woocommerce_header_cart_links() {
	global $woocommerce;
	?>
	<ul class="cart-links">
		<li class="cart-links-content"><?php echo sprintf(_n( 'Basket | %d item |', 'Basket | %d items |', $woocommerce->cart->get_cart_contents_count(), 'woothemes'), $woocommerce->cart->get_cart_contents_count()) . "&nbsp;" . $woocommerce->cart->get_cart_total(); ?></li>
		<li><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="'<?php _e( 'View basket', 'woothemes' ); ?>'" class="basket-link">View</a></li>
	</ul>
    <a class="mobile-links basket" href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
        <div class="numbers">| <?php echo str_pad($woocommerce->cart->get_cart_contents_count(), 3, "0", STR_PAD_LEFT); ?></div>
    </a>
	<?php
}

function wootique_checkout_button() {
	global $woocommerce;
	?>
		<div class="checkout-links">
		<?php
			echo '<a href="'.$woocommerce->cart->get_checkout_url().'" class="checkout-link">'.__('Checkout','woothemes').'</a>';
		?>
		</div>
        <a class="mobile-links checkout" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>"></a>
	<?php
}



add_filter('add_to_cart_fragments', 'header_add_to_cart_fragment');
function header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();

	woocommerce_cart_link();

	$fragments['.cart-button'] = ob_get_clean();

	return $fragments;

}




/*-----------------------------------------------------------------------------------*/
/* GUYMARK SPECIFIC
/*-----------------------------------------------------------------------------------*/

// Move meta to top of product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );


// Move the price below the excerpt on the single product page
remove_action( 'woocommerce_template_single_summary', 'woocommerce_template_single_price', 10, 2);
add_action( 'woocommerce_template_single_summary', 'woocommerce_template_single_price', 25, 2);

// Remove price on product page and check the item meta allows sale before displaying
add_filter( 'woocommerce_variable_free_price_html',  'guymark_hide_free_price_notice' );
add_filter( 'woocommerce_free_price_html',           'guymark_hide_free_price_notice' );
add_filter( 'woocommerce_variation_free_price_html', 'guymark_hide_free_price_notice' );


// Remove price display in meta area
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

function guymark_hide_single_price() {
	return;
}

/**
 * Hides the 'Free!' price notice and add to cart if price is Free!
 */
function guymark_hide_free_price_notice( $price ) {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
	remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
	remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
	remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
	return '';
}

// Move basket link to below description 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'guymark_product_basket', 'woocommerce_template_single_add_to_cart', 5 );

// Add custom meta to the single product page
add_action( 'woocommerce_single_product_extended_meta', 'guymark_custom_meta', 50 );

function guymark_custom_meta() {
	woocommerce_get_template('single-product/extended-meta.php');
}


// Replace excerpt with full content on product page
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action( 'woocommerce_single_product_summary', 'guymark_product_full_description', 20 );

function guymark_product_full_description() {
	woocommerce_get_template('single-product/full-description.php');
}



// Include Product enquiry form if Contact Form 7 plugin is installed and form configured
add_action( 'woocommerce_after_add_to_cart_button', 'guymark_load_product_enquiry', 50 );

function guymark_load_product_enquiry() {
	woocommerce_get_template('single-product/product-enquiry.php');
}


// WISHLIST To Inventory Overrides
add_filter('woocommerce_wishlist_add_to_wishlist_message', 'guymark_update_wishlist_message');
function guymark_update_wishlist_message($wishlist_id = 0) {
	if($wishlist_id == 0){
		$wishlist_id = isset($_REQUEST['wlid']) ? $_REQUEST['wlid'] : 0;
	}
	
	if (WC_Wishlists_Settings::get_setting('woocommerce_wishlist_redirect_after_add_to_cart', 'yes') == 'yes') :
		$message = sprintf('<a href="%s" class="button">%s</a> %s', $return_to, __('Continue Shopping &rarr;', 'woocommerce'), __('Item added to your Inventory List.', 'wc_wishlist'));
	else :
		$title = (get_the_title($wishlist_id));
		$success_message = sprintf(__('Product successfully added to your primary inventory list (%s).', 'wc_wishlist'), esc_html($title));
		$edit_list_url = "/view-a-list/?wlid=" . $wishlist_id;
		$message = sprintf('<a href="%s" class="button">%s</a> %s', $edit_list_url, __('Manage list &rarr;', 'wc_wishlist'), $success_message);
	endif;
	
	return $message;
}


// Cart to Basket text on Order totals page
add_filter('woocommerce_get_order_item_totals', 'guymark_get_order_item_totals');
function guymark_get_order_item_totals( $total_rows ) {
	$total_rows['cart_subtotal']['label'] = __( 'Basket Subtotal:', 'woocommerce' );
	$total_rows['cart_discount']['label'] = __( 'Basket Discount:', 'woocommerce' );
	return $total_rows;
}



// Override default email type for wishlists
remove_action('init', 'woocommerce_wishlist_handle_share_via_email_action', 9);
add_action('init', 'guymark_wishlist_handle_share_via_email_action', 9);

function guymark_wishlist_handle_share_via_email_action() {
	global $woocommerce, $woocommerce_wishlist, $phpmailer;

	if (!isset($_POST['wishlist-action']) || !($_POST['wishlist-action'] == 'share-via-email')) {
		return;
	}

	if (!WC_Wishlists_Plugin::verify_nonce('share-via-email')) {
		return;
	}

	$wishlist_id = filter_input(INPUT_POST, 'wishlist_id', FILTER_SANITIZE_NUMBER_INT);

	if (!$wishlist_id) {
		WC_Wishlist_Compatibility::wc_add_notice(__('Action failed. Please refresh the page and retry.', 'woocommerce'), 'error');
		return;
	}

	$wishlist = new WC_Wishlists_Wishlist($wishlist_id);
	if (!$wishlist) {
		WC_Wishlist_Compatibility::wc_add_notice(__('Action failed. Please refresh the page and retry.', 'woocommerce'), 'error');
		return;
	}

	if ($wishlist->get_wishlist_sharing() == 'Private') {
		WC_Wishlist_Compatibility::wc_add_notice(__('Unable to share a private list.', 'woocommerce'), 'error');
		return;
	}

	$to = filter_input(INPUT_POST, 'wishlist_email_to', FILTER_SANITIZE_STRIPPED);
	$sent = 0;
	
	if ($to) {
		$addresses = explode(',', $to);
		array_map('trim', $addresses);
		$clean_addresses = array();
		foreach ($addresses as $address) {
			$clean_addresses[] = filter_var($address, FILTER_SANITIZE_EMAIL);
		}
		
		if (count($clean_addresses)) {
			
			$body = apply_filters('woocommerce_wishlist_share_via_email_body', $body, $wishlist_id, $name, $to);
			
			add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
			add_filter('wp_mail_from', 'woocommerce_wishlist_get_from_address');
			
			$sent = wp_mail($clean_addresses, sprintf(__('%s has a list to share', 'wc_wishlist'), $name), $body, $headers);
			
			remove_filter('wp_mail_from', 'woocommerce_wishlist_get_from_address');
		}
	}
	
	if ($sent) {
		WC_Wishlist_Compatibility::wc_add_notice(__('Your email has been sent', 'wc_wishlist'));
	} elseif ($sent === false) {
		WC_Wishlist_Compatibility::wc_add_notice(__('Unable to send mail.  Please check your values and try again.', 'wc_wishlist') . ' ' . $phpmailer->ErrorInfo, 'error');
	} else {
		WC_Wishlist_Compatibility::wc_add_notice(__('Unable to send mail.  Please check your values and try again.', 'wc_wishlist'), 'error');
	}
	
}


// Wishlist email body, uses header and footer from the Woocoomerce suite and replces the
// send wishlist body with full wishlist content
add_filter('woocommerce_wishlist_share_via_email_body', 'guymark_wishlist_email_format');
function guymark_wishlist_email_format( $body ) {
	
	$wishlist_id = filter_input(INPUT_POST, 'wishlist_id', FILTER_SANITIZE_NUMBER_INT);
	$wishlist = new WC_Wishlists_Wishlist($wishlist_id);
	
	$wishlist_title	= $wishlist->post->post_title;
	$wishlist_items	= WC_Wishlists_Wishlist_Item_Collection::get_items($wishlist->id);
	$senders_name	= filter_input(INPUT_POST, 'wishlist_email_from', FILTER_SANITIZE_STRING);
	$senders_note	= filter_input(INPUT_POST, 'wishlist_content', FILTER_SANITIZE_STRIPPED);
	$senders_name	= $senders_name ? $senders_name : get_post_meta($wishlist->id, '_wishlist_first_name', true) . ' ' . get_post_meta($wishlist->id, '_wishlist_last_name', true);
	$senders_name	= $senders_name ? $senders_name : __('Someone', 'wc_wishlist');
	$url			= $wishlist->get_the_url_view($wishlist_id, true);
	
	$wishlist_body_vars = array(
				'wishlist_id'		=> $wishlist_id,
				'wishlist_title'	=> $wishlist_title,
				'wishlist_items'	=> $wishlist_items,
				'senders_name'		=> $senders_name,
				'senders_note'		=> $senders_note,
				'wishlist_url'		=> $url
			);
	
	ob_start();
	$read_template = woocommerce_get_template( 'woocommerce/emails/wishlist-body.php', $wishlist_body_vars );
	$body .=  ob_get_clean();
	
	$body .= "\r\n";
	
	return $body;
}


// Update the Wishlist header title
add_filter( 'woocommerce_my_account_my_wishlists_title', 'guymark_wishlist_title' );
function guymark_wishlist_title( $title ) {
	$title = "My Inventory";
	return $title;
}

