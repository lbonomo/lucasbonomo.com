<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package lb19
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses lb19_header_style()
 */
function lb19_custom_header_setup() {
	$header_args = array(
		'default-text-color' => '000000',
		'wp-head-callback'   => 'lb19_header_style',
	);
}
add_action( 'after_setup_theme', 'lb19_custom_header_setup' );

if ( ! function_exists( 'lb19_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see lb19_custom_header_setup().
	 */
	function lb19_header_style() {
		$header_text_color   = get_header_textcolor();
		$color_primary       = get_theme_mod( 'mdl-color-primary', 'FFFFFF' );
		$color_primary_dark  = get_theme_mod( 'mdl-color-primary-dark', 'FFFFFF' );
		$color_primary_light = get_theme_mod( 'mdl-color-primary-light', 'FFFFFF' );

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		// Analizar el uso de var(--header-text-color) en el CSS
		// Ver el codigo fuente de lighthouse.
		?>
		<style type="text/css">
			h1, h2, h3, h4, h5, h6  {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}

			.site-title {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
			.site-header {
				background-color: <?php echo esc_attr( $color_primary ); ?> !important;
			}

			.site-footer {
				background-color: <?php echo esc_attr( $color_primary_dark ); ?> !important;
			}

			.lb19-ribbon {
				background-color: <?php echo esc_attr( $color_primary_dark ); ?> !important;
			}

		</style>
		<?php
	}
endif;
