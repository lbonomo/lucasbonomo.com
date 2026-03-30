<?php
/**
 * Theme Customizer
 *
 * @package lb19
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lb19_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'lb19_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'lb19_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_setting(
		'mdl-color-primary',
		array(
			'default'           => 'ffffff',
			'transport'         => 'postMessage',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'mdl-color-primary',
			array(
				'label'    => 'Color primario',
				'section'  => 'colors',
				'settings' => 'mdl-color-primary',
			)
		)
	);

	/**
	 * Secondary color.
	 */
	$wp_customize->add_setting(
		'mdl-color-secondary',
		array(
			'type'                 => 'theme_mod',
			'capability'           => 'edit_theme_options',
			'default'              => 'ffffff',
			'transport'            => 'postMessage',
			'theme_supports'       => '',
			'sanitize_callback'    => '',
			'sanitize_js_callback' => '',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'mdl-color-secondary',
			array(
				'label'    => 'Color secundario',
				'section'  => 'colors',
				'settings' => 'mdl-color-secondary',
			)
		)
	);

	/**
	 * Header_textcolor
	 */
	$wp_customize->add_setting(
		'header_textcolor',
		array(
			'default'           => 'ffffff',
			'transport'         => 'postMessage',
			'sanitize_callback' => '',
		)
	);

	/**
	 * Primary Dark color
	 */
	$wp_customize->add_setting(
		'mdl-color-primary-dark',
		array(
			'default'           => 'ffffff',
			'transport'         => 'postMessage',
			'sanitize_callback' => '',
		)
	);

	/**
	 * Primary light color
	 */
	$wp_customize->add_setting(
		'mdl-color-primary-light',
		array(
			'type'                 => 'theme_mod',
			'capability'           => 'edit_theme_options',
			'default'              => 'ffffff',
			'transport'            => 'postMessage',
			'theme_supports'       => '',
			'sanitize_callback'    => '',
			'sanitize_js_callback' => '',
		)
	);
}
add_action( 'customize_register', 'lb19_customize_register' );

/**
 * Sanitize color option
 *
 * @param string $choice - Color select.
 */
function mdl_sanitize_color_option( $choice ) {
	$valid = array(
		'default',
		'custom',
	);

	if ( in_array( $choice, $valid, true ) ) {
		return $choice;
	}

	return 'default';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function lb19_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function lb19_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lb19_customize_preview_js() {
	wp_enqueue_script( 'lb19-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
	wp_enqueue_script( 'lb19-palette', get_template_directory_uri() . '/assets/js/palette.js', null, '20200416', true );
}
add_action( 'customize_preview_init', 'lb19_customize_preview_js' );
