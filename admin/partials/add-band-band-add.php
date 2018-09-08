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
    $band_list = get_option('add-band-band-list');
    var_dump($band_list);
?>

<form action="admin-post.php" method="post">
    	<input type="hidden" name="action" value="add_band_list_entry">
	Band Name:
	<input type="text" class="regular-text" id="band_name" name="<?php echo $this->plugin_name; ?>[band_name]"  value="" size="10" /><br>
	Videos:
	<br>
    <button id="band_add_video_line_button">Neuen Video hinzufügen</button>
    <table class="form-table" id="video_list">
    </table>
	<?php
		$settings = array( 'textarea_name' => 'editor_text');
		$editor_id = 'band_editor';
		wp_editor( '', $editor_id , $settings );
	?>
	 <input type="submit" value="Add Band">


</form>


