<?php
/**
 * Customer Reset Password email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action('woocommerce_email_header', $email_heading); ?>


<tr><td align="left" style="text-align: left;">

	<table width="615" cellspacing="0" cellpadding="6" border="0" style="font-family: sans-serif, Arial;font-size: 13px;text-align: left;color: #303030;line-height: 19px;">
        <tr>
            <td height="45" style="text-align: left;"><h1 style="line-height: 0px;text-align: left;color: #2e89c9;font-size: 23px;">Password reset instructions</h1></td>
        </tr>
        <tr>
            <td height="30" style="text-align: left;"><h2 style="font-size: 16px;margin: 0px;line-height: 0px;font-weight: bold;color: #303030;">Someone requested that the password be reset for the following account:</h2></td>
        </tr>
        <tr>
            <td height="30" style="text-align: left;"><p style="margin: 0px;padding: 1px;line-height: 19px;text-align: left;color: #303030;"><strong>Username: </strong><?php echo $user_login; ?></p></td>
        </tr>
        <tr>
            <td height="30" style="text-align: left;"><p style="margin: 0px;padding: 1px;line-height: 19px;text-align: left;color: #303030;">If this was a mistake, just ignore this email and nothing will happen.</p></td>
        </tr>
		<tr>
        	<td style="text-align: left;"><p style="margin: 0px;padding: 1px;line-height: 19px;text-align: left;color: #303030;">To reset your password, visit the following address:<br /><a href="<?php echo esc_url( add_query_arg( array( 'key' => $reset_key, 'login' => rawurlencode( $user_login ) ), get_permalink( woocommerce_get_page_id( 'lost_password' ) ) ) ); ?>" style="display: inline-block; border: none;color: #ec1f27;outline: none;padding: 0px;margin: 0px;white-space: nowrap;text-decoration: underline;">Click here to reset your password</a></p>
            </td>
        </tr>
    </table>

	<!-- totals --></td></tr>



<?php do_action('woocommerce_email_footer'); ?>
