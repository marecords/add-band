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
	var_dump($band_list);
?>

	<table class="form-table">
	<tr>
		<th><?php esc_attr_e( 'Aktion', 'WpAdminStyle' ); ?></th>
        <th><?php esc_attr_e( 'Band-Name', 'WpAdminStyle' ); ?></th>
		<th><?php esc_attr_e( 'id', 'WpAdminStyle' ); ?></th>

	</tr>

<?php
        foreach ($band_list as $band ){
	?>
	<tr valign="top">
		<td scope="row">
			<a href="admin-post.php?action=delete_band_list_entry&data=<?php echo $band["id"]; ?>">Löschen</a>
            	<a class="button" href="admin.php?page=editband&id=<?php echo $band["id"]; ?>">Bearbeiten</a>
		</td>
		<td scope="row">
            <?php echo $band["Band_Name"]; ?>
			
		</td>
		<td scope="row">
			<?php echo $band["id"]; ?>
		</td>
	</tr>
	<?php
        }

	?>
</table>
<a class="button" href="admin.php?page=addnewband">Band hinzufügen</a>

