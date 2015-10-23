<?php
/**
 * Load contact form 7 product enquiry form
 *
 * @author 		Darren Bayliss
 * @version		1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

?>

<div class="product-enquiry product buttons" style="clear: none">
	
	<div class="product-make-enquiry button enquire">Enquire</div>
	
	
	<?php if( class_exists('WPCF7_ContactForm') ) : ?>
		
		<div class="product-enquiry-form" style="display: none;">
			<?php echo preg_replace(
				'!<input type="text" name="your-subject" value=""!','<input type="text" name="your-subject" value="Enquiry about '.$post->post_title.'"',
				do_shortcode( '[contact-form-7 title="Product Enquiry Form"]' ));
			?>
		</div>
		
		
		<script type="text/javascript">
			jQuery(document).ready(function($) { 
				
				$(".product-make-enquiry").click(function(){
					$(".product-enquiry-form").slideToggle("fast");
				});
			});
		</script>
		
	<?php endif; ?>
	
</div>
