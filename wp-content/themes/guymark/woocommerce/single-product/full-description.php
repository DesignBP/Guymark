<?php
/**
 * Single product full description
 *
 * @author 		Darren Bayliss
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( ! $post->post_content ) return;
?>
<div class="product-description" itemprop="post-content">
	<?php
		$content = apply_filters('the_content', $post->post_content);
		echo $content;
	?>
</div>
