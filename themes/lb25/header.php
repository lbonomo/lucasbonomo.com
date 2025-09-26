<?php

/**
 * Header template for the theme
 *
 * @package LB25
 * @author Lucas Bonomo bonomo.lucas@gmail.com
 */

// Prevent direct access
if (!defined('ABSPATH')) {
	exit;
}

// Add custom body classes
add_filter('body_class', function ($classes) {
	$classes = array('bg-gray-50', 'text-gray-700', '');
	return $classes;
});

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<!-- BARRA DE NAVEGACIÓN -->
	<nav class="main-header">
		<div class="container mx-auto px-6">
			<div class="site-branding">
				<div class="custom-logo">
					<?php if (has_custom_logo()) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<h1 class="site-title">
							<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
						</h1>
						<?php $description = get_bloginfo('description', 'display'); ?>
						<?php if ($description || is_customize_preview()) : ?>
							<p class="site-description"><?php echo $description; ?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<!-- Main Navigation -->
				<div class="desktop-menu">
					<?php
					require_once get_template_directory() . '/inc/class-tailwind-nav-walker.php';
					wp_nav_menu(array(
						'theme_location' => 'header-menu',
						'container'      => false,
						'menu_class'     => '', // Walker genera el contenedor y las clases
						'walker'         => new Tailwind_Nav_Walker(),
					));
					?>
				</div>

				<!-- Botón Menú Móvil -->
				<div class="-mr-2 flex md:hidden">
					<button type="button" id="mobile-menu-button" class="bg-gray-100 inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
						<span class="sr-only">Abrir menú principal</span>
						<svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
						</svg>
						<svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
				</div>
			</div>
		</div>
		<!-- Menú Móvil, se muestra/oculta basado en el estado. -->
		<div class="mobile-menu" id="mobile-menu">
			<div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
				<a href="#beneficios" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Beneficios</a>
				<a href="#servicios" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Servicios</a>
				<a href="#portfolio" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Portfolio</a>
				<a href="#metodologia" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Proceso</a>
				<a href="#contacto" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Contacto</a>
			</div>
		</div>
	</nav>


	<main class="site-main">