<?php

/**
 * Header template for the theme.
 *
 * @package LB25
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter(
	'body_class',
	function ( $classes ) {
		$classes[] = 'bg-gray-50';
		$classes[] = 'text-gray-700';

		return $classes;
	}
);

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php $primary_menu_location = lb25_get_primary_menu_location(); ?>

	<header class="main-header" role="banner">
		<div class="header-inner">
			<div class="custom-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-link" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<span class="logo-cursor" aria-hidden="true"></span>
					<span class="brand-text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				</a>
			</div>

			<nav class="desktop-menu" aria-label="Primary Navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => $primary_menu_location,
						'container'      => false,
						'menu_class'     => 'header-nav',
						'fallback_cb'    => 'lb25_primary_menu_fallback',
					)
				);
				?>
			</nav>

			<button
				type="button"
				id="mobile-menu-button"
				class="mobile-menu-button"
				aria-controls="mobile-menu"
				aria-expanded="false"
			>
				<span class="sr-only"><?php esc_html_e( 'Abrir menú principal', 'lb25' ); ?></span>
				<svg class="icon-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
				</svg>
				<svg class="icon-close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
		</div>

		<nav class="mobile-menu" id="mobile-menu" aria-label="Mobile Navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => $primary_menu_location,
					'container'      => false,
					'menu_class'     => 'header-nav-mobile',
					'fallback_cb'    => 'lb25_primary_menu_fallback',
				)
			);
			?>
		</nav>
	</header>
