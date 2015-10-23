<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_wishlist, $add_to_wishlist_args, $product; 

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

get_header('shop'); ?>


	<div class="container style-2 woocommerce">
		
		<div class="block pg_category">
		
		<?php
			/**
			 * woocommerce_before_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action('woocommerce_before_main_content');
		?>

		<div class="top-section">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) { ?>
				<div class="title"><?php woocommerce_page_title(); ?></div>
			<?php }
			else { ?>
				<div class="title">Categories</div>
			<?php } ?>
			
			<div class="search_main">
				<form method="get" class="searchform" action="/">
					<input type="text" class="field s" name="s" value="Search..." onfocus="if (this.value == 'Search...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search...';}">
					<input type="image" src="/wp-content/themes/guymark/images/ico-search.png" class="search-submit" name="submit" alt="">
				</form>    
				<div class="fix"></div>
			</div>
			 
			<?php
			// $this_category = get_category($cat);			
			// Generate dropdown of subcategories
			global $wp_query;
			$cat = $wp_query->get_queried_object();
			$id = $cat->term_taxonomy_id;
			$subcat = "";

			
goto skip_productcategories;
			
			echo "<select name=\"product_cat\" id=\"dropdown_product_cat\">\n";
			if ( is_product_category() ) {
				$subcat = get_categories('child_of=' . $id . '&hide_empty=0&taxonomy=product_cat');
				echo "	<option value=\"\" selected=\"selected\">Select a sub-category</option>\n";
			}
			else {
				$subcat = get_categories('hide_empty=0&taxonomy=product_cat');
				echo "	<option value=\"\" selected=\"selected\">Select a category</option>\n";
				// echo woocommerce_product_dropdown_categories(); - previously used line
			}
			foreach($subcat as $cat2){
				echo "	<option class=\"level-0\" value=\"" . get_term_link( $cat2->slug, "product_cat" ) . "\">" . $cat2->cat_name ."</option>\n";
			}
			echo "</select>\n";
			
			// do_shortcode('[product_category category="THE SLUG" per_page="3" columns="1" orderby="date" order="desc"]');
			// wp_dropdown_categories('taxonomy=product_cat');

			
			?>
			<script type="text/javascript">
			<!--
			
			<?php if(count($subcat) == 0){ ?>
			jQuery( window ).load(function() {
				$(".top-section .selectricWrapper").hide();
			});
			<?php } ?>
			<?php 
			if($cat->count <= 1 && is_product_category()){ ?>
			jQuery( window ).load(function() {
				$(".top-section2").hide();
			});
			<?php } ?>
			
			var dropdown = document.getElementById("dropdown_product_cat");
			function onCatChange() {
				if ( dropdown.options[dropdown.selectedIndex].value != "" ) {
					location.href = dropdown.options[dropdown.selectedIndex].value;
				}
			}
			dropdown.onchange = onCatChange;
			-->
			</script>
			<?php
skip_productcategories:
			?>
			
			<div class="clearfix"></div>
		</div>
		
		<div class="top-section2">
			<?php woocommerce_catalog_ordering(); ?>
			<div class="clearfix"></div>
		</div>
		
		
		<?php 
		function category_item($title, $image, $cat1, $cat2, $cat3){
			if($image == ""){$image = "/wp-content/plugins/woocommerce/assets/images/placeholder.png";}
echo <<<ENDL
			<div class="item">
				<div class="ratio"></div>
				<div class="content">
					<div class="image"><img src="{$image}"></div>
					<div class="category_name">{$title}</div>
					<ul class="sub_categories">
						<li><span>{$cat1}</span></li>
						<li><span>{$cat2}</span></li>
						<li><span>{$cat3}</span></li>
						<li><span>and more</span></li>
					</ul>
					<a href="/test" class="button">View categories<div></div></a>
				</div>
			</div>
ENDL;
		}
		?>
		<div class="category_list">
			<?php
			category_item("Audiometers");
			category_item("Hearing Aid Fitting");
			category_item("Tympanometer");
			category_item("Evoked Response");
			category_item("Otoacoustic Emissions");
			category_item("Sound Booths & Rooms");
			category_item("Sound Level Meters");
			category_item("Sound Level Indicators");
			category_item("Hearing Protection");
			category_item("VNG Systems");
			category_item("Sound Field Systems");
			category_item("Visual Reward Apparatus");
			category_item("Otoscopes & ENT Equipment");
			category_item("Technical Spares");
			category_item("Accessories");
			category_item("Consumables");
			category_item("Educational Products");
			category_item("Ex-Demo Equipment");
			?>
		</div>
		
		<div class="product-collection" style="display: none">
		
		
		<?php if ( have_posts() ) : ?>

			<?php woocommerce_product_subcategories(); ?>

			<?php while ( have_posts() ) : the_post(); ?>
			<?php if($product2 = get_product( get_the_ID() )){ ?>
			<div class="item">
				<div class="pad">
					<a href="<?php the_permalink(); ?>">
						<div class="image">
							<?php  echo $product2->get_image(150, 150); ?>
						</div>
						<div class="name"><?php the_title(); ?></div>
						<div class="description"><?php excerpt(10); ?></div>
						<div class="options"><span>+</span> Options</div>
					</a>
					<a href="<?php echo "/shop/?add-to-cart=" . get_the_ID() . "&add-to-wishlist-itemid=" . get_the_ID(); ?>" class="button inventory">Add to inventory<div></div></a>
					<a href="<?php echo $product2->add_to_cart_url(); ?>" class="button basket">Add to basket<div></div></a>
				</div>
			</div>
			<?php } ?>
			
			<?php endwhile; // end of the loop.?>

			
		<?php
			/**
			 * woocommerce_after_shop_loop hook
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		?>
			
			
			
			
			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
			<?php endif; ?>	
			
			<div class="clearfix"></div>
		</div>
	
	
		<!-- END OF ITEM LIST -->
	
	
	
	
		<div class="col-right">
		
			<?php
			get_sidebar();
			// do_action('woocommerce_sidebar');
			// the_widget("woocommerce_featured_products"); 
			// do_shortcode('[featured_products per_page="12" columns="4"]')
			?>
		</div>

		<?php
			/**
			 * woocommerce_after_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			 // do_action('woocommerce_after_main_content2');
			
		?>

		<?php
			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			// do_action('woocommerce_sidebar');
			
			// get_sidebar();
			
			do_action('woocommerce_after_main_content3');
		?>
		
		
		</div>
		
	</div>

<?php get_footer('shop'); ?>
