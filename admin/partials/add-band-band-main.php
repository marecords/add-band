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
	$band_list = get_option('add-band-band-list');
	settings_fields($this->plugin_name);
	do_settings_sections($this->plugin_name);
	
?>

	<table class="form-table">
	<tr>
		<th><?php esc_attr_e( 'Löschen', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Ändern', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'id', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'Band-Name', 'WpAdminStyle' ); ?></th>
	</tr>

<?php
		/*
	    foreach ($band_list as ["id" => $id, "Album_Name" => $Album_Name, "Band_Name" => $Band_Name, "Datum" => $Datum, "Format" => $Format, "Img_URL" => $Img_URL, "Shop_Link" => $Shop_Link, "soldout_state" => $soldout_state ]) {
		$login_logo = wp_get_attachment_image_src( $Img_URL, 'thumbnail' );
		$login_logo_url = $login_logo[0];
		 */
	    foreach ($band_list as ["id" => $id, "Band_Name" => $Band_Name ] ){
	?>
	<tr valign="top">
		<td scope="row">
			<a href="admin-post.php?action=delete_band_list_entry&data=<?php echo $id; ?>">Löschen</a>
		</td>
		<td scope="row">
			<a href="admin.php?page=editband&id=<?php echo $id; ?>">Ändern</a>
		</td>
		<td scope="row">
			<?php echo $id; ?>
		</td>
		<td scope="row">
			<?php echo $Band_Name; ?>
		</td>
	</tr>
	<?php
	}
	?>
	        <a href="admin.php?page=addnewband"; >Band hinzufügen</a>
</table>


