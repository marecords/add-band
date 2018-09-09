<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com/
 * @since      1.0.0
 *
 * @package    Add_Band
 * @subpackage Add_Band/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Add_Band
 * @subpackage Add_Band/admin
 * @author     Jonas <mar@bxn.be>
 */
class Add_Band_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Add_Band_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Add_Band_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/add-band-admin.css', array(), $this->version, 'all' );

             // CSS stylesheet for Color Picker
             wp_enqueue_style( 'wp-color-picker' );            
             wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/add-band-admin.css', array( 'wp-color-picker' ), $this->version, 'all' );


	}
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/add-band-admin.js', array( 'jquery' ), $this->version, false );
            wp_enqueue_media();   
            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/add-band-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );         

	   wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/add-band-admin.js', array( 'jquery', 'wp-color-picker', 'media-upload' ), $this->version, false );


	}

	public function add_plugin_admin_menu() {
  		add_menu_page('Add Album or Band to Display in ShortCode', 'Add Band', 'manage_options','Add_BAND_Menu',  array($this, 'display_add_band_band_main') );
		add_submenu_page( 
          		null            // -> Set to null - will hide menu link
        		, 'Add Album'    // -> Page Title
        		, 'Add Ablum'    // -> Title that would otherwise appear in the menu
        		, 'manage_options' // -> Capability level
        		, 'addnewalbum'   // -> Still accessible via admin.php?page=menu_handle
        		,  array($this, 'display_add_band_album_add') // -> To render the page
    );
        add_submenu_page( 
          		null            // -> Set to null - will hide menu link
        		, 'Edit Album'    // -> Page Title
        		, 'Edit Album'    // -> Title that would otherwise appear in the menu
        		, 'manage_options' // -> Capability level
        		, 'editalbum'   // -> Still accessible via admin.php?page=menu_handle
        		,  array($this, 'display_add_band_album_edit') // -> To render the page
    );
		add_submenu_page('Add_BAND_Menu', 'Add Album to Display in ShortCode', 'Add Album', 'manage_options',  $this->plugin_name, array($this, 'display_add_band_album_main'));
		add_submenu_page( 
          		null            // -> Set to null - will hide menu link
        		, 'Add Band'    // -> Page Title
        		, 'Add Band'    // -> Title that would otherwise appear in the menu
        		, 'manage_options' // -> Capability level
        		, 'addnewband'   // -> Still accessible via admin.php?page=menu_handle
        		,  array($this, 'display_add_band_band_add') // -> To render the page
    );
		add_submenu_page( 
          		null            // -> Set to null - will hide menu link
        		, 'Edit Band'    // -> Page Title
        		, 'Edit Band'    // -> Title that would otherwise appear in the menu
        		, 'manage_options' // -> Capability level
        		, 'editband'   // -> Still accessible via admin.php?page=menu_handle
        		,  array($this, 'display_add_band_band_edit') // -> To render the page
    );
	}


public function add_action_links( $links ) {
   	$settings_link = array(
    	'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
   );
   return array_merge(  $settings_link, $links );
}
#ALBUM
public function display_add_band_album_main() {
    include_once( 'partials/add-band-album-main.php' );
}

public function display_add_band_album_add() {
    include_once( 'partials/add-band-album-add.php' );
}
public function display_add_band_album_edit() {
	 include_once( 'partials/add-band-album-edit.php' );
}   
#BAND    
public function display_add_band_band_main() {
    include_once( 'partials/add-band-band-main.php' );
}

public function display_add_band_band_add() {
	 include_once( 'partials/add-band-band-add.php' );
}

public function display_add_band_band_edit() {
	 include_once( 'partials/add-band-band-edit.php' );
}

 public function options_update() {
    #register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    register_setting($this->plugin_name, 'add-band-album-list', array($this, 'validate_album'));
    register_setting($this->plugin_name, 'add-band-band-list', array($this, 'validate_band'));
 }
