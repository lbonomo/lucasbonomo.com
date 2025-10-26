<?php
/**
 * Block Styles
 *
 * @package LB25
 */

// Prevent direct access.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register custom block styles.
 */
function lb25_register_block_styles() {
    // Register 'historial' style for core/list block
    register_block_style(
        'core/list',
        array(
            'name'  => 'historial',
            'label' => __('Historial', 'lb25'),
        )
    );
}
add_action('init', 'lb25_register_block_styles');

/**
 * Enqueue block styles.
 */
function lb25_enqueue_block_styles() {
    wp_enqueue_block_style(
        'core/list',
        array(
            'handle' => 'lb25-list-historial-style',
            'src'    => get_theme_file_uri('assets/css/blocks/list-historial.css'),
            'path'   => get_theme_file_path('assets/css/blocks/list-historial.css'),
        )
    );
}
add_action('init', 'lb25_enqueue_block_styles');
