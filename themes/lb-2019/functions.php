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
	// Load main stylesheet (compiled from Vite + Tailwind + SCSS)
	wp_enqueue_style( 'lb19-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), '1.0.0', 'all' );

	// Load main JavaScript bundle (compiled from Vite)
	wp_enqueue_script( 'lb19-main', get_template_directory_uri() . '/assets/js/main.min.js', array(), '1.0.0', true );
	wp_localize_script(
		'lb19-main',
		'lb19InfiniteScroll',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'lb19_infinite_scroll' ),
		)
	);

	// Load comment reply script if needed
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lb19_scripts', 99 );

/**
 * Render sentinel used by infinite scroll in archive-like templates.
 */
function lb19_infinite_scroll_sentinel() {
	global $wp_query;

	if ( empty( $wp_query ) || ! isset( $wp_query->max_num_pages ) || $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged      = max( 1, absint( get_query_var( 'paged' ) ) );
	$post_types = get_query_var( 'post_type' );
	if ( empty( $post_types ) ) {
		$post_types = 'post';
	}
	if ( is_array( $post_types ) ) {
		$post_types = implode( ',', array_map( 'sanitize_key', $post_types ) );
	} else {
		$post_types = sanitize_key( $post_types );
	}

	$taxonomy = '';
	$term_id  = 0;
	if ( is_category() || is_tag() || is_tax() ) {
		$term = get_queried_object();
		if ( isset( $term->taxonomy ) ) {
			$taxonomy = sanitize_key( $term->taxonomy );
		}
		if ( isset( $term->term_id ) ) {
			$term_id = absint( $term->term_id );
		}
	}

	$author = 0;
	if ( is_author() ) {
		$author = absint( get_query_var( 'author' ) );
	}

	$search = '';
	if ( is_search() ) {
		$search = get_search_query();
	}

	echo '<div class="lb-infinite-scroll" data-lb-infinite="1" data-post-type="' . esc_attr( $post_types ) . '" data-next-page="' . esc_attr( (string) ( $paged + 1 ) ) . '" data-max-pages="' . esc_attr( (string) absint( $wp_query->max_num_pages ) ) . '" data-taxonomy="' . esc_attr( $taxonomy ) . '" data-term-id="' . esc_attr( (string) $term_id ) . '" data-author="' . esc_attr( (string) $author ) . '" data-search="' . esc_attr( $search ) . '" data-year="' . esc_attr( (string) absint( get_query_var( 'year' ) ) ) . '" data-month="' . esc_attr( (string) absint( get_query_var( 'monthnum' ) ) ) . '" data-day="' . esc_attr( (string) absint( get_query_var( 'day' ) ) ) . '" aria-live="polite"><span class="lb-infinite-scroll__status">Cargando mas contenidos...</span></div>';
}

/**
 * AJAX handler to load archive items for infinite scroll.
 */
function lb19_ajax_load_more_posts() {
	check_ajax_referer( 'lb19_infinite_scroll', 'nonce' );

	$paged = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : 0;
	if ( $paged < 2 ) {
		wp_send_json_error( array( 'message' => 'Invalid page.' ), 400 );
	}

	$post_type_raw = isset( $_POST['postType'] ) ? sanitize_text_field( wp_unslash( $_POST['postType'] ) ) : 'post';
	$post_types    = array_filter( array_map( 'sanitize_key', explode( ',', $post_type_raw ) ) );
	if ( empty( $post_types ) ) {
		$post_types = array( 'post' );
	}

	$args = array(
		'post_type'           => 1 === count( $post_types ) ? $post_types[0] : $post_types,
		'post_status'         => 'publish',
		'paged'               => $paged,
		'ignore_sticky_posts' => true,
	);

	$taxonomy = isset( $_POST['taxonomy'] ) ? sanitize_key( wp_unslash( $_POST['taxonomy'] ) ) : '';
	$term_id  = isset( $_POST['termId'] ) ? absint( $_POST['termId'] ) : 0;
	if ( ! empty( $taxonomy ) && $term_id > 0 ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => array( $term_id ),
			),
		);
	}

	$search = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
	if ( ! empty( $search ) ) {
		$args['s'] = $search;
	}

	$author = isset( $_POST['author'] ) ? absint( $_POST['author'] ) : 0;
	if ( $author > 0 ) {
		$args['author'] = $author;
	}

	$year  = isset( $_POST['year'] ) ? absint( $_POST['year'] ) : 0;
	$month = isset( $_POST['month'] ) ? absint( $_POST['month'] ) : 0;
	$day   = isset( $_POST['day'] ) ? absint( $_POST['day'] ) : 0;
	if ( $year > 0 ) {
		$args['year'] = $year;
	}
	if ( $month > 0 ) {
		$args['monthnum'] = $month;
	}
	if ( $day > 0 ) {
		$args['day'] = $day;
	}

	$query = new WP_Query( $args );

	ob_start();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		}
	}
	$html = ob_get_clean();
	wp_reset_postdata();

	wp_send_json_success(
		array(
			'html'      => $html,
			'has_more'  => $paged < (int) $query->max_num_pages,
			'next_page' => $paged + 1,
		)
	);
}
add_action( 'wp_ajax_lb19_load_more_posts', 'lb19_ajax_load_more_posts' );
add_action( 'wp_ajax_nopriv_lb19_load_more_posts', 'lb19_ajax_load_more_posts' );


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



add_filter( 'posts_search', 'lb19_search_by_slug', 10, 2 );
/**
 * Add post slugs to admin search for a specific post type
 *
 * Rebuilds the search clauses to include post slugs.
 *
 * @param  string $search
 * @param  WP_Query $query
 * @return string
 */
function lb19_search_by_slug( $search, $query ) {
	global $wpdb;

	// Only run if we're in the admin and searching our specific post type
	if ( $query->is_search() && $query->is_admin && 'post' === $query->query_vars['post_type'] ) {
		$search = ''; // We will rebuild the entire clause
		$searchand = '';
		foreach ( $query->query_vars['search_terms'] as $term ) {
			$like = '%' . $wpdb->esc_like( $term ) . '%';
			$search .= $wpdb->prepare( "{$searchand}(($wpdb->posts.post_title LIKE %s) OR ($wpdb->posts.post_content LIKE %s) OR ($wpdb->posts.post_name LIKE %s))", $like, $like, $like );
			$searchand = ' AND ';
		}

		error_log(print_r($search,true));

		if ( ! empty( $search ) ) {
			$search = " AND ({$search}) ";
			if ( ! is_user_logged_in() )
				$search .= " AND ($wpdb->posts.post_password = '') ";
		}
	}

	return $search;
}



/**
 * Post Navigation butons
 *
 * Imprime la barra de navegacion entre paginas
 */
function mdl_the_posts_navigation() {
	echo '<!-- mdl_the_posts_navigation -->';
	echo '<nav class="post-nav">';
	next_posts_link( '<span class="post-nav__button">←</span>' );
	echo '<div class="post-nav__spacer"></div>';
	previous_posts_link( '<span class="post-nav__button">→</span>' );
	echo '</nav>';
	echo '<!-- mdl_the_posts_navigation -->';
}
