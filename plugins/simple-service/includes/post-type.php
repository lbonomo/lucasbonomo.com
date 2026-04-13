<?php
/**
 * Service post type registration.
 *
 * @package SimpleService
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the service post type.
 *
 * Name maps to title, short description to excerpt,
 * long description to content, and image to featured image.
 *
 * @return void
 */
function simple_service_register_post_type() {
	$labels = array(
		'name'                  => __( 'Services', 'simple-service' ),
		'singular_name'         => __( 'Service', 'simple-service' ),
		'menu_name'             => __( 'Services', 'simple-service' ),
		'name_admin_bar'        => __( 'Service', 'simple-service' ),
		'add_new'               => __( 'Add New', 'simple-service' ),
		'add_new_item'          => __( 'Add New Service', 'simple-service' ),
		'new_item'              => __( 'New Service', 'simple-service' ),
		'edit_item'             => __( 'Edit Service', 'simple-service' ),
		'view_item'             => __( 'View Service', 'simple-service' ),
		'all_items'             => __( 'All Services', 'simple-service' ),
		'search_items'          => __( 'Search Services', 'simple-service' ),
		'parent_item_colon'     => __( 'Parent Services:', 'simple-service' ),
		'not_found'             => __( 'No services found.', 'simple-service' ),
		'not_found_in_trash'    => __( 'No services found in Trash.', 'simple-service' ),
		'featured_image'        => __( 'Service Image', 'simple-service' ),
		'set_featured_image'    => __( 'Set service image', 'simple-service' ),
		'remove_featured_image' => __( 'Remove service image', 'simple-service' ),
		'use_featured_image'    => __( 'Use as service image', 'simple-service' ),
		'archives'              => __( 'Service Archives', 'simple-service' ),
		'insert_into_item'      => __( 'Insert into service', 'simple-service' ),
		'uploaded_to_this_item' => __( 'Uploaded to this service', 'simple-service' ),
		'filter_items_list'     => __( 'Filter services list', 'simple-service' ),
		'items_list_navigation' => __( 'Services list navigation', 'simple-service' ),
		'items_list'            => __( 'Services list', 'simple-service' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-grid-view',
		'has_archive'        => false,
		'rewrite'            => false,
		'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		'menu_position'      => 20,
		'publicly_queryable' => false,
		'query_var'          => false,
		'show_in_nav_menus'  => true,
		'show_in_admin_bar'  => true,
	);

	register_post_type( 'service', $args );
}
add_action( 'init', 'simple_service_register_post_type' );

/**
 * Ensure featured images are enabled for services.
 *
 * @return void
 */
function simple_service_add_thumbnail_support() {
	add_theme_support( 'post-thumbnails', array( 'service' ) );
}
add_action( 'after_setup_theme', 'simple_service_add_thumbnail_support' );
