<?php
/**
 * Main Index Template
 *
 * @package dark-matter
 */

get_header();
?>

<main class="py-20 md:py-32" style="background: var(--void); min-height: 70vh;">
	<div class="max-w-screen-xl mx-auto px-6">

		<?php dark_matter_section_header(
			'///',
			__( 'All Posts', 'dark-matter' ),
			__( 'Browse the complete archive.', 'dark-matter' )
		); ?>

		<?php if ( have_posts() ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
				<?php while ( have_posts() ) :
					the_post();
					dark_matter_render_post_card( $GLOBALS['post'] );
				endwhile; ?>
			</div>

			<div class="mt-16 flex items-center justify-center gap-4" style="font-family: 'JetBrains Mono', monospace;">
				<?php
				the_posts_pagination( array(
					'mid_size'  => 1,
					'prev_text' => '&larr; ' . __( 'Prev', 'dark-matter' ),
					'next_text' => __( 'Next', 'dark-matter' ) . ' &rarr;',
				) );
				?>
			</div>
		<?php else : ?>
			<div class="text-center py-20">
				<p class="text-sm" style="color: var(--dim-grey); font-family: 'JetBrains Mono', monospace; letter-spacing: 0.1em; text-transform: uppercase;">
					<?php esc_html_e( 'No entries found.', 'dark-matter' ); ?>
				</p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();