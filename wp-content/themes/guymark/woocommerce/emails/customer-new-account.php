<?php
/**
 * Customer new account email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>


<?php
$permalink = get_permalink(woocommerce_get_page_id('myaccount'));
?>

<tr><td align="left" style="text-align: left;">

	<table width="615" cellspacing="0" cellpadding="6" border="0" style="font-family: sans-serif, Arial;font-size: 13px;text-align: left;color: #303030;line-height: 19px;">
        <tr>
            <td height="45" style="text-align: left;"><h1 style="line-height: 0px;text-align: left;color: #2e89c9;font-size: 23px;">Welcome to Guymark, Excellence in Audiology</h1></td>
        </tr>
        <tr>
          <td height="30" style="text-align: left;"><p style="margin: 0px;padding: 1px;line-height: 19px;text-align: left;color: #303030;">Thanks for creating an account on Guymark - Excellence in Audiology. Your username is <strong><?php echo esc_html( $user_login ); ?></strong>.</p></td>
        </tr>
		<tr>
        	<td style="text-align: left;"><p style="margin: 0px;padding: 1px;line-height: 19px;text-align: left;color: #303030;">You can access your account area here: <a href="<?php echo $permalink; ?>" style="border: none;outline: none;padding: 0px;margin: 0px;clear: left;white-space: nowrap;color: #ec1f27;text-decoration: underline;"><?php echo $permalink; ?></a>.</p>
            </td>
        </tr>
    </table>

</td></tr>


<?php do_action( 'woocommerce_email_footer' ); ?>
