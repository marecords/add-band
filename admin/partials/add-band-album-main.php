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
    $album_list = get_option('add-band-album-list');
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
		<th><?php esc_attr_e( 'Shop-Link', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Soldout', 'WpAdminStyle' ); ?></th>
	</tr>

	<?php
        foreach ($album_list as $val => $val_value){
	    foreach ($val_value as [ "Id" => $id, "Album_Name" => $Album_Name, "Band_Name" => $Band_Name, "Datum" => $Datum, "Format" => $Format, "Img_URL" => $Img_URL, "Shop_Link" => $Shop_Link, "soldout_state" => $soldout_state ]) {
		$login_logo = wp_get_attachment_image_src( $Img_URL, 'thumbnail' );
    		$login_logo_url = $login_logo[0];
	?>
	<tr valign="top">
		<td scope="row">
			<a class="button" href="admin-post.php?action=delete_album_list_entry&data=<?php echo $id; ?>">Löschen</a>
            <a class="button" href="admin.php?page=editalbum&id=<?php echo $id; ?>">Bearbeiten</a>
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
			<?php echo $Shop_Link; ?>
		</td>
		<td scope="row">
		<input type="checkbox"  onclick="return false;"  <?php if ($soldout_state == "on"){ ?> checked <?php } ?> />
		</td>
	</tr>
	<?php
	}
        }
	?>
</table>
<a class="button" href="admin.php?page=addnewalbum">Album hinzufügen</a>

