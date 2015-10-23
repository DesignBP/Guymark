<?php

// Register widgetized areas

if (!function_exists( 'the_widgets_init')) {
	function the_widgets_init() {
		if ( !function_exists( 'register_sidebar') )
			return;
	
		register_sidebar(array( 'name' => 'Product Information','id' => 'primary','description' => "This sidebar displays on the product information pages.", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		register_sidebar(array( 'name' => 'Custom Footer','id' => 'secondary','description' => "Custom Footer Blocks", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));   
		register_sidebar(array( 'name' => 'Shop','id' => 'tertiary','description' => "This sidebar displays on the shop pages.", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));   
	}
}

add_action( 'init', 'the_widgets_init' );


?>
