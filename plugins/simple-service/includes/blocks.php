<?php
/**
 * Block registration.
 *
 * @package SimpleService
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register plugin blocks.
 *
 * @return void
 */
function simple_service_register_blocks() {
	register_block_type( SIMPLE_SERVICE_PATH . 'blocks/services-grid' );
}
add_action( 'init', 'simple_service_register_blocks' );
