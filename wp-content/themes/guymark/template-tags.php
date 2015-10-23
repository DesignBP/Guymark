<?php
/*
Template Name: Tags
*/
?>

<?php get_header(); ?>

	<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
		<?php woo_breadcrumbs(); ?> 
	<?php } ?>


	<div class="container">
		
		<div class="block">
            
            <div <?php post_class(); ?>>

			    <h1 class="title"><?php the_title(); ?></h1>
                
	            <?php if (have_posts()) : the_post(); ?>
            	<div class="entry">
            		<?php the_content(); ?>
            	</div>	            	
	            <?php endif; ?>  
	            
                <div class="tag_cloud">
        			<?php wp_tag_cloud( 'number=0' ); ?>
    			</div>

            </div><!-- /.post -->
        
		</div>
		
    </div>
		
<?php get_footer(); ?>
