<?php
/**
 * PHPUnit bootstrap for simple-service integration tests.
 */

$wp_load_path = getenv( 'WP_TESTS_WP_LOAD_PATH' );

if ( ! $wp_load_path ) {
	$candidates = array(
		'/app/wordpress/wp-load.php',
		dirname( __DIR__, 4 ) . '/wp-load.php',
		dirname( __DIR__, 3 ) . '/wordpress/wp-load.php',
	);

	foreach ( $candidates as $candidate ) {
		if ( file_exists( $candidate ) ) {
			$wp_load_path = $candidate;
			break;
		}
	}
}

if ( ! $wp_load_path || ! file_exists( $wp_load_path ) ) {
	fwrite( STDERR, "Unable to locate wp-load.php for integration tests.\n" );
	exit( 1 );
}

require_once $wp_load_path;

$plugin_main_file = WP_PLUGIN_DIR . '/simple-service/simple-service.php';

if ( file_exists( $plugin_main_file ) ) {
	require_once $plugin_main_file;
}

do_action( 'init' );
