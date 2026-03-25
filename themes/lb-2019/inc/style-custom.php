<?php
/**
 * This file return the custom CSS
 *
 * @package lb19
 */

/**
 * Get the contrast of color
 *
 * @param string $hex Hexadecimal color.
 */
function getcontrast( $hex ) {
	$r   = hexdec( substr( $hex, 1, 2 ) );
	$g   = hexdec( substr( $hex, 3, 2 ) );
	$b   = hexdec( substr( $hex, 4, 2 ) );
	$yiq = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;
	return ( $yiq >= 128 ) ? 'rgba(0, 0, 0, 0.87)' : 'rgba(255, 255, 255, 1)';
}

/**
 * Return the CSS code
 */
function custom_style() {
	$color_primary   = get_theme_mod( 'mdl-color-primary' );
	$color_secondary = get_theme_mod( 'mdl-color-secondary' );
	$color_primary_text   = getcontrast( $color_primary );
	$color_secondary_text = getcontrast( $color_secondary );

	$css = '
  
  :root {
    --color-primary: ' . $color_primary . ';
    --color-secondary: ' . $color_secondary . ';
    --color-primary-text: ' . $color_primary_text . ';
    --color-secondary-text: ' . $color_secondary_text . ';
  }

  .site-header {
    background-color: var(--color-primary);
    color: var(--color-primary-text);
  }

  .site-footer {
    background-color: var(--color-primary);
    color: var(--color-primary-text);
  }

  .site-menu a:hover {
    color: var(--color-primary);
  }

  a {
    color: var( --color-secondary );
  }

  .post-nav a,
  .post-nav span,
  .button,
  button[type="submit"].button {
    background-color: var( --color-secondary );
    color: var(--color-secondary-text);
  }

  a.checkout-button,
  button[type="submit"].button {
    background-color: var( --color-secondary );
    color: var(--color-secondary-text);
  }

  a.checkout-button:hover,
  button[type="submit"].button:hover,
  .button:hover {
    background-color: var(--color-primary);
  }
';
	?>

	<style type="text/css" id="lb19-custom-styles">

	<?php echo esc_attr( $css ); ?>

	</style>

	<?php
}
