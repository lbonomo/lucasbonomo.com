<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package lb19
 */

get_header();
?>
<div class="archive-grid">

		<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-header__title">
					<?php
					/* translators: %s: search query. */
					printf(
						/* translators: %s: search query. */
						esc_html__( 'Resultados de la búsqueda: %s', 'lb19' ),
						'<span>' . esc_html( get_search_query() ) . '</span>'
					);
					?>
				</h1>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			lb19_infinite_scroll_sentinel();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

</div><!-- #primary -->

<?php
get_footer();
