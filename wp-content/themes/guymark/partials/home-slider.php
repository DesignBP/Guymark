<?php
$slides = query_posts(array(
	'sort_order' => 'ASC',
	'sort_column' => 'post_date',
	'post_status' => 'publish',
	'post_type' => 'home-slider',
	'showposts' => 0
));
?>

<?php if( $slides ) : ?>
	
	<div class="container home-slider">
					
		<div class="cycle-slideshow"
				 data-cycle-slides=".home-slide"
				 data-cycle-timeout="4000"
				 data-cycle-pause-on-hover="false"
				 data-cycle-speed="500"
				 >
		
		<?php 
		$first_element = "";
		foreach( $slides as $slide ) : ?>
			
			<?php
			// Get the URL link if assigned
			$link = get_field("page_link", $slide->ID);
			
			if( $background = get_field("full_width_image", $slide->ID)) :
				$background = $background['url'];
			else:
				$background = "";
			endif;
			?>
			
			
				<div class="home-slide" style="<?php echo $first_element; ?>background: transparent url(<?php echo $background; ?>) no-repeat center center; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $background; ?>', sizingMethod='scale'); -ms-filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $background; ?>', sizingMethod='scale')'; background-size: cover;">
					
					<div class="block">
					
						<div class="home-slide-content">
						
							<h1><?php if($tagline = get_field("first_line", $slide->ID)) echo $tagline; ?></h1>
						
							<h2 class="home-slide-sub-statement"><?php if($sub_statement = get_field("second_line", $slide->ID)) echo $sub_statement; ?></h2>
						
							<?php if($tagline_support = get_field("bold_support_line", $slide->ID)) : ?>
								<p class="home-slide-bold-statement"><?php echo $tagline_support; ?></p>
							<?php endif; ?>
						
							<?php if($additional_text = get_field("additional_support_text", $slide->ID)) : ?>
								<p class="home-slide-support-statement"><?php echo $additional_text; ?></p>
							<?php endif; ?>
						
							<?php if( $sub_gallery = get_field("slide_support_images", $slide->ID)) : ?>
								<div class="home-slide-gallery">
									<?php foreach( $sub_gallery as $gallery=>$sub_gallery ) {
											echo "<img src=\"" . $sub_gallery['gallery_image']['sizes']['thumbnail']. "\" alt=\"\" />";
										}
									?>
								</div>
							<?php endif; ?>
							
							
							<?php if( $link ) : ?>
								
									<a href="<?php echo $link; ?>" title="Find out more about this" class="find-out-more">Find out more</a>
						
							<?php endif; ?>
							
						</div>
					</div>
					
				</div>

			<?php
			$first_element = "display: none;";
			endforeach; ?>
			
		</div>
			
		</div>
		
	</div>

<?php endif; ?>
