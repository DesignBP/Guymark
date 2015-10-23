<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="product_meta">
	
	
	<?php do_action( 'woocommerce_product_meta_start' ); ?>
	
	<?php
	// SKU
	if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option( 'woocommerce_enable_sku' ) == 'yes' && $product->get_sku() ) : ?>
		
		<ul class="product-primary-meta">
			
				<li itemprop="productID" class="sku">
					<span><?php _e( 'Product ID:', 'woocommerce' ); ?></span> <?php echo $product->get_sku(); ?>
				</li>
			
			<?php
				// previous sku
				$previous_sku = get_metadata('post', $post->ID, 'previous_sku', true);
				
				if( !empty($previous_sku) ):
					echo "<li><span>Previous ID:</span> " . $previous_sku . "</li>";
				endif;
				
				// nhs_supply_code
				$nhs_supply_code = get_metadata('post', $post->ID, 'nhs_supply_code', true);
				
				if( !empty($nhs_supply_code) ):
					echo "<li><span>NHS Supply Code:</span>" . $nhs_supply_code . "</li>";
				endif;
			?>
			
		</ul>
		
	<?php endif; ?>
	
	
	<?php if( class_exists('acf') ) :
			
			$fields = get_field('key_features');
			
			// Get key features
			if( is_array($fields) && !empty($fields) ) : ?>
				<div class="product-key-features highlight-list">
				
					<h5>Key Features:</h5>
					
					<ul>
					
						<?php foreach( $fields as $field=>$feature ): ?>
						
							<li><?php echo $feature['feature']; ?></li>
						
						<?php endforeach; ?>
					
					</ul>
				</div>
			<?php endif;
			
		endif;
	?>
	
	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
