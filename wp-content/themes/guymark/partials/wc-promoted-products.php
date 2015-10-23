	<?php global $woo_options, $woocommerce; ?>
	
	<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => get_option( 'woo_featured_product_limit' ),
			'meta_key' => '_featured',
			'meta_value' => 'yes'
			);
			
		$loop = new WP_Query( $args );
		
	?>
	
	
	<?php if ($loop && $loop->post_count > 0 ) : ?>
	
	<div class="container featured-intro">
		<div class="block">
			<h2>Featured products</h2>
		</div>
	</div>
	
	
	<div class="container featured-slideshow">
		
			<div class="block">
			
				<div id="wrapper-bg" class="featured-products">
					
					<div class="cycle-slideshow"
						 data-cycle-slides=".featured-product"
						 data-cycle-timeout="3500"
						 data-cycle-pause-on-hover="true"
						 data-cycle-speed="1000"
						 data-cycle-fx=scrollHorz
						 data-cycle-prev=".slideshow-prev"
						 data-cycle-next=".slideshow-next"
						 >
						
						<?php
							
							$i = 0;
							
							while ( $loop->have_posts() ) : $loop->the_post(); $_product;
							
								if ( function_exists( 'get_product' ) ) {
									$_product = get_product( $loop->post->ID );
								} else {
									$_product = new WC_Product( $loop->post->ID );
								}
								
								$first = $i == 0 ? ' first' : '';
								?>
							
							<div class="featured-product<?php echo $first; ?>">
							
								<div class="featured-product-content">
									<h3><?php the_title(); ?></h3>
									
									<?php if( the_excerpt() ) : ?>
										<p><?php the_excerpt(); ?></p>
									<?php endif; ?>
									
									<div class="buttons">
										<?php $product_id = $loop->post->ID; ?>
										<a class="add-to-inventory" href="/shop/?add-to-cart=<?php echo $product_id; ?>&add-to-wishlist-itemid=<?php echo $product_id; ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">Add to inventory</a>
										<a class="find-out-more" href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">Find out more</a>
										<div class="clearfix"></div>
									</div>
									
									
								</div>
								
								<div class="featured-product-thumb">
									<?php if ( has_post_thumbnail( $loop->post->ID ) ) echo get_the_post_thumbnail( $loop->post->ID, array(400, 300)); else echo '<img src="' . $woocommerce->plugin_url() . '/assets/images/placeholder.png" alt="Placeholder" width="' . $woocommerce->get_image_size( 'shop_thumbnail_image_width' ) . 'px" height="' . $woocommerce->get_image_size( 'shop_thumbnail_image_height' ) . 'px" />'; ?>
								</div>
								
							</div>
							
						
						<?php
							$i++; 
							endwhile;
						?>
						
					</div><!-- slideshow -->
					
				</div><!-- wrapper -->
				
			</div><!-- block -->
			
			
			<div class="slideshow-nav">
				
				<div class="slideshow-prev">
					<img src="<?php bloginfo('template_url'); ?>/images/prev.png" alt="" />
				</div>
				
				<div class="slideshow-next">
					<img src="<?php bloginfo('template_url'); ?>/images/next.png" alt="" />
				</div>
				
			</div>
			
			
	</div><!-- container -->
		
<?php endif; ?>
