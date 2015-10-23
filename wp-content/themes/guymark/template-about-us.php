<?php
/*
Template Name: About us
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
				<?php get_template_part("partials/pj", "sidebar-news"); ?>
			</div>

			<div class="el_content">
				<?php
				the_content();
				?>
			</div>
		</div>
		
	</div>
	
<?php get_template_part("partials/split-blog"); ?>

<?php get_footer(); ?>
