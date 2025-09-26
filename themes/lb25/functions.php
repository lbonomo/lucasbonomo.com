<?php

/**
 * Functions file for the theme
 * @package LB25
 * @author Lucas Bonomo <bonomo.lucas@gmail.com>
 */

// Support theme features
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support('custom-logo', array(
    'height'      => 60,
    'width'       => 260,
    'flex-height' => true,
    'flex-width'  => true,
));


// Enqueue styles and scripts
function lb25_enqueue_scripts() {
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), null);
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'lb25_enqueue_scripts');


// Register main menu
function lb25_register_menus() {
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'lb25'),
    ));
}
add_action('init', 'lb25_register_menus');