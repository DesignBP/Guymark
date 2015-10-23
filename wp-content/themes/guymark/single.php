<?php
/*
Template Name: Single post
*/

the_post();
?>


<?php get_header(); ?>

	<div class="container style-2 singlepost">

		<div class="block">
			<?php woo_breadcrumbs(); ?>
			<?php get_template_part("partials/pj", "banner"); ?>

			<div class="el_side">
				<?php get_template_part("partials/pj", "sidebar-categories"); ?>
				<?php get_template_part("partials/pj", "sidebar-guytalk"); ?>
			</div>

			<div class="el_content">
				
				<div class="post">
					<div class="title"><?php the_title(); ?></div>
					<div class="info">
						<div class="publish"><?php // echo get_the_date(); ?></div>
						<div class="category" style="display: none"></div>
						<div class="author"><?php the_author(); ?></div>
						<div class="clearfix"></div>
					</div>
					<div class="content">
						<?php
						$featured = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
						if($featured != ""){
							echo "<img src=\"$featured\" />";
						}

						the_content();
						
						?>
						<div class="clearfix"></div>
					</div>
				</div>

			</div>
		</div>
		
	</div>
	
<?php get_template_part("partials/split-blog"); ?>

<?php get_footer(); ?>
