<?php 
	// Don't display sidebar if full width
	global $woo_options;
	if ( $woo_options[ 'woo_layout' ] != "layout-full" ) :
?>	
<div id="sidebar" class="col-right">

	<?php if ( woo_active_sidebar( 'tertiary' ) ) : ?>
    <div class="tertiary">
		<?php woo_sidebar( 'tertiary' ); ?>		           
	</div>        
	<?php endif; ?>    
	
</div><!-- /#sidebar -->

<?php endif; ?>
