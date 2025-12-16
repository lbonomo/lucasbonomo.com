<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */


get_header();
?>

<div class="home-page-template mdl-grid mdl-grid--no-spacing">
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'home-page' );

	endwhile;
	?>
</div>

<?php

get_footer();
