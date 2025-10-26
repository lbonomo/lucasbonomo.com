<?php

/**
 * Functions file for the theme
 * @package LB25
 * @author Lucas Bonomo <bonomo.lucas@gmail.com>
 */

if (! defined('THEME_VERSION')) {
	// Replace the version number of the theme on each release.
	define('THEME_VERSION', '1.0.0');
}

// Support theme features
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support('custom-logo', array(
	'height'      => 50,
	'width'       => 200,
	'flex-height' => true,
	'flex-width'  => true,
));


// Enqueue styles and scripts
function lb25_enqueue_scripts()
{
	wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), null);
	wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'lb25_enqueue_scripts');


function lb25_enqueue_block_scripts()
{
	wp_enqueue_script(
		'lb25-blocks-editor-script',
		get_template_directory_uri() . '/assets/js/blocks.min.js',
		array(),
		THEME_VERSION,
		true
	);
}
add_action('enqueue_block_editor_assets', 'lb25_enqueue_block_scripts');

// Register main menu
function lb25_register_menus()
{
	register_nav_menus(array(
		'header-menu' => __('Header Menu', 'lb25'),
	));
}
add_action('init', 'lb25_register_menus');

// Include theme classes
// Block styles are registered in class-block-styles.php
require_once get_template_directory() . '/inc/class-block-styles.php';

// Include block styles
require get_template_directory() . '/inc/block-styles.php';


