<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lucas_2025
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('flex items-stretch flex-col mb-8'); ?> >

	<header class="entry-header flex flex-row gap-4">

		<?php lucas_2025_post_thumbnail(); ?>

		
		<div class="flex flex-col justify-between">
			<?php
			if ( is_sticky() && is_home() && ! is_paged() ) {
				printf( '%s', esc_html_x( 'Featured', 'post', 'lucas_2025' ) );
			}
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			?>

			<footer class="entry-footer text-xs flex flex-row gap-1 justify-end">
				<?php lucas_2025_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>

	</header><!-- .entry-header -->

	<div <?php lucas_2025_content_class( 'entry-content' ); ?>>
		<?php 
		the_excerpt();
		// the_comment();
		?>
		
	</div><!-- .entry-content -->

</article><!-- #post-${ID} -->
