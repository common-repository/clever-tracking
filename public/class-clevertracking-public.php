<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://cleverconnected.nl
 * @since      0.0.1
 *
 * @package    CleverTracking
 * @subpackage CleverTracking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    CleverTracking
 * @subpackage CleverTracking/public
 * @author     Rrobin Dommisse <robin.dommisse@ambition4clients.nl>
 */
class CleverTracking_Public
{
   /**
	 * The options name to be used in this plugin
	 *
	 * @since  	0.0.1
	 * @access 	private
	 * @var   	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'clevertracking';

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $clevertracking    The ID of this plugin.
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
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param    string    $plugin_name    The name of the plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Get the client ip address
	 */
	public function get_the_user_ip() {
		$ip ="";
		$header ="";
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		//check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
		$header ="HTTP_CLIENT_IP";
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		//to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			$header ="HTTP_X_FORWARDED_FOR";
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
			$header ="REMOTE_ADDR";
		}
		return $ip ;
	}
	
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts()
	{

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/clevertracking-public.js', array(), $this->version, false);
		$user_id = get_current_user_id();
		$cc_options = get_option( $this->option_name . '_cc_options',false );
		$api_url = $cc_options !== false ? $cc_options['api_url'] : '';
		
		if (!isset($api_url)|| strlen($api_url)<=0 ) return;


		
		$api_key = $cc_options !== false  && isset($cc_options['api_key']) ? $cc_options['api_key'] : '';
		$useremail =  $user_id !== false ? get_user_meta($user_id, 'billing_email', true) : '';
		$IDFORCHECK =$cc_options !== false && isset($cc_options['IDFORCHECK']) ? $cc_options['IDFORCHECK'] : '';
		wp_localize_script(
			$this->plugin_name,
			'clevertrackingObject',
			array(
				'custid' =>$user_id ,
				'email' =>$useremail,
				'CONNECTION_STRING_NAME'=>'CONNECT_CC_CDP',
				'homeurl'=>get_home_url(),
				'clickurl'=>get_home_url(),
				'postid'=>(is_singular() ? get_the_ID() : 0),
				'apiurl' =>$api_url ,
				'apikey'=>$api_key ,
				'userip'=>$this->get_the_user_ip(),
				'idforcheck'=>$IDFORCHECK ,
				'ct_version'=>$this->version ,
				'nonce' => wp_create_nonce('wp_rest')

			)
		);
		//wp_enqueue_script($this->plugin_name . '_localobject');

		
	}

	
	
	

	

	
}
