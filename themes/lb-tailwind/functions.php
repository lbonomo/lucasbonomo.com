<?php

/**
 * Load assets.
 */
function boilerplate_load_assets() {
	wp_enqueue_script( 'ourmainjs', get_theme_file_uri('/build/index.js'), array('wp-element'), '1.0', true);
	wp_enqueue_style( 'ourmaincss', get_theme_file_uri('/build/index.css'));
}

add_action( 'wp_enqueue_scripts', 'boilerplate_load_assets' );

/**
 * Add support.
 */
function boilerplate_add_support() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
	add_theme_support( 'customize-selective-refresh-widgets' );
	register_nav_menus(
		array(
			'header' => 'Header',
		)
	);
}

add_action( 'after_setup_theme', 'boilerplate_add_support' );

