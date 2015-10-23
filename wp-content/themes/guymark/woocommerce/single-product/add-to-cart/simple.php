<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.15
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;

?>

<?php
	// Availability
	$availability = $product->get_availability();

	if ($availability['availability']) :
		echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
    endif;
?>



	<?php do_action('woocommerce_before_add_to_cart_form'); ?>
	
	<form class="cart" method="post" enctype='multipart/form-data'>
		<?php if ( $product->is_in_stock() ) : ?>
		
	 	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	 	<?php
		function purchasable(){
			global $product;
			return $product->is_purchasable() && db_is_available_for_purchase() && ($_GET['display'] != "information");
		}
		if(purchasable()){
		?>
		<div class="single_variation">
			<span class="price">
				<span class="amount" itemprop="price" ><?php echo $product->get_price_html(); ?></span>
			</span>
		</div>
		<?php
			if ( ! $product->is_sold_individually() ){
				woocommerce_quantity_input( array(
					'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
					'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
				) );
			}
		}
	 	?>
		<div class="product buttons">
			<a href="?add-to-cart=<?php echo esc_attr( $product->id ); ?>&add-to-wishlist-itemid=<?php echo esc_attr( $product->id ); ?>" class="button inventory">Add to inventory</a>
			<?php if( purchasable() ){ ?>
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
			<button type="submit" class="single_add_to_cart_button button alt button basket"><?php echo apply_filters('single_add_to_cart_text', __( 'Add to basket', 'woocommerce' ), $product->product_type); ?></button>
			<?php } // end of available for purchase check ?>
			
		</div>
	
		<?php endif; ?>
		<?php do_action('woocommerce_after_add_to_cart_button'); ?>
	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>


