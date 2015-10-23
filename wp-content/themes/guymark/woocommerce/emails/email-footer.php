<?php
/**
 * Email Footer
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Unused woocommerce code here:
// ------------------------------------
// Load colours
// $base = get_option( 'woocommerce_email_base_color' );
// $base_lighter_40 = woocommerce_hex_lighter( $base, 40 );

// For gmail compatibility, including CSS styles in head/body are stripped out therefore styles need to be inline. These variables contain rules which are added to the template inline - ???

?>


</table>
<!-- center content above -->

  </td></tr>
  <tr><td class="divider" style="text-align: left;height: 19px;display: block;width: 615px;"></td></tr>
  <tr><td class="divider" style="text-align: left;height: 19px;display: block;width: 615px;"></td></tr>
  <tr><td class="divider3" style="text-align: left;background: #ec1f27;height: 1px;width: 615px;display: block;"></td></tr>
  <tr><td class="divider" style="text-align: left;height: 19px;display: block;width: 615px;"></td></tr>
  <tr><td align="center" class="center" style="text-align: center;"><?php echo wp_kses_post( wptexturize( apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) ) ); ?></td></tr>
  <tr><td class="divider" style="text-align: left;height: 19px;display: block;width: 615px;"></td></tr>
</table>


</body>
</html>