public function validate_album($input) {

    $album_id=array();
    foreach ($input as $key => $row)
     {
         $album_id[$key] = $row['Id'];
     }
     array_multisort($album_id, SORT_DESC,SORT_STRING, $input);
    return $input;
}
 public function validate_band($input) {
     $band_name=array();
     foreach ($input as $key => $row)
     {
         $band_name[$key] = $row['Band_Name'];
     }
     array_multisort($band_name, SORT_ASC,SORT_STRING, $input);
    return $input;
}   

#######
#ALBUM#
#######
public function delete_album_list_entry() {
    $options = get_option('add-band-album-list');
    unset($options[$_REQUEST['data']]);
    update_option('add-band-album-list',$options);
    status_header(200);
    die("Server received '{$_REQUEST['data']}' from your browser.");

}
     
public function add_album_list_entry(){

        $album_list_old= get_option('add-band-album-list');
        $band_list= get_option('add-band-band-list');
        $input=$_REQUEST['add-band'];
        var_dump($_REQUEST);
 if(empty(sanitize_text_field($input['current_id']))||empty(sanitize_text_field($input['current_album_name']))){
                die("Mar Nummer oder Album Name fehlen");
        }
        $id=sanitize_text_field($input['current_id']);
        $band_id=sanitize_text_field($input['current_band_id']);
        $album_list_new=[
            "Id" => $id,
            "Album_Name" => sanitize_text_field($input['current_album_name']),
            "Band_Id" => sanitize_text_field($input['current_band_id']),
            "Band_Name" => $band_list[$band_id]["Band_Name"],
            "soldout_state" => $input['current_soldout_state'],
            "Datum" => sanitize_text_field($input['current_date']),
            "Format" => sanitize_text_field($input['current_format']),
            "Img_URL" => $input['login_logo_id'],
            "Shop_Link" => esc_url($input['current_shop_link']),
            "track_list" => $input['track'],
            "description" => $_REQUEST['album_description']
        ];
        
        $album_list_old[$id]= $album_list_new;
        update_option('add-band-album-list',$album_list_old);
        
    }
public function edit_album_list_entry() {
    $album_list_old= get_option('add-band-album-list');
    $input=$_REQUEST['add-band'];
    var_dump($_REQUEST);
    if(empty(sanitize_text_field($input['current_id']))||empty(sanitize_text_field($input['current_album_name']))){
                die("Mar Nummer oder Album Name fehlen");
        }
    $id=sanitize_text_field($input['current_id']);
    $band_id=sanitize_text_field($input['current_band_id']);
    $album_list_new=[
        "Id" => $id,
        "Album_Name" => sanitize_text_field($input['current_album_name']),
        "Band_Id" => sanitize_text_field($input['current_band_id']),
        "Band_Name" => $band_list[$band_id]["Band_Name"],
        "soldout_state" => $input['current_soldout_state'],
        "Datum" => sanitize_text_field($input['current_date']),
        "Format" => sanitize_text_field($input['current_format']),
        "Img_URL" => $input['login_logo_id'],
        "Shop_Link" => esc_url($input['current_shop_link']),
        "track_list" => $input['track'],
        "description" => $_REQUEST['editor_text']
    ];
        
    $album_list_old[$id][0]= $album_list_new;
        
    update_option('add-band-band-list',$album_list_old);
    
    status_header(200);
}
    
######
#BAND#
######
public function delete_band_list_entry() {
    $options = get_option('add-band-band-list');
    unset($options[$_REQUEST['data']]);
    update_option('add-band-band-list',$options);
    status_header(200);
    die("Server received '{$_REQUEST['data']}' from your browser.");
}
public function add_band_list_entry() {
	$uid=uniqid();
    $add_band_add_entry = new Add_band_add_entry();
    $add_band_add_entry-> add_entry_to_band_list($_REQUEST['add-band'],$uid);
    $add_band_add_entry-> add_entry_create_post();
    status_header(200);
}
public function edit_band_list_entry() {
	$add_band_add_entry = new Add_band_add_entry();
    $add_band_add_entry-> add_entry_to_band_list($_REQUEST['add-band'],$_REQUEST['add-band']['id']);
    $add_band_add_entry-> add_entry_create_post();
    status_header(200);
}



}
