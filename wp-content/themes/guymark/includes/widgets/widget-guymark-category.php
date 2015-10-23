<?php
/**
 * Product Categories Widget
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	1.6.4
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WC_Widget_Guymark_Categories extends WP_Widget {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;
	var $cat_ancestors;
	var $current_cat;

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	function WC_Widget_Guymark_Categories() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'woocommerce widget_product_categories';
		$this->woo_widget_description = __( 'A list or dropdown of product categories.', 'woocommerce' );
		$this->woo_widget_idbase = 'woocommerce_product_categories';
		$this->woo_widget_name = __( 'Guymark Product Categories', 'woocommerce' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget('product_categories', $this->woo_widget_name, $widget_ops);
	}


	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Product Categories', 'woocommerce' ) : $instance['title'], $instance, $this->id_base);
		$c = $instance['count'] ? '1' : '0';
		$h = $instance['hierarchical'] ? true : false;
		$s = (isset($instance['show_children_only']) && $instance['show_children_only']) ? '1' : '0';
		$d = $instance['dropdown'] ? '1' : '0';
		$o = isset($instance['orderby']) ? $instance['orderby'] : 'order';

		echo $before_widget;
		if($title) echo $before_title . $title . $after_title;

		$cat_args = array( 'show_count' => $c, 'hierarchical' => $h, 'taxonomy' => 'product_cat' );
		$cat_args['menu_order'] = false;

		if ($o == 'order'){$cat_args['menu_order'] = 'asc';}
		else {$cat_args['orderby'] = 'title';}

		if ($d) {
			// Stuck with this until a fix for http://core.trac.wordpress.org/ticket/13258
			woocommerce_product_dropdown_categories( $c, $h, 0, $o );
			?>
			<script type='text/javascript'>
			/* <![CDATA[ */
				var product_cat_dropdown = document.getElementById("dropdown_product_cat");
				function onProductCatChange() {
					if ( product_cat_dropdown.options[product_cat_dropdown.selectedIndex].value !=='' ) {
						location.href = "<?php echo home_url(); ?>/?product_cat="+product_cat_dropdown.options[product_cat_dropdown.selectedIndex].value;
					}
				}
				product_cat_dropdown.onchange = onProductCatChange;
			/* ]]> */
			</script>
			
			<?php

		} else {

			global $wp_query, $post, $woocommerce;

			$this->current_cat = false;
			$this->cat_ancestors = array();
			if ( is_tax('product_cat') ) {
				$this->current_cat = $wp_query->queried_object;
				$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );
			} elseif ( is_singular('product') ) {
				$product_category = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent' ) );
				if ($product_category){
					$this->current_cat   = end( $product_category );
					$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );
				}
			}

			include_once( $woocommerce->plugin_path() . '/classes/walkers/class-product-cat-list-walker.php' );

			$cat_args['walker'] 			= new WC_Product_Cat_List_Walker;
			$cat_args['title_li'] 			= '';
			$cat_args['show_children_only']	= ( isset( $instance['show_children_only'] ) && $instance['show_children_only'] ) ? 1 : 0;
			$cat_args['pad_counts'] 		= 1;
			$cat_args['show_option_none'] 	= __('No product categories exist.', 'woocommerce' );
			$cat_args['current_category']	= ( $this->current_cat ) ? $this->current_cat->term_id : '';
			$cat_args['current_category_ancestors']	= $this->cat_ancestors;

			$args = array(
			  'taxonomy'     => 'product_cat',
			  'orderby'      => 'name',
			  'show_count'   => 0,
			  'pad_counts'   => 0,
			  'hierarchical' => 1,
			  'title_li'     => '',
			  'hide_empty'   => 1,
			  'parent'		 => 0
			);
			$categories = get_categories( $args );
			
			$toplevel = 0;
			if(count($this->cat_ancestors) == 0){
				$toplevel = $this->current_cat->term_id;
			}
			else {
				$toplevel = $this->cat_ancestors[0];
			}
			
			// echo '<ul class="product-categories">';
			// wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $cat_args ) );
			// echo '</ul>';
			
			$requesturl = strtok($_SERVER["REQUEST_URI"], '?');
			
			$add_filter = "";
			$qm = ""; 
			$and = "";
			if(isset($_GET['filter']) || strtolower(get_the_title()) == "shop"){
				$qm = " + \"?\" + "; 
				$and = " + \"&\" + ";
				if(strtolower(get_the_title()) == "shop"){
					$add_filter = "\"filter=" . "shop" . "\"";
				}
				else {
					$add_filter = "\"filter=" . $_GET['filter'] . "\"";
				}
			}
			
			echo <<<ENDL
			<script>
			Array.prototype.remove = function() {
				var what, a = arguments, L = a.length, ax;
				while (L && this.length) {
					what = a[--L];
					while ((ax = this.indexOf(what)) !== -1) {
						this.splice(ax, 1);
					}
				}
				return this;
			};
			$(function() {
				$(".cat_entry").each(function(){
					$(this).click(function(){
						$(this).toggleClass("active");
						var omit_this = $(this).data("omit");
						
						if(omit_this == ""){
							location.href = "/product-category/" + $(this).data("slug") + "/" {$qm}{$add_filter};
							return;
						}
						
						var root_cat_list = [];
						var product_cat = [];
						
						$(".cat_entry.active").each(function(){
							var slug = $(this).data("slug");
							var omit = $(this).data("omit");
							if(omit == ""){
								root_cat_list.push(slug);
							}
						});
						
						$(".cat_entry.active").each(function(){
							var slug = $(this).data("slug");
							var omit = $(this).data("omit");
							if(omit != ""){
								product_cat.remove(omit);
							}
							product_cat.push(slug);
						});
						location.href = "/product-category/" + root_cat_list[0] + "/?product_cat=" + product_cat.join() {$and}{$add_filter};
					});
				});
			});			
			</script>
