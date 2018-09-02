<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com/
 * @since      1.0.0
 *
 * @package    Add_Band
 * @subpackage Add_Band/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Add_Band
 * @subpackage Add_Band/public
 * @author     Jonas <mar@bxn.be>
 */
class Add_Band_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/add-band-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/add-band-public.js', array( 'jquery' ), $this->version, false );

	}
        function shortcode_display_bands_function( $atts ){
                $band_list = get_option($this->plugin_name);
                $return = "";
                foreach ($band_list as ["id" => $id, "Album_Name" => $Album_Name, "Band_Name" => $Band_Name, "Datum" => $Datum, "Format" => $Format, "Img_URL" => $Img_URL, "Shop_Link" => $Shop_Link, "soldout_state" => $soldout_state ]) {
                        $login_logo = wp_get_attachment_image_src( $Img_URL, 'full' );
                        if(empty($login_logo)){
                                continue;
                        }
                        $login_logo_url = $login_logo[0];
                        $return .= "    <div style=\"float: left;width: 20%;\">  
						<a href=\"$Album_Link\">
						<div>
                                                <img src= $login_logo_url \" style=\"height: 225px;\" >  
                                                <section style=\"color: white !important;\">
                                                        <h4 style=\"text-transform: uppercase;\">
                                                                <span style=\"color: #ffffff;\">
                                                                        $Band_Name      
                                                        </h4>
                                                                        $Album_Name
                                                                        <br />
                                                                        $Format, $Datum
                                                                        <br />
                                                                        $id
                                                                        <br/>
                                                                </span>
						</div>
						</a>
                                                </section>";
                        if(empty($soldout_state)){
                                $return .=      "<form action=\"$Shop_Link\" >
                                                        <input type=\"submit\" value=\"ORDER NOW\" id=\"shortcodeButton\"  />
                                                </form>
                                        </div>";
                        }else {
				$return .=	"<input type=\"submit\" onclick=\"return false;\" value=\"SOLDOUT\" id=\"shortcodeButton\"  style=\"background-color: #444;\" />
                                                </section>
                                        </div>";
                        }
                }
                return $return;
        }

}
