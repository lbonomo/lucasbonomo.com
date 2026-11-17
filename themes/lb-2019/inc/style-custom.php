<?php
/**
 * This file return the custom CSS
 *
 * @package lb19
 */

/**
 * Get the contrast of color
 *
 * @param string $hex Hexadecimal color, with or without leading '#'.
 */
function getcontrast( $hex ) {
	$hex = ltrim( (string) $hex, '#' );

	// Expand shorthand (e.g. "fff" => "ffffff").
	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	// Fallback to white if the value is not a valid 6-digit hex.
	if ( ! preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		$hex = 'ffffff';
	}

	$r   = hexdec( substr( $hex, 0, 2 ) );
	$g   = hexdec( substr( $hex, 2, 2 ) );
	$b   = hexdec( substr( $hex, 4, 2 ) );
	$yiq = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;
	return ( $yiq >= 128 ) ? 'rgba(0, 0, 0, 0.87)' : 'rgba(255, 255, 255, 1)';
}

/**
 * Normalize a stored color value into a valid CSS hex color.
 *
 * The Customizer stores colors without a leading '#'.
 *
 * @param string $hex      Stored color value.
 * @param string $fallback Fallback hex (without '#') if the value is invalid.
 * @return string CSS color value including the leading '#'.
 */
function lb19_normalize_hex( $hex, $fallback = 'ffffff' ) {
	$hex = ltrim( (string) $hex, '#' );

	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	if ( ! preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		$hex = $fallback;
	}

	return '#' . $hex;
}

/**
 * Return the CSS code
 */
function custom_style() {
	$color_primary   = lb19_normalize_hex( get_theme_mod( 'mdl-color-primary', '1a1918' ) );
	$color_secondary = lb19_normalize_hex( get_theme_mod( 'mdl-color-secondary', 'ffffff' ) );
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

  /* Scoped high-contrast links for editorial prose (avoids illegible amber on white) */
  :where(.post-single-content, .proyecto-single-content, .entry-content, .content-panel__body) a:not(.cta):not(.content-cta):not(.wp-block-button__link):not(.button) {
    color: #0f766e;
    text-decoration: underline;
    text-underline-offset: 3px;
  }

  :where(.post-single-content, .proyecto-single-content, .entry-content, .content-panel__body) a:not(.cta):not(.content-cta):not(.wp-block-button__link):not(.button):hover {
    color: #0d9488;
  }

  .has-secondary-background-color a:not(.cta):not(.content-cta):not(.wp-block-button__link):not(.button) {
    color: #111827;
  }

  .has-primary-background-color a:not(.cta):not(.content-cta):not(.wp-block-button__link):not(.button),
  .has-secondary-text-background-color a:not(.cta):not(.content-cta):not(.wp-block-button__link):not(.button) {
    color: #ffffff;
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
    color: var(--color-primary-text);
  }
';
	?>

	<style type="text/css" id="lb19-custom-styles">

	<?php echo $css; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CSS built from sanitized hex/rgba values. ?>

	</style>

	<?php
}
