<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com/
 * @since      1.0.0
 *
 * @package    Add_Band
 * @subpackage Add_Band/admin/partials
 */
?>


<?php
    	//Grab all options      
    	#$album_list = get_option($this->plugin_name);
    	$album_list = get_option('add-band-album-list');

?>

    <?php
    settings_fields($this->plugin_name);
do_settings_sections($this->plugin_name);
	
?>

	<table class="form-table">
	<tr>
		<th><?php esc_attr_e( 'Aktion', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'MA-Nummer', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Album-Name', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Band-Name', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Datum', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Format', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Cover-Link', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Album-Link', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Shop-Link', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Soldout', 'WpAdminStyle' ); ?></th>
	</tr>

	<?php
	    foreach ($album_list as ["id" => $id, "Album_Name" => $Album_Name, "Band_Name" => $Band_Name, "Datum" => $Datum, "Format" => $Format, "Img_URL" => $Img_URL, "Shop_Link" => $Shop_Link, "soldout_state" => $soldout_state ]) {
		$login_logo = wp_get_attachment_image_src( $Img_URL, 'thumbnail' );
    		$login_logo_url = $login_logo[0];
	?>
	<tr valign="top">
		<td scope="row">
			<a href="admin-post.php?action=delete_list_entry&data=<?php echo $id; ?>">Löschen</a>
		</td>
		<td scope="row">
			<?php echo $id; ?>
		</td>
		<td scope="row">
			<?php echo $Album_Name; ?>
		</td>
		<td scope="row">
			<?php echo $Band_Name; ?>
		</td>
		<td scope="row">
			<?php echo $Datum; ?>
		</td>
		<td scope="row">
			<?php echo $Format; ?>
		</td>
		<td scope="row">
			<img src=" <?php echo $login_logo_url; ?>"  style="height:50px;">
		</td>
		<td scope="row">
			<?php echo $Album_Link; ?>
		</td>
		<td scope="row">
			<?php echo $Shop_Link; ?>
		</td>
		<td scope="row">
		<input type="checkbox"  onclick="return false;"  <?php if ($soldout_state == "on"){ ?> checked <?php } ?> />
		</td>
	</tr>
	<?php
	}
	?>
	<tr valign="top">
	<form action="admin-post.php" method="post">
		<input type="hidden" name="action" value="add_list_entry">
	 	<input type="hidden" name="data" value="foobarid">
		<td scope="row">
				 <input type="submit" value="Add Entry">
		</td>
		<td scope="row">
				<input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-current_id" name="<?php echo $this->plugin_name; ?>[current_id]"  value="MA-Nummer" size="7" /><br>
		</td>
		<td scope="row">
				<input type="text" class="regular-text" id="current_album_name" name="<?php echo $this->plugin_name; ?>[current_album_name]"  value="Album_Name" size="10" /><br>
		</td>
		<td scope="row">
				<input type="text" class="regular-text" id="current_band_name" name="<?php echo $this->plugin_name; ?>[current_band_name]"  value="Band_Name" size="10" /><br>
		</td>
		<td scope="row">
				<input type="text" class="regular-text" id="current_date" name="<?php echo $this->plugin_name; ?>[current_date]"  value="Datum" size="4" /><br>
		</td>
		<td scope="row">
				<input type="text" class="regular-text" id="current_format" name="<?php echo $this->plugin_name; ?>[current_format]"  value="Format" size="4" /><br>
		</td>
		<td scope="row">

            		<fieldset>
                		<legend class="screen-reader-text"><span><?php esc_attr_e('Login Logo', $this->plugin_name);?></span></legend>
                    		<input type="hidden" id="login_logo_id" name="<?php echo $this->plugin_name;?>[login_logo_id]" value="<?php echo $login_logo_id; ?>" />
                    		<input id="upload_login_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', $this->plugin_name); ?>" />
            		</fieldset>

		</td>
		<td scope="row">
				<input type="text" class="regular-text" id="current_album_link" name="<?php echo $this->plugin_name; ?>[current_album_link]"  value="Album Link" /><br>
		</td>
		<td scope="row">
				<input type="text" class="regular-text" id="current_shop_link" name="<?php echo $this->plugin_name; ?>[current_shop_link]"  value="Shop Link" /><br>
		</td>
		<td scope="row">
				 <input type="checkbox" id="current_soldout_state" name="<?php echo $this->plugin_name;?>[current_soldout_state]" />
		</td>
		</form>
	</tr>
</table>


