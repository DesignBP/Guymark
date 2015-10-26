<?php
/**
 * Header Template
 *
 */
 global $woo_options, $woocommerce;
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1"/>
<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/base64.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.selectric.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mobilemenu.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/flowtype.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9SEZ6Yu8NWCkcm2RfwlF7jC-GxpRqb2o&sensor=true"></script>

<script>
$(function(){
	$('#dropdown_product_cat').selectric();
	$('select.orderby').selectric();
	$("select.orderby").change(function(){$(this).closest("form").submit()});
	$('.container.nav nav ul').mobileMenu({switchWidth: 1007 - 16, topOptionText: 'Select a page', prependTo: '.container.nav nav, footer nav'});
    $(".home-slider").flowtype({ maximum: 1000, maxFont: 100, fontRatio: 10 });
});
</script>

<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>

<!-- The main stylesheet -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/selectric.css">

<link href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" rel="shortcut icon">

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php $GLOBALS['feedurl'] = get_option('woo_feed_url'); if ( !empty($feedurl) ) { echo $feedurl; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script type="text/javascript">
	if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {
		var viewportmeta = document.querySelector('meta[name="viewport"]');
			if (viewportmeta) {
			viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0';
			document.body.addEventListener('gesturestart', function() {
			  viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
			}, false);
		}
	}
</script>
		
<?php wp_head(); ?>
<?php woo_head(); ?>

</head>

<body <?php body_class(get_option('woo_site_layout')); ?>>
<?php woo_top(); ?>

<div class="container header">

	<div class="block">
		<header>
			<div id="logo">
				<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('title'); ?> - Home">
					<img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="Home" />
					<img src="<?php bloginfo('template_url'); ?>/images/logo_subtext.png" alt="" />
				</a>
			</div>
		
            <div class="mobileonly single-cart-totals" style="display: none;">
                <?php woo_nav_before(); ?>
            </div>
			<div id="header-right">
				<?php woo_search(); ?>
				<div class="single-cart-totals">
					<?php woo_nav_before(); ?>
				</div>
				
			</div>
		</header>
	</div>

</div>



<div class="container nav">

	<div class="block">
	
		<nav>
			<?php
			if ( function_exists( 'has_nav_menu') && has_nav_menu( 'primary-menu') ) {
				wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
			} 
			?>
		</nav>
	
	</div>
	
</div>
