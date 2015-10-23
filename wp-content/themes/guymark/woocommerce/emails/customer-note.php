<?php
/**
 * Customer note email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action('woocommerce_email_header', $email_heading); ?>


<tr><td align="left" style="text-align: left;">

<table width="614" cellspacing="0" cellpadding="6" border="0" style="font-family: sans-serif, Arial;font-size: 13px;text-align: left;color: #303030;line-height: 19px;">
	<tr>
		<td height="45" style="text-align: left;"><h1 style="line-height: 0px;text-align: left;color: #2e89c9;font-size: 23px;">A note has been added to your order</h1></td>
	</tr>
	<tr>
		<td style="padding-bottom: 8px;text-align: left;"><p style="margin: 0px;padding: 1px;line-height: 19px;text-align: left;color: #303030;">Dear Customer, <br /><br />A note has just been added to your order:</p></td>
	</tr>
	<tr>
		<td class="greendot" style="text-align: left;padding: 9px;background: #ddffc6;border: 1px dotted #17a600;"><p style="margin: 0px;padding: 1px;line-height: 19px;text-align: left;color: #303030;">
		<?php echo nl2br(wptexturize( $customer_note )); ?>
		</p></td>
	</tr>
	<tr><td class="divider" style="text-align: left;height: 19px;display: block;width: 615px;padding: 0px;margin: 0px;"></td></tr>
	<tr>
		<td height="21" style="text-align: left;"><p style="margin: 0px;padding: 1px;line-height: 19px;text-align: left;color: #303030;">For your reference, your order details are shown below.</p></td>
	</tr>
	<tr><td class="divider" style="text-align: left;height: 19px;display: block;width: 615px;padding: 0px;margin: 0px;"></td></tr>
	<tr>
		<td height="30" style="text-align: left;"><h2 style="font-size: 16px;margin: 0px;line-height: 0px;font-weight: bold;color: #303030;">Order: <?php echo $order->get_order_number(); ?>  (<?php echo date_i18n( woocommerce_date_format(), strtotime( $order->order_date ) ); ?>)</h2></td>
	</tr>
</table>


<table width="614" cellspacing="0" cellpadding="6" border="0" bordercolor="#efefef" class="border" style="font-family: sans-serif, Arial;font-size: 13px;text-align: left;color: #303030;line-height: 19px;border-right: 1px solid #d3d3d3;">
	<!-- table header -->
	<tr>
		<th width="371" align="left" style="text-align: left;border-top: 1px solid #d3d3d3;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;background: #f7f7f7;">Product</th>
		<th width="100" align="left" style="text-align: left;border-top: 1px solid #d3d3d3;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;background: #f7f7f7;">Quantity</th>
		<th width="100" align="left" style="text-align: left;border-top: 1px solid #d3d3d3;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;background: #f7f7f7;">Price</th>
	</tr>
	
	<?php echo $order->email_order_items_table( $order->is_download_permitted(), true ); ?>
</table>


<table width="614" border="0" cellpadding="6" cellspacing="0" bordercolor="#eee" class="border" style="font-family: sans-serif, Arial;font-size: 13px;text-align: left;color: #303030;line-height: 19px;border-right: 1px solid #d3d3d3;">
<?php
	if ( $totals = $order->get_order_item_totals() ) {
		$i = 0;
		foreach ( $totals as $total ) {
			$i++;
			?><tr class="lh17" style="line-height: 17px;">
				<th colspan="2" align="left" width="50%" class="l" style="text-align: left;border-top: 0px;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;background: #f7f7f7;"><?php echo $total['label']; ?></th>
				<td style="text-align: left;border-bottom: 1px solid #d3d3d3;border-left: 1px solid #d3d3d3;"><?php echo $total['value']; ?></td>
			</tr><?php
		}
	}
?>
</table>




<?php do_action('woocommerce_email_after_order_table', $order, false); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, false ); ?>

</td></tr>

<?php do_action('woocommerce_email_footer'); ?>
