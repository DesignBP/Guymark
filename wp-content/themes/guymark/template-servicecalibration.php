<?php
/*
Template Name: Servicing and Calibration
*/

the_post();
?>


<?php get_header(); ?>

	<div class="container style-2">

		<div class="block">
			<?php woo_breadcrumbs(); ?>
			<?php get_template_part("partials/pj", "banner"); ?>

			<div class="el_side">
				<?php get_template_part("partials/pj", "sidebar-nav"); ?>
				<?php get_template_part("partials/pj", "sidebar-tel"); ?>
			</div>

			<div class="el_content">
				<?php
				the_content();
				
				// START OF TABS
				$parent = $post->post_parent;
				$is_landing = ($parent > 0 ? false : true);
				if($is_landing){
					get_template_part("partials/pj", "service-tabs");
				}
				// END OF TABS
				?>
			</div>
		</div>
		
	</div>
	
<?php get_template_part("partials/split-blog"); ?>

<?php get_footer(); ?>
