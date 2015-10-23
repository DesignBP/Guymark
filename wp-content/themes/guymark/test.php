
<?php
/*
Template Name: Test - Staff Profiles
*/
?>

<?php get_header(); ?>



<?php
	if( $team = get_field('add_a_new_member_of_the_team') ) {
			
			$members_by_department = array();
			
			foreach( $team as $key=>$val ) {
				// Use thumb id as unique id for array assignment
				$id = $val['profile_image']['id'];
				
				if( $val['department'] == 'Sales' ) {
					$members_by_department['sales'][$id] = $val;
				
				}elseif( $val['department'] == 'Admin' ) {
					$members_by_department['admin'][$id] = $val;
				
				}elseif( $val['department'] == 'Servicing' ) {
					$members_by_department['servicing'][$id] = $val;
					
				}elseif( $val['department'] == 'Directors' ) {
					$members_by_department['directors'][$id] = $val;
				
				}else {
					$members_by_department['other'][$id] = $val;
				}
				
			}
		
	}
?> 

	
	<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
		<?php woo_breadcrumbs(); ?> 
	<?php } ?>
	
	
	
	<div class="container">
		
		<div class="block">
					
			<div <?php post_class(); ?>>
				
			    <h1 class="title"><?php the_title(); ?></h1>
				
				<div id="team-profiles" class="entry">
					
					<?php while (have_posts()) : the_post(); ?>
					
						<?php echo the_content(); ?>
					
					<?php endwhile; ?>
					
					
					<?php
					// DIRECTORS
					if( $members_by_department['sales'] ) : ?>
						
						<h2>Directors Team</h2>
							
							<div class="team-profile-group">
								<?php foreach( $members_by_department['directors'] as $department=>$member ) : ?>
									
									<?php $image = DB_get_image_with_fallback( $member['profile_image']['id'], '', true ); ?>
									
									<div class="team-member">
										<ul>
											<li><img src="<?php echo $image; ?>" alt="" /></li>
											<li><?php echo $member['name']; ?></li>
											<li><?php echo $member['position']; ?></li>
											<li><?php echo $member['department']; ?></li>
											<li><?php echo $member['sales_region']; ?></li>
											<li><?php echo $member['bio']; ?></li>
										</ul>
									</div>
							
								<?php endforeach; ?>
							</div>
						
					<?php endif; ?>
					
					
					<?php
					// SALES
					if( $members_by_department['sales'] ) : ?>
						
						<h2>Sales Team</h2>
							
							<div class="team-profile-group">
								<?php foreach( $members_by_department['sales'] as $department=>$member ) : ?>
									
									<?php $image = DB_get_image_with_fallback( $member['profile_image']['id'], '', true ); ?>
									
									<div class="team-member">
										<ul>
											<li><img src="<?php echo $image; ?>" alt="" /></li>
											<li><?php echo $member['name']; ?></li>
											<li><?php echo $member['position']; ?></li>
											<li><?php echo $member['department']; ?></li>
											<li><?php echo $member['sales_region']; ?></li>
											<li><?php echo $member['bio']; ?></li>
										</ul>
									</div>
							
								<?php endforeach; ?>
							</div>
						
					<?php endif; ?>
					
					
					<?php
					// ADMIN
					if( $members_by_department['admin'] ) : ?>
						
						<h2>Admin Team</h2>
							
							<div class="team-profile-group">
								<?php foreach( $members_by_department['admin'] as $department=>$member ) : ?>
									
									<?php $image = DB_get_image_with_fallback( $member['profile_image']['id'], '', true ); ?>
									
									<div class="team-member">
										<ul>
											<li><img src="<?php echo $image; ?>" alt="" /></li>
											<li><?php echo $member['name']; ?></li>
											<li><?php echo $member['position']; ?></li>
											<li><?php echo $member['department']; ?></li>
											<li><?php echo $member['sales_region']; ?></li>
											<li><?php echo $member['bio']; ?></li>
										</ul>
									</div>
							
								<?php endforeach; ?>
							</div>
						
					<?php endif; ?>
					
					
					<?php
					// SERVICING
					if( $members_by_department['servicing'] ) : ?>
						
						<h2>Servicing Team</h2>
							
							<div class="team-profile-group">
								<?php foreach( $members_by_department['servicing'] as $department=>$member ) : ?>
									
									<?php $image = DB_get_image_with_fallback( $member['profile_image']['id'], '', true ); ?>
									
									<div class="team-member">
										<ul>
											<li><img src="<?php echo $image; ?>" alt="" /></li>
											<li><?php echo $member['name']; ?></li>
											<li><?php echo $member['position']; ?></li>
											<li><?php echo $member['department']; ?></li>
											<li><?php echo $member['sales_region']; ?></li>
											<li><?php echo $member['bio']; ?></li>
										</ul>
									</div>
							
								<?php endforeach; ?>
							</div>
						
					<?php endif; ?>
					
				</div><!--entry-->
			
			</div><!--post-->	
		                
        
        <?php // wp_reset_query(); ?>

		<?php get_sidebar(); ?>
		
		</div>
		
    </div>
		
<?php get_footer(); ?>
