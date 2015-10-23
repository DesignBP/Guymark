<?php
/**
 * WooCommerce SecureTrading Gateway
 * By Niklas Högefjord (niklas@krokedil.se)
 * 
 * Uninstall - removes all SecureTrading options from DB when user deletes the plugin via WordPress backend.
 * @since 0.3
 **/
 
if ( !defined('WP_UNINSTALL_PLUGIN') ) {
    exit();
}
	delete_option( 'woocommerce_securetrading_settings' );		
?>