<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>


<?php 

/* var list
	'wishlist_id'		=> $wishlist_id,
	'wishlist_title'	=> $wishlist_title,
	'wishlist_items'	=> $wishlist_items,
	'senders_name'		=> $senders_name,
	'senders_note'		=> $senders_note,
	'wishlist_url'		=> $url
*/
?>

<?php echo sprintf( __( 'You have been sent an inventory from %s', 'woocommerce' ), $senders_name ) . "\n\n\r\r"; ?>

<?php echo sprintf( __( 'Inventory name: %s', 'woocommerce' ), $wishlist_title ) . "\n\n"; ?>


<?php echo $senders_name . " said:\n\n"; ?>
<?php echo $senders_note . "\n\n"; ?>


<?php
	
	foreach( $wishlist_items as $list=>$item ) {
		
		echo $item[quantity];
		echo $item[data]->post->post_title;
		echo $item[data]->post->post_excerpt;
		
		$product_link = get_permalink($item[data]->post->ID);
		echo $product_link;
		
	}
?>

<?php echo sprintf( __( 'View the inventory here %s', 'woocommerce' ), $wishlist_url ) . "\n\n"; ?>


<?php echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) . "\n\n"; ?>

<?php echo "\n****************************************************\n\n"; ?>
