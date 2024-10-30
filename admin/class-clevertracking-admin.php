<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://cleverconnected.nl
 * @since      0.0.1
 *
 * @package    CleverTracking
 * @subpackage CleverTracking/admin
 * @author     Rrobin Dommisse <robin.dommisse@ambition4clients.nl>
 */


class CleverTracking_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	0.0.1
	 * @access 	private
	 * @var   	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'clevertracking';


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
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
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		 wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/clevertracking-admin.css', array(), $this->version, 'all' );
		

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/clevertracking-admin.js', array(), $this->version, false );
		wp_localize_script( $this->plugin_name, 'ajax_var', array(
			'url' => rest_url(),
			'nonce' => wp_create_nonce('wp_rest')
		));
		wp_enqueue_script( $this->plugin_name );

		
	}

	
	/**
	 * Register the menu page.
	 *
	 * @since 0.0.22
	 */
	function clevertracking_register_menu(){

		add_menu_page('Clever Tracking',
	        'Clever Tracking',
	        'manage_options',
	        'clevertracking',
	        array( $this, 'display_options_page' ),
	        plugin_dir_url( __FILE__ ) . 'img/clevertracking-menu-icon-20.png',
	        31
	    );

	    

	}

	
	
	/**
	 * Render the options page for plugin
	 *
	 * @since  0.0.1
	 */
	public function display_options_page() {

		include_once 'partials/clevertracking-settings-display.php';

	}

	

	

	/**
	 * Register the settings
	 *
	 * @since  0.0.1
	 */
	public function register_setting() {

		//add api url section 
		add_settings_section(
			$this->option_name . '_cc_api',
			__( 'API URL', 'clevertracking' ),
			array( $this, $this->option_name . '_cc_api_section_cb' ),
			$this->plugin_name
		);
		
		add_settings_field(
			$this->option_name . '_cc_api',
			__( 'API URL', 'clevertracking' ),
			array( $this, $this->option_name . '_cc_api_cb' ),
			$this->plugin_name,
			$this->option_name . '_cc_api',
			array( 'label_for' => $this->option_name . '_cc_api' )
		);

		add_settings_field(
			$this->option_name . '_cc_api_key',
			__( 'API KEY', 'clevertracking' ),
			array( $this, $this->option_name . '_cc_api_key_cb' ),
			$this->plugin_name,
			$this->option_name . '_cc_api',
			array( 'label_for' => $this->option_name . '_cc_api_key' )
		);
		add_settings_field(
			$this->option_name . '_cc_IDFORCHECk',
			__( 'ID(s)FOR CHECK', 'clevertracking' ),
			array( $this, $this->option_name . '_cc_IDFORCHECK_cb' ),
			$this->plugin_name,
			$this->option_name . '_cc_api',
			array( 'label_for' => $this->option_name . '_cc_IDFORCHECK' )
		);

		

		// register_setting( $this->plugin_name, $this->option_name . '_cc_api' );
		register_setting ( $this->plugin_name, $this->option_name . '_cc_options', array( $this, $this->option_name . '_sanitize_cc') );

		


	}

	/**
	 * Render the text for the Api url section
	 *
	 * @since  0.0.1
	 */
	public function clevertracking_cc_api_section_cb() {

		echo '<p>' . __( "This plugin requires these settings:", 'clevertracking' ) . '</p>';

	}

	/**
	 * Render the api url input field for local tracking option
	 *
	 * @since  0.0.1
	 */
	public function clevertracking_cc_api_cb() {

		 $cc_options = get_option( $this->option_name . '_cc_options',false );
		 $api_url = $cc_options !== false && isset($cc_options['api_url']) ? $cc_options['api_url'] : '';
		?>
			<label>
				<input type="hidden"  name="<?php echo esc_attr( $this->option_name . '_cc_options[api_url]' ) ?>" id="<?php echo esc_attr( $this->option_name . '_cc_options[api_url]' ) ?>" value="<?php echo esc_attr( $api_url) ?>">
				<input type="text" name="<?php echo esc_attr( $this->option_name . '_cc_options[api_url]' ) ?>" id="<?php echo esc_attr( $this->option_name . '_cc_options[api_url]' ) ?>" value="<?php echo esc_attr( $api_url) ?>">
				<?php _e( 'add full url of your api', 'clevertracking' ); ?>
			</label>
		<?php

	}

	/**
	 * Render the api key input field for local tracking option
	 *
	 * @since  0.0.1
	 */
	public function clevertracking_cc_api_key_cb() {

		$cc_options = get_option( $this->option_name . '_cc_options',false );
		$api_key = $cc_options !== false && isset($cc_options['api_key']) ? $cc_options['api_key'] : '';
	   ?>
		   <label>
			   <input type="hidden"  name="<?php echo esc_attr( $this->option_name . '_cc_options[api_key]' ) ?>" id="<?php echo esc_attr( $this->option_name . '_cc_options[api_key]' ) ?>" value="<?php echo esc_attr( $api_key) ?>">
			   <input type="text" name="<?php echo esc_attr( $this->option_name . '_cc_options[api_key]' ) ?>" id="<?php echo esc_attr( $this->option_name . '_cc_options[api_key]' ) ?>" value="<?php echo esc_attr( $api_key) ?>">
			   <?php _e( 'add authentication key', 'clevertracking' ); ?>
		   </label>
	   <?php

   }
   
/**
	 * Render the ids for check input field for local tracking option
	 *
	 * @since  0.0.1
	 */
	public function clevertracking_cc_IDFORCHECK_cb() {

		$cc_options = get_option( $this->option_name . '_cc_options',false );
		$IDFORCHECK = $cc_options !== false  && isset($cc_options['IDFORCHECK']) ? $cc_options['IDFORCHECK'] : '';
	   ?>
		   <label>
			   <input type="hidden"  name="<?php echo esc_attr( $this->option_name . '_cc_options[IDFORCHECK]' ) ?>" id="<?php echo esc_attr( $this->option_name . '_cc_options[IDFORCHECK]' ) ?>" value="<?php echo esc_attr( $IDFORCHECK) ?>">
			   <input type="text" name="<?php echo esc_attr( $this->option_name . '_cc_options[IDFORCHECK]' ) ?>" id="<?php echo esc_attr( $this->option_name . '_cc_options[IDFORCHECK]' ) ?>" value="<?php echo esc_attr( $IDFORCHECK) ?>">
			   <?php _e( 'add user id seperated by comma if more than one.', 'clevertracking' ); ?>
		   </label>
	   <?php

   }
   
	/**
	 * Sanitize the CleverTracking settings
	 *
	 * @since  0.0.2
	 */

	public function clevertracking_sanitize_cc( $input ) {

		$output = $input;

		if ( $output['api_url'] || $output['api_key']) {
			if ( strlen( $output['api_url'] ) == 0 )  {
				$output['api_key'] = '';
				
				add_settings_error(
					__( 'CleverTracking API integration', 'clevertracking' ),
					'empty-property',
					'You must fill in a API  property URL to integrate with you system',
					'error' );
			}
		}

		return $output;

	}


	

	


	

	

	


	

	

	

	

	


	

}