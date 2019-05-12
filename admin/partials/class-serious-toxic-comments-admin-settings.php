<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to manage the settings  of the plugin.
 *
 *
 * @link       https://wordpress.org/plugins/serious-toxic-comments/
 * @since      1.0.0
 * @package    Serious_Toxic_Comments
 * @subpackage Serious_Toxic_Comments\admin
 */
		 		
class Serious_Toxic_Comments_Admin_Settings{
	protected $plugin_name;
		 		
	protected $version;
	
	protected $admin;
		 		
	/**
	 * Initialize the class and set its properties.
	 *
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 * @param      Serious_Toxic_Comments_Admin    $admin    Link with the main admin object.
	 */
	public function __construct( $plugin_name, $version, $admin) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->admin = $admin;
	}
	 			

	/** 
	*  Creation of the plugin settings
	 */
	public function init_settings() {
		register_setting(
			'discussion',
			'settingsToxic');	
		
		add_settings_section(
			'toxicconfig',
			'Enable the detection and blocking of toxic comments',
			false, 'discussion'
		);
		
		add_settings_field(
			'toxicdetection',
			'Start checking comments', 
			array($this,'render_toxicdetection_field'),
			'discussion',
			'toxicconfig'
		);
			 						
		add_settings_field(
			'threshold',
			'Minimum confidence level to classify the comment as toxic', 
			array($this,'render_threshold_field'),
			'discussion',
			'toxicconfig'
		);
			 						
	}
		
	
	/** 
	*  Rendering the options fields
	*/
	public function render_toxicdetection_field() {
		// Retrieve the full set of options
		$options = get_option( 'settingsToxic' );
		// Field output.
		$checked = isset( $options['toxicdetection'] ) ? $options['toxicdetection'] : '0';
		echo '<input type="checkbox" name="settingsToxic[toxicdetection]" value="1"'  . checked(1, $checked, false) .'/>';
	}
	public function render_threshold_field() {
		// Retrieve the full set of options
		$options = get_option( 'settingsToxic' );
		// Field output.
		$value = $value = isset( $options['threshold'] ) ? $options['threshold'] : '1';
		echo '<input type="range" name="settingsToxic[threshold]" size="10" value="' . esc_attr( $value ).'" min="1" max="100" />';
	}
}
 		
