<?php
/**
 * Dark Matter Theme Functions
 *
 * @package dark-matter
 */

require_once get_template_directory() . '/inc/class-nav-walkers.php';
require_once get_template_directory() . '/inc/template-functions.php';

if ( ! function_exists( 'dark_matter_setup' ) ) {
	function dark_matter_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style.css' );
		add_theme_support( 'custom-logo', array(
			'height'      => 40,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		) );
		add_theme_support( 'automatic-feed-links' );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'dark-matter' ),
		) );
	}
}
add_action( 'after_setup_theme', 'dark_matter_setup' );

if ( ! function_exists( 'dark_matter_enqueue_assets' ) ) {
	function dark_matter_enqueue_assets() {
		wp_enqueue_style(
			'dark-matter-tailwind',
			'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css',
			array(),
			'2.2.19'
		);

		wp_enqueue_style(
			'dark-matter-style',
			get_stylesheet_uri(),
			array( 'dark-matter-tailwind' ),
			wp_get_theme()->get( 'Version' )
		);

		wp_enqueue_style(
			'dark-matter-fonts',
			'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap',
			array(),
			null
		);

		wp_enqueue_script(
			'dark-matter-scripts',
			get_template_directory_uri() . '/assets/js/dark-matter.js',
			array(),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'dark_matter_enqueue_assets' );

if ( ! function_exists( 'dark_matter_enqueue_block_assets' ) ) {
	function dark_matter_enqueue_block_assets() {
		wp_enqueue_style(
			'dark-matter-google-fonts',
			'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap',
			array(),
			null
		);
	}
}
add_action( 'enqueue_block_assets', 'dark_matter_enqueue_block_assets' );

if ( ! function_exists( 'dark_matter_body_classes' ) ) {
	function dark_matter_body_classes( $classes ) {
		$classes[] = 'bg-black text-gray-200 antialiased';
		return $classes;
	}
}
add_filter( 'body_class', 'dark_matter_body_classes' );

if ( ! function_exists( 'dark_matter_custom_excerpt_length' ) ) {
	function dark_matter_custom_excerpt_length( $length ) {
		return 18;
	}
}
add_filter( 'excerpt_length', 'dark_matter_custom_excerpt_length' );

if ( ! function_exists( 'dark_matter_excerpt_more' ) ) {
	function dark_matter_excerpt_more( $more ) {
		return '&hellip;';
	}
}
add_filter( 'excerpt_more', 'dark_matter_excerpt_more' );

/**
 * Rewrite theme:./ URLs in block content on the frontend.
 */
if ( ! function_exists( 'dark_matter_rewrite_theme_urls' ) ) {
	function dark_matter_rewrite_theme_urls( $content ) {
		if ( ! $content ) {
			return $content;
		}
		$base    = get_stylesheet_directory_uri();
		$content = preg_replace( '/(src|href)=(["\']?)theme:\.\//', '$1=$2' . $base . '/', $content );
		$content = preg_replace( '/url\((["\']?)theme:\.\//', 'url($1' . $base . '/', $content );
		return $content;
	}
}
add_filter( 'render_block', 'dark_matter_rewrite_theme_urls' );

/**
 * Enqueue editor script for theme:./ URL rewriting.
 */
if ( ! function_exists( 'dark_matter_editor_assets_rewrite' ) ) {
	function dark_matter_editor_assets_rewrite() {
		$script_path = get_stylesheet_directory() . '/theme-assets-editor-rewrite.js';
		if ( file_exists( $script_path ) ) {
			wp_enqueue_script(
				'theme-assets-editor-rewrite',
				get_stylesheet_directory_uri() . '/theme-assets-editor-rewrite.js',
				array( 'wp-hooks', 'wp-compose', 'wp-element' ),
				'1.0.0',
				true
			);
			wp_add_inline_script(
				'theme-assets-editor-rewrite',
				'window.THEME_ASSETS_BASE_URL=' . wp_json_encode( get_stylesheet_directory_uri() ) . ';',
				'before'
			);
		}
	}
}
add_action( 'enqueue_block_editor_assets', 'dark_matter_editor_assets_rewrite' );