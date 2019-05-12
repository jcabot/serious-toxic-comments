<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to manage the admin-facing aspects of the plugin.
 *
 *
 * @link       https://wordpress.org/plugins/serious-toxic-comments/
 * @since      1.0.0
 * @package    Serious_Toxic_Comments
 * @subpackage Serious_Toxic_Comments\admin
 */
 		
class Serious_Toxic_Comments_Admin_Display{
	protected $plugin_name;
 		
 	protected $version;
 	
 	protected $admin;
 	
 	protected $settings;
 		
 	/**
 	 * Initialize the class and set its properties.
 	 *
 	 * @param      string    $plugin_name       The name of this plugin.
 	 * @param      string    $version    The version of this plugin.
 	 * @param      Serious_Toxic_Comments_Admin    $admin    Link with the main admin object.
 	 */
 	public function __construct( $plugin_name, $version, $admin, $settings ) {
 		$this->plugin_name = $plugin_name;
 		$this->version = $version;
 		$this->admin = $admin;
 		$this->settings = $settings;
 	}
 			
		
}
