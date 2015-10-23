<?php
/**
 * Email Header
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Unused woocommerce code
// Load colours
// $bg 		= get_option( 'woocommerce_email_background_color' );
// $body		= get_option( 'woocommerce_email_body_background_color' );
// $base 		= get_option( 'woocommerce_email_base_color' );
// $base_text 	= woocommerce_light_or_dark( $base, '#202020', '#ffffff' );
// $text 		= get_option( 'woocommerce_email_text_color' );

// $bg_darker_10 = woocommerce_hex_darker( $bg, 10 );
// $base_lighter_20 = woocommerce_hex_lighter( $base, 20 );
// $text_lighter_20 = woocommerce_hex_lighter( $text, 20 );

?>
															
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Guymark, Excellence in Audiology</title>




</head>


<body>

<table width="615" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family: sans-serif, Arial;font-size: 13px;text-align: left;color: #303030;line-height: 19px;">
  <tr><td height="10" style="text-align: left;"></td></tr>
  <tr><td height="135" style="text-align: left;">
	<?php
		if ( $img = get_option( 'woocommerce_email_header_image' ) ) {
			echo '<img src="' . esc_url( $img ) . '" alt="' . get_bloginfo( 'name' ) . '" style="outline: none;padding: 0px;margin: 0px;text-align: left;border: 0px;" />';
		}
	?>
  </td></tr>
  <tr><td class="divider2" style="text-align: left;height: 17px;display: block;width: 615px;"></td></tr>
  <tr><td style="text-align: left;">



<!-- center content below -->

<table class="shared-ordertable" width="616" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family: sans-serif, Arial;font-size: 13px;text-align: left;color: #303030;line-height: 22px;">
