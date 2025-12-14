<?php
/**
 * Template Name: Full Width no title
 * Template Post Type: page
 *
 * Custom page template for the full width home page.
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

		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>
</div>

<?php
get_footer();
