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
		'main-menu'   => __('Menu principal', 'lb25'),
		'header-menu' => __('Header Menu (legacy)', 'lb25'),
	));
}
add_action('init', 'lb25_register_menus');

/**
 * Resolve the primary menu location to keep backward compatibility.
 *
 * @return string
 */
function lb25_get_primary_menu_location()
{
	if (has_nav_menu('main-menu')) {
		return 'main-menu';
	}

	return 'header-menu';
}

/**
 * Fallback markup when no menu is assigned.
 *
 * @param array $args Menu arguments.
 * @return void
 */
function lb25_primary_menu_fallback($args)
{
	$items = array(
		array(
			'label' => __('Inicio', 'lb25'),
			'url'   => home_url('/'),
		),
		array(
			'label' => __('Blog', 'lb25'),
			'url'   => home_url('/blog/'),
		),
		array(
			'label' => __('Contacto', 'lb25'),
			'url'   => home_url('/#contacto'),
		),
	);

	$menu_class = 'header-nav';

	if (!empty($args['menu_class'])) {
		$menu_class = $args['menu_class'];
	}

	echo '<ul class="' . esc_attr($menu_class) . '">';

	foreach ($items as $item) {
		echo '<li class="menu-item">';
		echo '<a href="' . esc_url($item['url']) . '">';
		echo esc_html($item['label']);
		echo '</a>';
		echo '</li>';
	}

	echo '</ul>';
}

// Include theme classes
// Block styles are registered in class-block-styles.php
require_once get_template_directory() . '/inc/class-block-styles.php';

// Include block styles
require get_template_directory() . '/inc/block-styles.php';


