<?php
/**
 * Archive Template
 *
 * @package dark-matter
 */

get_header();
?>

<main class="py-20 md:py-32" style="background: var(--void); min-height: 70vh;">
	<div class="max-w-screen-xl mx-auto px-6">

		<div class="mb-12 fade-in-up">
			<div class="flex items-center gap-4 mb-4">
				<span class="text-xs tracking-widest" style="color: var(--electric); font-family: 'JetBrains Mono', monospace; letter-spacing: 0.2em;">
					<?php esc_html_e( 'ARCHIVE', 'dark-matter' ); ?>
				</span>
				<span class="block flex-1" style="height: 1px; background: var(--border-subtle);"></span>
			</div>
			<h1 class="text-2xl md:text-3xl font-bold uppercase tracking-wide" style="font-family: 'Impact', 'Haettenschweiler', 'Arial Narrow Bold', sans-serif; letter-spacing: 0.02em;">
				<?php the_archive_title(); ?>
			</h1>
			<?php the_archive_description( '<p class="mt-3 text-sm leading-relaxed max-w-xl" style="color: var(--muted-grey);">', '</p>' ); ?>
		</div>

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