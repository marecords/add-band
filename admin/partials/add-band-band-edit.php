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
    		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		$id = $_REQUEST['id'];
		$band_list = get_option('add-band-band-list');
		$band_list_entry = $band_list[$id];
		var_dump( $band_list_entry);
	?>

<form action="admin-post.php" method="post">
    	<input type="hidden" name="action" value="edit_band_list_entry">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	Band Name:
	<input type="text" class="regular-text" id="band_name" name="<?php echo $this->plugin_name; ?>[band_name]"  value="<?php echo $band_list_entry['Band_Name']  ?>" size="10" /><br>
	Videos:
	<br>
	<input type="text" class="regular-text" id="video01_name" name="<?php echo $this->plugin_name; ?>[video01_name]"  value="<?php echo $band_list_entry['Video01']  ?>" size="10" /><br>
	<input type="text" class="regular-text" id="video02_name" name="<?php echo $this->plugin_name; ?>[video02_name]"  value="<?php echo $band_list_entry['Video02']  ?>" size="10" /><br>
	<input type="text" class="regular-text" id="video03_name" name="<?php echo $this->plugin_name; ?>[video03_name]"  value="<?php echo $band_list_entry['Video03']  ?>" size="10" /><br>
	<input type="text" class="regular-text" id="video04_name" name="<?php echo $this->plugin_name; ?>[video04_name]"  value="<?php echo $band_list_entry['Video04']  ?>" size="10" /><br>
	<input type="text" class="regular-text" id="video05_name" name="<?php echo $this->plugin_name; ?>[video05_name]"  value="<?php echo $band_list_entry['Video05']  ?>" size="10" /><br>
	<?php
		$settings = array( 'textarea_name' => 'editor_text');
		$editor_id = 'band_editor';
		wp_editor( $band_list_entry['Text'], $editor_id , $settings );
	?>
	 <input type="submit" value="Edit Band">


</form>


