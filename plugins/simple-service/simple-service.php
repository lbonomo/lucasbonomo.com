<?php
/**
 * Plugin Name:       Simple Service
 * Description:       Manage services and display selected items in a grid block.
 * Version:           0.1.0
 * Requires at least: 6.5
 * Requires PHP:      7.4
 * Author:            Lucas Bonomo
 * Text Domain:       simple-service
 *
 * @package SimpleService
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SIMPLE_SERVICE_VERSION', '0.1.0' );
define( 'SIMPLE_SERVICE_FILE', __FILE__ );
define( 'SIMPLE_SERVICE_PATH', plugin_dir_path( __FILE__ ) );
define( 'SIMPLE_SERVICE_URL', plugin_dir_url( __FILE__ ) );

require_once SIMPLE_SERVICE_PATH . 'includes/post-type.php';
require_once SIMPLE_SERVICE_PATH . 'includes/blocks.php';

/**
 * Register plugin content before rewrite rules are flushed.
 *
 * @return void
 */
function simple_service_activate() {
	simple_service_register_post_type();
	flush_rewrite_rules();
}
register_activation_hook( SIMPLE_SERVICE_FILE, 'simple_service_activate' );

/**
 * Flush rewrite rules on deactivation.
 *
 * @return void
 */
function simple_service_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( SIMPLE_SERVICE_FILE, 'simple_service_deactivate' );
