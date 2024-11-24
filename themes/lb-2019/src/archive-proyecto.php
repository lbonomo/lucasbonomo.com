<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */
require get_template_directory() . '/inc/navigation.php';

get_header();
?>
<!-- primary -->
<!-- <h1>archive.php</h1> -->
<div class="mdl-grid content-max-width content-contact">
		<?php if ( have_posts() ) : ?>

			<!--  -->
			<header class="page-header">
				
			</header><!-- .page-header -->

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
				echo "<!-- mdl_the_posts_navigation -->";
				mdl_the_posts_navigation();
				echo "<!-- mdl_the_posts_navigation -->";

		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
</div>
<!-- #primary -->

<?php
get_sidebar();
get_footer();
