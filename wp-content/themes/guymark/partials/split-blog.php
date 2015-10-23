<div class="container split-blog">
		<div class="block">
			<?php 
			
				/**
				 * defined blogs we are looking for returned in the array
				 * 1 general_blog
				 * 2 specialised_blog
				*/
				$cats = gm_get_assigned_options_categories();
				
				$default_args = array(
					'posts_per_page'   => 1,
					'offset'           => 0,
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'post_type'        => 'post',
					'post_status'      => 'publish',
					'suppress_filters' => true
					);
			?>
			
			
			
			<?php if( isset($cats['general_blog']) ) :
					
					$default_args['category'] = $cats['general_blog']->term_id;
					$general_blog = get_posts($default_args);
					
					foreach( $general_blog as $post ) :
					?>
					
						<section class="from-the-blog">
						
							<article>
							
								<h1>From the blog</h1>
							
								<div class="split-featured-image">
									<img src="<?php echo DB_get_image_with_fallback(get_post_thumbnail_id( $post->ID )); ?>" alt="">
								</div>
							
								<div class="split-content">
							
									<h3><?php echo $post->post_title; ?></h3>
								
									<span class="author"><?php 
									setup_postdata($post);
									the_author(); 
									?></span>
									<?php
									
						function get_excerpt($limit, $excerpt = null){
							$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
							$excerpt = strip_shortcodes($excerpt);
							$excerpt = strip_tags($excerpt);
							$excerpt = trim($excerpt);
							$excerpt = substr($excerpt, 0, $limit);
							$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
							$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
							$excerpt = $excerpt.'...';
							return $excerpt;
						}
									
									?>
									<p><?php echo get_excerpt(150, $post->post_content); ?></p>
								
									<a href="<?php echo get_permalink($post->ID); ?>" title="Read the full article <?php echo $post->post_title; ?>">Read the full article and others here</a>
								
								</div>
						
							<article>
						
						</section>
						
				<?php endforeach; ?>
				
			<?php endif; ?>
			
			<?php wp_reset_postdata(); ?>
			
			<?php if( isset($cats['specialised_blog']) ) :
					
					$default_args['category'] = $cats['specialised_blog']->term_id;
					$specialised_blog = get_posts($default_args);
					
					foreach( $specialised_blog as $post ) :
					
					?>
					
					
					<section class="guytalk-home">
						
						<article>
						
							<h1><span><?php echo $cats['specialised_blog']->name; ?></span>&nbsp;</h1>
							
							<div class="split-featured-image">
								<img src="<?php bloginfo('template_url'); ?>/images/guytalk_head_bubble.png" alt="" />
							</div>
							
							<div class="split-content">
							
								<h3>Industry news and information From Martin Lindon-Jones</h3>
								
								<span class="author">Managing Director and Speaker</span>
								
								<p><?php echo get_excerpt(117, $post->post_content); ?></p>
								
								<a href="<?php echo get_permalink($post->ID); ?>" title="Read the full article <?php echo $post->post_title; ?>">Read the full article and others here</a>
							
							</div>
						
						<article>
					
					</section>
					
				<?php endforeach; ?>
				
			<?php endif; ?>
			
		</div>
	</div>
