<?php do_action('woocommerce_wishlists_before_wrapper'); ?>
<?php $lists = WC_Wishlists_User::get_wishlists(); ?>
<div id="wl-wrapper" class="woocommerce">

	<?php if (function_exists('wc_print_messages')) : ?>
		<?php wc_print_messages(); ?>
	<?php else : ?>
		<?php WC_Wishlist_Compatibility::wc_print_notices(); ?>
	<?php endif; ?>
	
	<div class="wl-row">
		<?php
			global $wishlist_session_key;
			if (!is_user_logged_in()) {
				$wishlist_session_key = WC_Wishlists_User::get_wishlist_key();
			}
			if ($wishlist_session_key) {
				$lists = WC_Wishlists_User::get_wishlists(false, $wishlist_session_key);
				if(count($lists) == 0){
		?>
		<a href="<?php echo WC_Wishlists_Pages::get_url_for('create-a-list'); ?>" class="button alt wl-create-new"><?php _e('Create a new list', 'wc_wishlist'); ?></a>
		<?php
				}
			}
			else {
		?>
		<a href="<?php echo WC_Wishlists_Pages::get_url_for('create-a-list'); ?>" class="button alt wl-create-new"><?php _e('Create a new list', 'wc_wishlist'); ?></a>
		<?php
			}
		?>
		<a href="#" onclick="$('#form-wishlist').submit()" class="button alt wl-save-list"><?php _e('Save settings', 'wc_wishlist'); ?></a>
		<div class="clearfix"></div>
	</div>

	<?php if ($lists && count($lists)) : ?>
	        <form id="form-wishlist" method="post">

			<?php echo WC_Wishlists_Plugin::nonce_field('edit-lists'); ?>
			<?php echo WC_Wishlists_Plugin::action_field('edit-lists'); ?>
			<?php $lists = WC_Wishlists_User::get_wishlists(); ?>


			<table class="shop_table cart wl-table wl-manage" cellspacing="0">
				<thead>
					<tr>
						<th class="product-name"><?php _e('List name', 'wc_wishlist'); ?></th>
						<th class="wl-date-added"><?php _e('Date added', 'wc_wishlist'); ?></th>
						<th class="wl-privacy-col"><?php _e('Privacy settings', 'wc_wishlist'); ?></th>
					</tr>
				</thead>
				<tbody>

					<?php
										
					$inv_lists = WC_Wishlists_User::get_wishlists();
					$inv_listcount = count($lists);
					
					foreach ($lists as $list) : ?>
						<?php
						$sharing = $list->get_wishlist_sharing();
						$inventory_default = get_user_meta(get_current_user_id(), "inventory_default", true);
						$class_add = "";
						if($inv_listcount == 1){
							$inventory_default = $list->id;
						}
						if($inventory_default == $list->id){
							$class_add = " default-inventory-item";
						}
						
						?>

						<tr class="cart_table_item <?php echo WC_Wishlists_Request_Handler::last_updated_class($list->id) . $class_add; ?>">
							<td class="product-name">
								<strong><a href="<?php $list->the_url_edit(); ?>"><?php $list->the_title(); ?></a></strong>
								<div class="row-actions">
									<span class="trash">
										<small><a class="ico-delete wlconfirm" data-message="<?php _e('Are you sure you want to delete this list?', 'wc_wishlist'); ?>" href="<?php $list->the_url_delete(); ?>"><?php _e('X', 'wc_wishlist'); ?></a></small>
									</span>
									|
									<span class="edit">
										<small><a href="<?php $list->the_url_edit(); ?>"><?php _e('Manage', 'wc_wishlist'); ?></a></small>
									</span>
									<?php
									if($class_add == "" || (inv_listcount == 1)){
									?>
									|
									<span class="primary">
										<small><a href="/inventory/?wlaction=default-list&wlno=<?php echo $list->id; ?>"><?php _e('Set as primary list', 'wc_wishlist'); ?></a></small>
									</span>
									<?php
									}
									else {
									?>
									|
									<span class="primary">
										<small><?php _e('Primary list', 'wc_wishlist'); ?></small>
									</span>
									<?php
									}
									?>
								</div>
								<?php if ($sharing == 'Public' || $sharing == 'Shared') : ?>
									<?php woocommerce_wishlists_get_template('wishlist-sharing-menu.php', array('id' => $list->id)); ?>
								<?php endif; ?>
							</td>
							<td class="wl-date-added"><?php echo date(get_option('date_format'), strtotime($list->post->post_date)); ?></td>
							<td class="wl-privacy-col">
								<select class="wl-priv-sel" name="sharing[<?php echo $list->id; ?>]">
									<option <?php selected($sharing, 'Public'); ?> value="Public"><?php _e('Public', 'wc_wishlist'); ?></option>
									<option <?php selected($sharing, 'Shared'); ?> value="Shared"><?php _e('Shared', 'wc_wishlist'); ?></option>
									<option <?php selected($sharing, 'Private'); ?> value="Private"><?php _e('Private', 'wc_wishlist'); ?></option>
								</select>

							</td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="2">&nbsp;</td>
						<td class="actions">
							<input type="submit" class="button wl-but" name="update_wishlists" value="<?php _e('Save settings', 'wc_wishlist'); ?>" />
						</td>
					</tr>

				</tbody>
			</table>
	        </form>
	<?php else : ?>
		<p>
			<?php $shop_url = get_permalink(woocommerce_get_page_id('shop')); ?>
			<?php _e('You have not created any lists yet.', 'wc_wishlist'); ?> <a href="<?php echo $shop_url; ?>"><?php _e('Go shopping to create one.', 'wc_wishlist'); ?></a>.
		</p>
	<?php endif; ?>

	<?php
	if ($lists && count($lists)) :
		foreach ($lists as $list) :
			$sharing = $list->get_wishlist_sharing();
			if ($sharing == 'Public' || $sharing == 'Shared') :
				woocommerce_wishlists_get_template('wishlist-email-form.php', array('wishlist' => $list));
			endif;
		endforeach;
	endif;
	?>
</div><!-- /wishlist-wrapper -->
<?php do_action('woocommerce_wishlists_after_wrapper'); ?>
