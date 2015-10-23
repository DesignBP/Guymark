<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>


<?php get_template_part('woocommerce/emails/email-header'); ?>

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

<?php echo $senders_name; ?>

<?php echo $wishlist_title; ?>

<?php echo $senders_note; ?>

<?php echo $wishlist_url; ?>


<?php
	
	foreach( $wishlist_items as $list=>$item ) {
		echo $item[quantity];
		echo $item[data]->post->post_title;
		echo $item[data]->post->post_excerpt;
		
		$thumb = get_the_post_thumbnail($item[data]->post->ID, 'thumbnail');
		echo $thumb;
		
		$product_link = get_permalink($item[data]->post->ID);
		echo $product_link;
	}
?>


<?php get_template_part('woocommerce/emails/email-footer'); ?>
