<?php
/**
 * WPAI Default Featured Image
 *
 * @package   WPAI_DFI
 * @copyright Copyright(c) 2019, MediaRon LLC
 * @license http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 *
 * Plugin Name: WP All Import Default Featured Image
 * Plugin URI: https://mediaron.com
 * Description: Sets a default featured image for WP All Import if none exists. Uses WooCommerce for the default image.
 * Version: 1.0.0
 * Author: MediaRon LLC
 * Author URI: https://mediaron.com
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wpai-default-featured-image
 * Domain Path: languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'WPAI_DFI_VERSION', '1.0.0' );
define( 'WPAI_DFI_PLUGIN_NAME', 'WP All Import Default Featured Image' );
define( 'WPAI_DFI_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPAI_DFI_URL', plugins_url( '/', __FILE__ ) );
define( 'WPAI_DFI_SLUG', plugin_basename( __FILE__ ) );
define( 'WPAI_DFI_FILE', __FILE__ );

// Setup the plugin auto loader.
require_once 'php/autoloader.php';

/**
 * Get the plugin object.
 *
 * @return \WPAI_DFI_\Plugin
 */
function wp_all_import_default_featured_image() {
	static $instance;

	if ( null === $instance ) {
		$instance = new \WPAI_DFI\Plugin();
	}

	return $instance;
}

/**
 * Setup the plugin instance.
 */
wp_all_import_default_featured_image();

/**
 * Sometimes we need to do some things after the plugin is loaded, so call the Plugin_Interface::plugin_loaded().
 */
add_action( 'plugins_loaded', array( wp_all_import_default_featured_image(), 'plugin_loaded' ), 20 );
add_action( 'init', 'wpai_dfi_add_i18n' );

/**
 * Add i18n to plugin.
 */
function wpai_dfi_add_i18n() {
	load_plugin_textdomain( 'wpai-default-featured-image', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
