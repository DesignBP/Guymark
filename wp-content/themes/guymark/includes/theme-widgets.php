<?php
/*-----------------------------------------------------------------------------------*/
/* Load the widgets, with support for overriding the widget via a child theme.
/*-----------------------------------------------------------------------------------*/

$widgets = array(
				//'includes/widgets/widget-woo-tabs.php', 
				//'includes/widgets/widget-woo-adspace.php', 
				//'includes/widgets/widget-woo-blogauthor.php', 
				'includes/widgets/widget-woo-embed.php', 
				//'includes/widgets/widget-woo-flickr.php', 
				'includes/widgets/widget-woo-search.php', 
				//'includes/widgets/widget-woo-twitter.php', 
				'includes/widgets/widget-woo-subscribe.php'
				);

// Allow child themes/plugins to add widgets to be loaded.
$widgets = apply_filters( 'woo_widgets', $widgets ) ;
				
	foreach ( $widgets as $w ) {
		locate_template( $w, true );
	}

/*---------------------------------------------------------------------------------*/
/* Deregister Default Widgets */
/*---------------------------------------------------------------------------------*/
if (!function_exists( 'woo_deregister_widgets')) {
	function woo_deregister_widgets(){
	    unregister_widget( 'WP_Widget_Search' );         
	}
}
add_action( 'widgets_init', 'woo_deregister_widgets' );  


/*---------------------------------------------------------------------------------*/
/* Override Default Widgets */
/*---------------------------------------------------------------------------------*/
add_action( 'widgets_init', 'override_category_widget', 15 );
function override_category_widget() {
  // Ensure our parent class exists to avoid fatal error (thanks Wilgert!)
 
  if ( class_exists( 'WC_Widget_Product_Categories' ) ) {
    unregister_widget( 'WC_Widget_Product_Categories' );
    include_once( 'widgets/widget-guymark-category.php' );
    register_widget( 'WC_Widget_Guymark_Categories' );
  }
  
  if ( class_exists( 'WC_Widget_Top_Rated_Products' ) ) {
    unregister_widget( 'WC_Widget_Top_Rated_Products' );
    include_once( 'widgets/widget-guymark-toprated.php' );
    register_widget( 'WC_Widget_Guymark_TopRated' );
  }
 
}

?>
