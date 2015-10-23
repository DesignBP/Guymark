<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<?php
		/* Template order required
		1) Category 
		2) SKU
		3) Previous code
		4) NHS supply code
		5) Key Benefits
		6) Full content
		7) Sidebar of images
		---- split product here ----
		8) Support meta (dimensions, warranty, downloads)
		9) Inventory / Basket links
		
		// ALL overrides in theme-woocommerce file
		*/
	?>
	
	
	<?php
	// BLOCK
	
	// object - Product data
	get_template_part( 'partials/pj', 'product-summary' );
	?>
	
	
	
	
	
	<div class="product-images">
	<?php
		// BLOCK
		
		// object - Product images
		
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	</div>
	
	
	
	
	<?php
	// BLOCK
	
	// object - Product buttons - Buy, Enquire, etc
	// get_template_part( 'partials/pj', 'product-btns' );
	?>
	
	
	
	
	
	
	<div class="product-extended-meta">
	<?php
		// BLOCK
	
		// object - extended meta (product id, category)
		
		/**
		 * guymark_extended_meta hook
		 *
		 * @hooked guymark_extended_meta hook - 5
		 */
		// do_action( 'woocommerce_single_product_extended_meta' );
	?>
	</div>
	
	
	
	
	
	<div class="product-basket-links">
	<?php
		// BLOCK
		
		// object - Add to basket
		// object - Enquiry button
		// object - Quantity
		// object - Variation selection
		
		/**
		 * guymark_product_basket hook
		 *
		 * @hooked guymark_product_basket hook - 5
		 */
		do_action( 'guymark_product_basket' );
	?>
	</div>
	
	
	<?php
		// BLOCK
		// object - Related products - new
		
		get_template_part( 'partials/pj', 'product-related' );
	
	?>
	
	
	
	<?php
		// BLOCK
		
		// object - Tabs
		// object - Related Products
		
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		// do_action( 'woocommerce_after_single_product_summary' );
	?>

	
	
	
	
	
	
	
</div><!-- #product-<?php the_ID(); ?> -->

<?php  do_action( 'woocommerce_after_single_product' ); ?>
