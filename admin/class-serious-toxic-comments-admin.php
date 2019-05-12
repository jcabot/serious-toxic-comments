<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wordpress.org/plugins/serious-toxic-comments/
 * @since      1.0.0
 * @package    Serious_Toxic_Comments
 * @subpackage Serious_Toxic_Comments\admin
 */

class Serious_Toxic_Comments_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @access   protected
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @access   protected
	 * @var      string    $version    The current version of this plugin.
	 */
	protected $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();

	}
	
	protected function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin/partials/class-serious-toxic-comments-admin-display.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin/partials/class-serious-toxic-comments-admin-settings.php';
	}
	

	/**
	 * Register the stylesheets for the admin area.
	 *
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/serious-toxic-comments-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/serious-toxic-comments-admin.js', array( 'jquery' ), $this->version, false );

	}
}
	
