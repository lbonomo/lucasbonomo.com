<?php
/**
 * Main entry point for the application
 * @package    LB25
 * @author     Lucas Bonomo <bonomo.lucas@gmail.com>
 */

get_header();
the_post();

?>

<main class="bg-gray-50 text-gray-700 min-h-screen">
	<section class="container mx-auto px-6 py-20 lg:py-32 text-center hero-gradient">
		<div class="text-xl md:text-2xl text-blue-600 font-semibold mb-6">
			<?php bloginfo('description'); ?>
		</div>
		<div class="max-w-3xl mx-auto text-lg text-gray-600 mb-8">
			<?php the_content(); ?>
		</div>
		<a href="#contacto" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg text-lg transition duration-300 inline-block shadow-lg shadow-blue-500/30">
			Quiero una Auditoría Gratis
		</a>
		<p class="mt-8 text-sm text-gray-500">
			Más de <span class="font-bold text-gray-800">20 años de experiencia</span> en Diseño y Desarrollo Web especializado en WordPress.
		</p>
	</section>
</main>

<?php get_footer(); ?>