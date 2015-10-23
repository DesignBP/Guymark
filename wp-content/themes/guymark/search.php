<?php get_header(); ?>

	<div class="container page-template-default">
		
		<div class="block" style="margin-bottom: 100px">

				<?php woo_breadcrumbs(); ?>
				
				<?php if (have_posts()) : $count = 0; ?>
							
				<h1 class="title">Search results for &quot;<?php the_search_query();?>&quot;</h1>
				
				<?php while (have_posts()) : the_post(); $count++; ?>
						
				<!-- Post Starts -->
				<div <?php post_class(); ?> style="float: none; border-bottom: 1px solid #D3D3D3; margin-bottom: 14px; width: auto; padding: 0px 11px; padding-bottom: 14px;">
			
					<h3 class="title" style="margin-bottom: 18px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				
					<?php // woo_post_meta(); ?>
				
					<div class="entry" style="line-height: 20px; color: #303030; padding-l">
						<?php the_excerpt(); ?>
					</div><!-- /.entry -->
						
				</div><!-- /.post -->
													
				<?php endwhile; else: ?>
			
				<div <?php post_class(); ?>>
					<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
				</div><!-- /.post -->
			
				<?php endif; ?> 
				<div class="clearfix"></div>
				<style>
				.woo-pagination {
					width: 653px;
				}
				</style>
				<?php woo_pagenav(); ?>

		</div>
	</div>
	
<?php get_footer(); ?>
