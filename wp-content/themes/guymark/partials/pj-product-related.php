<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;
$related = $product->get_related( $posts_per_page );





function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
	array_pop($content);
	$content = implode(" ",$content).'...';
  } else {
	$content = implode(" ",$content);
  } 
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}


if ( sizeof( $related ) == 0 ) return;
$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );
$products = new WP_Query( $args );
$woocommerce_loop['columns'] 	= $columns;
if ( $products->have_posts() ) : 




$limiter = 0;
?>



<div class="product_related">
	<div class="title"><?php _e( 'Related Products', 'woocommerce' ); ?></div>
	<div class="collection">
	
		<?php while ( ($products->have_posts()) && $limiter < 4 ) : $products->the_post(); ?>
		
		<?php
		// Ensure visibility
		if ( ! $product || ! $product->is_visible() ){ continue; }
		
		$product2 = get_product( $post->ID );
		$post_data = $product2->get_post_data();
		?>
		
		
		<a href="<?php the_permalink(); ?>" class="item">
			<div class="image">
				<?php echo $product2->get_image(array(130, 130)); ?>
			</div>
			<div class="name">
				<?php the_title(); ?>
			</div>
			<div class="excerpt">
				<?php
				echo excerpt(10);
				?>
			</div>
			<div class="readmore">Read more</div>
		</a>
		
		<?php
		$limiter++;
		endwhile;
		?>
	
		<div class="clearfix"></div>
		
	</div>
</div>



<?php
endif;
wp_reset_postdata();
?>




