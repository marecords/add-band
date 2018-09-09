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
    $album_list = get_option('add-band-album-list');
    $id = $_REQUEST['id'];  
    $album_list_entry=$album_list[$id];
    var_dump($album_list_entry);
 

?>

<form action="admin-post.php" method="post" id="album-form">
    <input type="hidden" name="action" value="add_album_list_entry">
    <table class="form-table" id="track_list">
        <tr>
            <td>
                <?php esc_attr_e( 'MA-Nummer', 'WpAdminStyle' ); ?>
            </td>
            <td>
                <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-current_id" name="<?php echo $this->plugin_name; ?>[current_id]" value="<?php echo $album_list_entry['Id']  ?>" size="7" /><br>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_attr_e( 'Album-Name', 'WpAdminStyle' ); ?>
            </td>
            <td>
                <input type="text" class="regular-text" id="current_album_name" name="<?php echo $this->plugin_name; ?>[current_album_name]" value="<?php echo $album_list_entry['Album_Name']  ?>" size="10" /><br>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_attr_e( 'Band-Name', 'WpAdminStyle' ); ?>
            </td>
            <td>
                <select id="current_band_id" name="<?php echo $this->plugin_name; ?>[current_band_id]" value="Band_id" form="album-form">
                    <?php
                        foreach ($band_list as $bands => $band){
                    ?>
                    <option value="<?php echo $band['id'] ?>">
                        <?php echo $band['Band_Name'] ?>
                    </option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_attr_e( 'Datum', 'WpAdminStyle' ); ?>
            </td>
            <td>
                <input type="text" class="regular-text" id="current_date" name="<?php echo $this->plugin_name; ?>[current_date]" value="<?php echo $album_list_entry['Datum']  ?>" size="4" /><br>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_attr_e( 'Format', 'WpAdminStyle' ); ?>
            </td>
            <td>
                <input type="text" class="regular-text" id="current_format" name="<?php echo $this->plugin_name; ?>[current_format]" value="<?php echo $album_list_entry['Format']  ?>" size="4" /><br>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_attr_e( 'Cover-Link', 'WpAdminStyle' ); ?>
            </td>
            <td>
                <fieldset>
                    <legend class="screen-reader-text"><span>
                            <?php esc_attr_e('Login Logo', $this->plugin_name);?></span></legend>
                    <input type="hidden" id="login_logo_id" name="<?php echo $this->plugin_name;?>[login_logo_id]" value="<?php echo $album_list_entry['Img_URL']  ?>" />
                    <input id="upload_login_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', $this->plugin_name); ?>" />
                </fieldset>

            </td>
        </tr>
        <tr>
            <td>
                <?php esc_attr_e( 'Shop-Link', 'WpAdminStyle' ); ?>
            </td>
            <td>
                <input type="text" class="regular-text" id="current_shop_link" name="<?php echo $this->plugin_name; ?>[current_shop_link]" value="<?php echo $album_list_entry['Shop_Link']  ?>" /><br>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_attr_e( 'Soldout', 'WpAdminStyle' ); ?>
            </td>
            <td>
                <input type="checkbox" id="current_soldout_state" name="<?php echo $this->plugin_name;?>[current_soldout_state]" value="<?php echo $album_list_entry['soldout_state']  ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_attr_e( 'Add Track', 'WpAdminStyle' ); ?>
            </td>
            <td>
                <button id="album_edit_track_line_button" value="<?php echo count($album_list_entry['track_list']) ?>" />Neuen Song hinzufügen</button>
            </td>
        </tr>
        <tr>
            <td>

                <?php esc_attr_e( 'Aktion', 'WpAdminStyle' ); ?>
            </td>
            <td>
                <input type="submit" value="Add Entry">
            </td>
        </tr>
        <?php
            for($i=1;$i<=count($album_list_entry['track_list']);$i++){
        ?>
                <tr>
            <td>

                <?php esc_attr_e($i. '.Song' , 'WpAdminStyle' ); ?>
            </td>
            <td>
                <input type="text" class="regular-text id="track <?php echo $i; ?>"  name="add-band[track][<?php    echo $i; ?>]" value="<?php echo $album_list_entry['track_list'][$i]; ?>" >
            </td>
        </tr>
             
        <?php } ?>
    </table>
     <?php
		$settings = array( 'textarea_name' => 'album_description');
		$editor_id = 'album_editor';
		wp_editor( $album_list_entry['description'], $editor_id , $settings );
	?>

</form>
