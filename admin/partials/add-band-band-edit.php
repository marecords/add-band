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
        
        $band_list_entry=$band_list[$id];
var_dump($band_list_entry);
    
	?>

<form action="admin-post.php" method="post">
    	<input type="hidden" name="action" value="edit_band_list_entry">
        <input type="hidden"id="id" name="<?php echo $this->plugin_name; ?>[id]"  value="<?php echo $band_list_entry['id']  ?>"  /><br>
	
	Band Name:
	<input type="text" class="regular-text" id="band_name" name="<?php echo $this->plugin_name; ?>[band_name]"  value="<?php echo $band_list_entry['Band_Name']  ?>" size="10" /><br>
	Videos:
	<br>
	Videos:
	<br>
    <button id="band_edit_video_line_button" value="<?php echo count($band_list_entry['videolist'])?>" >Neuen Video hinzufügen</button>
    <table class="form-table" id="video_list">
        <?php
            if(array_key_exists('videolist',$band_list_entry)){
                for($i=1;$i<=count($band_list_entry['videolist']);$i++){    
        ?>
                <tr>
            <td>

                <?php esc_attr_e($i. '.Video' , 'WpAdminStyle' ); ?>
            </td>
            <td>
                <input type="text" class="regular-text" id="track <?php echo $i; ?>"  name="add-band[video][<?php    echo $i; ?>]" value="<?php echo $band_list_entry['videolist'][$i]; ?>" >
            </td>
        </tr>
             
        <?php 
                }
            } 
        ?>
    </table>
	<?php
		$settings = array( 'textarea_name' => 'editor_text');
		$editor_id = 'band_editor';
		wp_editor( $band_list_entry['Text'], $editor_id , $settings );
	?>
	 <input type="submit" value="Edit Band">


</form>


