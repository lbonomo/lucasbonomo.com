<?php
/**
 * Register widget area.
 *
 * @package lb19
 */

/**
 * Registra Widget Area.
 */
function lb19_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 1', 'lb19' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lb19' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title text-base font-semibold mb-3">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 2', 'lb19' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'lb19' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title text-base font-semibold mb-3">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 3', 'lb19' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets here.', 'lb19' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title text-base font-semibold mb-3">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 4', 'lb19' ),
			'id'            => 'sidebar-4',
			'description'   => esc_html__( 'Add widgets here.', 'lb19' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title text-base font-semibold mb-3">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'lb19_widgets_init' );
