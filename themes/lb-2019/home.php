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
<!-- primary -->
<!-- <h1>archive.php</h1> -->
<div class="archive-grid">
		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
				lb19_infinite_scroll_sentinel();

		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
</div>
<!-- #primary -->

<?php

get_footer();