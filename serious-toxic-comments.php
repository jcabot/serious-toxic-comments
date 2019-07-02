<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/serious-toxic-comments/
 * @since             1.0.0
 * @package           Serious_Toxic_Comments
 *
 * @wordpress-plugin
 * Plugin Name:       Serious Toxic Comments
 * Plugin URI:        https://wordpress.org/plugins/serious-toxic-comments
 * Description:       Flag and block toxic comments on your site
 * Version:           1.1
 * Author:            Jordi Cabot
 * Author URI:        https://seriouswp.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       serious-toxic-comments
 * Domain Path:       /languages
 *
 * This plugin is distributed under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or  any later version.
 *
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SERIOUS_TOXIC_COMMENTS', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-serious-toxic-comments.php
 */
function activate_serious_toxic_comments() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-serious-toxic-comments-activator.php';
	Serious_Toxic_Comments_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-serious-toxic-comments-deactivator.php
 */
function deactivate_serious_toxic_comments() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-serious-toxic-comments-deactivator.php';
	Serious_Toxic_Comments_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_serious_toxic_comments' );
register_deactivation_hook( __FILE__, 'deactivate_serious_toxic_comments' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-serious-toxic-comments.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-serious-toxic-comments-ext.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_serious_toxic_comments() {

	$plugin = new Serious_Toxic_Comments_Ext();
	$plugin->run();

}
run_serious_toxic_comments();



