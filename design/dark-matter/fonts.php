<?php
/**
 * Enqueue Google Fonts for Dark Matter theme.
 *
 * @package dark-matter
 */

if ( ! function_exists( 'telex_theme_fonts' ) ) {
	function telex_theme_fonts() {
		wp_enqueue_style(
			'dark-matter-google-fonts',
			'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap',
			array(),
			null
		);
	}
}
add_action( 'enqueue_block_assets', 'telex_theme_fonts' );