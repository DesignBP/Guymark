<?php
/*
Template Name: Blog - General
*/

the_post();
?>


<?php get_header(); ?>

	<div class="container style-2 blogpage">

		<div class="block">
			<?php woo_breadcrumbs(); ?>
			<?php get_template_part("partials/pj", "banner"); ?>

			<div class="el_side">
				<?php get_template_part("partials/pj", "sidebar-categories"); ?>
				<?php get_template_part("partials/pj", "sidebar-guytalk"); ?>
			</div>

			<?php
			$news_category = "General Blog";
			get_template_part("partials/pj", "news"); ?>
		</div>
		
	</div>
	
<?php get_template_part("partials/split-blog"); ?>

<?php get_footer(); ?>
