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
			'settingsPlugin_group',
			'duplicated-configuration');
		
		  	add_settings_section(
		  		'consider',
		  		'Check for duplicates in tags, categories or both',
		  		false, 'duplicated-configuration'
		  	
		  	);
		 					
		 				
		 			add_settings_field(
		 				'tags',
		 				'Tags', 
		 				array($this,'render_tags_field'),
		 				'duplicated-configuration',
		 				'consider'
		 			);
		 					
		 				
		 			add_settings_field(
		 				'categories',
		 				'Categories', 
		 				array($this,'render_categories_field'),
		 				'duplicated-configuration',
		 				'consider'
		 			);
		 					
		 			
		
		  	add_settings_section(
		  		'distance',
		  		'Comparison configuration',
		  		false, 'duplicated-configuration'
		  	
		  	);
		 					
		 				
		 			add_settings_field(
		 				'strict',
		 				'Equal names only', 
		 				array($this,'render_strict_field'),
		 				'duplicated-configuration',
		 				'distance'
		 			);
		 					
		 				
		 			add_settings_field(
		 				'levenshtein',
		 				'Use Levenshtein distance', 
		 				array($this,'render_levenshtein_field'),
		 				'duplicated-configuration',
		 				'distance'
		 			);
		 					
		 				
		 			add_settings_field(
		 				'maxDistance',
		 				'Max Distance', 
		 				array($this,'render_maxDistance_field'),
		 				'duplicated-configuration',
		 				'distance'
		 			);
		 					
		 			
	}
		
	/** 
	*  Rendering the settings page
	*/
	public function configuration_duplicated_terms() {
		// Check required user capability
		if ( !current_user_can( 'manage_options' ) )  {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.' ) );
		}		 				

		// Admin Page Layout
		echo '<div class="wrap">' . "\n";
		echo '	<h1>' . get_admin_page_title() . '</h1>' . "\n";
		echo '	<form action="options.php" method="post">' . "\n";
		settings_fields( 'settingsPlugin_group' );
		do_settings_sections( 'duplicated-configuration' );
		submit_button();
		echo '</form>' . "\n";
		echo '</div>' . "\n";
	}
		 				 				
	/** 
	*  Rendering the options fields
	*/
	public function render_tags_field() {
		// Retrieve the full set of options
		$options = get_option( 'duplicated-configuration' );
		// Field output.
		$checked = isset( $options['tags'] ) ? $options['tags'] : '0';
		echo '<input type="checkbox" name="duplicated-configuration[tags]" value="1"'  . checked(1, $checked, false) .'/>';
	}
	public function render_categories_field() {
		// Retrieve the full set of options
		$options = get_option( 'duplicated-configuration' );
		// Field output.
		$checked = isset( $options['categories'] ) ? $options['categories'] : '0';
		echo '<input type="checkbox" name="duplicated-configuration[categories]" value="1"'  . checked(1, $checked, false) .'/>';
	}
	public function render_strict_field() {
		// Retrieve the full set of options
		$options = get_option( 'duplicated-configuration' );
		// Field output.
		$checked = isset( $options['strict'] ) ? $options['strict'] : '0';
		echo '<input type="checkbox" name="duplicated-configuration[strict]" value="1"'  . checked(1, $checked, false) .'/>';
	}
	public function render_levenshtein_field() {
		// Retrieve the full set of options
		$options = get_option( 'duplicated-configuration' );
		// Field output.
		$checked = isset( $options['levenshtein'] ) ? $options['levenshtein'] : '0';
		echo '<input type="checkbox" name="duplicated-configuration[levenshtein]" value="1"'  . checked(1, $checked, false) .'/>';
	}
	public function render_maxDistance_field() {
		// Retrieve the full set of options
		$options = get_option( 'duplicated-configuration' );
		// Field output.
		// Set default value for this particular option in the group
		$value = isset( $options['maxDistance'] ) ? $options['maxDistance'] : '3';
		echo '<input type="number" name="duplicated-configuration[maxDistance]" size="10" value="' . esc_attr( $value ).'" />';
	}
}
 		
