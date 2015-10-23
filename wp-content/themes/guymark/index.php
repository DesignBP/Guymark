<?php
	get_header();
	global $woo_options;
	if ( $woo_options['woo_homepage_content'] == 'true' ) :
?>
	
	<div class="container content">
	
		<div class="block">
		
			<div id="introduction">
				<?php
					$args = array( 'posts_per_page' => 1 );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
				?>
				
						<article <?php post_class(); ?>>
						
							<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] != 'content' ) { woo_image( 'width=' . $woo_options['woo_thumb_w'] . '&height=' . $woo_options['woo_thumb_h'] . '&class=thumbnail ' . $woo_options['woo_thumb_align'] ); } ?>
							
							<header>
							
								<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							
							</header>
							
							<section class="entry">
								<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content( __( 'Continue Reading &rarr;', 'woothemes' ) ); } else { the_excerpt(); } ?>
							</section>
						
						</article><!-- /.post -->
					
					<?php endwhile; ?>
				
			</div>
			
		</div>
		
	</div>
	
	<?php endif; ?>
	
	
	<div class="container">
		
		<div class="block">
			
			<?php get_template_part("partials/wc-promoted-products"); ?>
		
		</div>
		
	</div>

<?php get_footer(); ?>