ENDL;
			
			echo "<div class=\"category_frame\">\n<div class=\"category_filter\">";
			$in_url = explode(",", $_GET['product_cat']);
			$in_url = array_map('trim', $in_url);
			
			foreach($categories as $category){
				$name = $category->name;
				$termid = $category->term_id;
				$slug = $category->slug;
				
				$productcount = $this->category_postcount($category);
				if($productcount == 0){continue;}
				
				$current = ($toplevel == $termid) || in_array($slug, $in_url);
				$this->widget_gen_entry($current, $slug, $name);
				if($current){
					$subcat_ids = get_term_children($toplevel, "product_cat");
					foreach($subcat_ids as $id){
						$subcat = get_term($id, "product_cat");
						$productcount = $this->category_postcount($subcat);
						if($productcount == 0){continue;}
						$this->widget_gen_entry(($this->current_cat->slug == $subcat->slug) || in_array($subcat->slug, $in_url), $subcat->slug, $subcat->name, true, $slug);
					}
				}
				
			}
			echo "</div>\n</div>";
			

		}

		echo $after_widget;
	}
	
	function category_postcount($catdata){
		$args = array( 
			'post_type' => 'product', 
			'product_cat' => $catdata->slug
		);
		if(isset($_GET['filter']) || strtolower(get_the_title()) == "shop"){
			$args['meta_key'] = 'available_for_purchase';
			$args['meta_value'] = 1;
		}
		$loop = new WP_Query( $args );
		return $loop->found_posts;
	}
	
	function widget_gen_entry($active, $slug, $name, $subcat = false, $parent = ""){
		if($subcat){$subcat = "subcat";}
		else {$subcat = "";}
		if($active){$active = "active";}
		else {$active = "";}
		echo<<<ENDL
		<div class="cat_entry {$active} {$subcat}" data-slug="{$slug}" data-omit="{$parent}">
			<div class="check"></div>
			<div class="label">{$name}</div>
			<div class="end"></div>
		</div>
ENDL;
	}
	



	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['orderby'] = strip_tags($new_instance['orderby']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? true : false;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;
		$instance['show_children_only'] = !empty($new_instance['show_children_only']) ? 1 : 0;

		return $instance;
	}


	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : 'order';
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
		$show_children_only = isset( $instance['show_children_only'] ) ? (bool) $instance['show_children_only'] : false;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'woocommerce' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e( 'Order by:', 'woocommerce' ) ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id('orderby') ); ?>" name="<?php echo esc_attr( $this->get_field_name('orderby') ); ?>">
			<option value="order" <?php selected($orderby, 'order'); ?>><?php _e( 'Category Order', 'woocommerce' ); ?></option>
			<option value="name" <?php selected($orderby, 'name'); ?>><?php _e( 'Name', 'woocommerce' ); ?></option>
		</select></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('dropdown') ); ?>" name="<?php echo esc_attr( $this->get_field_name('dropdown') ); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Show as dropdown', 'woocommerce' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count') ); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts', 'woocommerce' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('hierarchical') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hierarchical') ); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy', 'woocommerce' ); ?></label><br/>

		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_children_only') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_children_only') ); ?>"<?php checked( $show_children_only ); ?> />
		<label for="<?php echo $this->get_field_id('show_children_only'); ?>"><?php _e( 'Only show children for the current category', 'woocommerce' ); ?></label></p>
<?php
	}

}
