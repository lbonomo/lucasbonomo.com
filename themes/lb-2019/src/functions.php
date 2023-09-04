<?php
/**
 * Functions and definitions
 *
 * @package lb19
 */

if ( ! function_exists( 'lb19_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function lb19_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on lb19, use a find and replace
		 * to change 'lb19' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'lb19', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// This theme uses wp_nav_menu() in one location (ver header.php).
		register_nav_menus(
			array(
				'primary'   => esc_html__( 'Primary', 'lb19' ),
				'secondary' => esc_html__( 'Secondary', 'lb19' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'lb19_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lb19_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound.
	$GLOBALS['content_width'] = apply_filters( 'lb19_content_width', 640 );
}
add_action( 'after_setup_theme', 'lb19_content_width', 0 );

/**
 * Register widget area.
 */
require get_template_directory() . '/inc/widgets-areas.php';

/**
 * Enqueue scripts and styles.
 */
function lb19_scripts() {

	// MDL.
	wp_enqueue_style( 'google_fonts', 'https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en', false, 'all' );
	wp_enqueue_style( 'mdl_fonts', 'https://fonts.googleapis.com/icon?family=Material+Icons', false, 'all' );

	// echo get_stylesheet_uri(); https://lucasbonomo.lndo.site/wp-content/themes/lb19/style.css
	// wp_enqueue_style( 'lb19-style', get_stylesheet_uri(), false, 'all' );
	wp_enqueue_style( 'lb19-style', get_template_directory_uri(). '/assets/css/style.css', false, 'all' );

	wp_enqueue_script( 'lb16_js', get_template_directory_uri() . '/assets/js/lb19.js', array(), '20191229', true );
	wp_enqueue_script( 'mdl_js', get_template_directory_uri() . '/vendor/js/material.min.js', array(), '20190601', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lb19_scripts', 99 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Display custom color CSS.
 */
function lb19_custom_style() {
	require_once get_theme_file_path( '/inc/style-custom.php' );
	custom_style();
}
add_action( 'wp_head', 'lb19_custom_style' );


/**
 * Add support to WebP.
 *
 * @param array $mime_types Default mime tipes.
 */
function mime_webp( $mime_types ) {
	$mime_types['webp'] = 'image/webp'; // Adding .webp extension.
	return $mime_types;
}
add_filter( 'upload_mimes', 'mime_webp', 1, 1 );

/**
 * Si esta presente el plugin de WooCommerce.
 */
if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/**
 * Enabled ACF 5 early access
 * Requires at last version ACF 4.4.12 to work
 */
// define('ACF_EARLY_ACCESS', '5');
