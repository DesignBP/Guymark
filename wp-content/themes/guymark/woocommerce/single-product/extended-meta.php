<?php
/**
 * Single Product extended Meta
 *
 * @author 		Darren Bayliss
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="product_meta">
		
	<?php
		// get the dimensions if set
		if( $dimensions = get_field('dimensions') ) : ?>
			
			<div class="product-dimensions highlight-list">
				<ul>
					<li><span>Dimensions:</span> <?php echo $dimensions; ?></li>
				</ul>
			</div>
			
	<?php endif; ?>
		
	
	
	<?php if( class_exists('acf') ) : ?>
			
			<?php
			// Warranty options
			if( $warranties = get_field('warranties') ) {
				
				// Get the assigned warranty option
				$field = get_field_object('warranties');
				$value = get_field('warranties');
				$label = $field['choices'][ $value ];
				
				// Get the warraty option content
				$warranty_content = get_field_object('warranty_content', 'option');
				$warranty_text = $warranty_content['choices'][ $value ];
				
				
				// Assign the printed display name
				$warranty_name = $label;
				
				// Get a value from the display options
				foreach( $warranty_content['sub_fields'] as $arr=>$vals ) {
					if( $vals['name'] == $value ) {
						$warranty_value = $vals['default_value'];
					}
				}
				
			}
			?>
			
			<?php
				// Print the warranty options
				if( isset($warranty_value) && isset($warranty_name) ) : ?>
				<div class="warranty-options">
					<h4><?php echo $warranty_name; ?></h4>
					<p><?php echo $warranty_value; ?></p>
				</div>
			<?php endif; ?>
			
			
			<?php
			// Downloads
			if( $downloads = get_field('product_downloads') ) : ?>
				
				<div class="product-downloads">
					<?php foreach( $downloads as $arr=>$file ) : 
					
						$bytes = filesize(get_attached_file($file->ID));
					
						$type = explode('/', $file->post_mime_type);
						$type = array_reverse($type);
						$type = $type[0];
					
						if( $file->post_excerpt ) {
							$name =  $file->post_excerpt;
						}else{
							$name =  $file->post_name;
						}
						?>
					
						<a href="<?php echo $file->guid; ?>" title="<?php echo $name; ?>"><?php _e('Download', 'guymark'); ?> <?php echo $name; ?><span><?php echo strtoupper($type); ?> file - <?php echo size_format($bytes); ?></span></a>
					
					<?php endforeach; ?>
				</div>
				
			<?php endif; ?>
			
	<?php endif; //end ACF check ?>
	
	
	<div class="product-sub-meta">
		<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option( 'woocommerce_enable_sku' ) == 'yes' && $product->get_sku() ) : ?>
			<span itemprop="productID" class="sku_wrapper"><?php _e( 'Product ID:', 'woocommerce' ); ?> <?php echo $product->get_sku(); ?></span>
		<?php endif; ?>
		
		<?php
			$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
			echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $size, 'woocommerce' ) . ' ', '.</span>' );
		?>
		
		<?php
			$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
			echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $size, 'woocommerce' ) . ' ', '.</span>' );
		?>
	</div>
	
	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
