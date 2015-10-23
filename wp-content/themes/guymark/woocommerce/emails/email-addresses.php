<?php
/**
 * Email Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$billing = $order->get_formatted_billing_address();
$shipping = "";

if ( get_option( 'woocommerce_ship_to_billing_address_only' ) == 'no' ) {
	$shipping = $order->get_formatted_shipping_address();
}
else {
	$shipping = $billing;
}
?>

<tr><td class="divider" style="text-align: left;height: 19px;display: block;width: 615px;padding: 0px;margin: 0px;"></td></tr>
<tr><td class="divider" style="text-align: left;height: 19px;display: block;width: 615px;padding: 0px;margin: 0px;"></td></tr>

<?php if (($order->billing_email) || ($order->billing_phone)) { ?>
<tr>
  <td style="text-align: left;">
	<table width="614" cellspacing="0" cellpadding="6" border="0" bordercolor="#eee" class="border" style="font-family: sans-serif, Arial;font-size: 13px;text-align: left;color: #303030;line-height: 19px;border-right: 1px solid #d3d3d3;">
        <!-- table header -->
        <tr><th colspan="2" align="left" style="text-align: left;border-top: 1px solid #d3d3d3;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;background: #f7f7f7;"><strong>Contact</strong></th></tr>
        
        <!-- item -->
		<?php if ($order->billing_email) : ?>
		<tr class="lh17" style="line-height: 17px;">
		  <td width="50%" style="text-align: left;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;"><strong>Email:</strong></td>
		  <td style="text-align: left;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;"><a href="mailto:<?php echo $order->billing_email; ?>" style="border: none;color: #ec1f27;outline: none;padding: 0px;margin: 0px;clear: left;white-space: nowrap;text-decoration: underline;"><?php echo $order->billing_email; ?></a></td>
		</tr>
		<?php endif; ?>
       
		<?php if ($order->billing_phone) : ?>
		<tr class="lh17" style="line-height: 17px;">
          <td style="text-align: left;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;"><strong>Tel:</strong></td>
          <td style="text-align: left;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;"><a href="tel:<?php echo str_replace(' ', '', $order->billing_phone); ?>" style="border: none;color: #ec1f27;outline: none;padding: 0px;margin: 0px;clear: left;white-space: nowrap;text-decoration: underline;"><?php echo $order->billing_phone; ?></a></td>
        </tr>
		<?php endif; ?>

    </table>
</td></tr>
<tr><td class="divider" style="text-align: left;height: 19px;display: block;width: 615px;padding: 0px;margin: 0px;"></td></tr>
<?php } ?>

<tr>
  <td style="text-align: left;">
  
    <table width="614" border="0" cellpadding="6" cellspacing="0" bordercolor="#eee" class="border" style="font-family: sans-serif, Arial;font-size: 13px;text-align: left;color: #303030;line-height: 19px;border-right: 1px solid #d3d3d3;">
        <tr>
            <th align="left" width="280" style="text-align: left;border-top: 1px solid #d3d3d3;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;background: #f7f7f7;"><strong>Billing Address</strong></th>
            <th class="no-border" style="text-align: left;border-top: 0px;border-bottom: 0px;border-left: 1px solid #d3d3d3;background: #FFF;"></th>
            <th align="left" width="280" style="text-align: left;border-top: 1px solid #d3d3d3;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;background: #f7f7f7;"><strong>Shipping Address</strong></th>
        </tr>
        <tr>
            <td align="left" style="text-align: left;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;">
				<?php echo $billing; ?>
			</td>
            <td class="no-border" style="text-align: left;border-bottom: 0px;border-left: 1px solid #d3d3d3;background: #FFF;border-top: 0px;"></td>
            <td style="text-align: left;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;">
                <?php echo $shipping; ?>
			</td>
        </tr>
    </table></td></tr>