<?php get_header(); ?>
	
	<div class="container">
		
		<div class="block">
				
				<?php woo_breadcrumbs(); ?> 
				
				<?php if (have_posts()) : $count = 0; ?>
				
				<?php while (have_posts()) : the_post(); $count++; ?>
					<h1 class="title"><?php the_title(); ?></h1>
				
					<div <?php post_class(); ?>>
					
						<div class="entry">
							<?php the_content(); ?>
						
							<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
						</div>
						
						<?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>
					
					</div>
					
				<?php endwhile; else: ?>
					<div <?php post_class(); ?>>
						<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
					</div>
				<?php endif; ?>  
				
				<?php get_sidebar(); ?>
		
		</div>
	
	</div>
	
<?php get_footer(); ?>
