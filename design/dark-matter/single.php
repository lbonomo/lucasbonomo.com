<?php
/**
 * Single Post Template
 *
 * @package dark-matter
 */

get_header();
?>

<main class="py-20 md:py-32" style="background: var(--void); min-height: 70vh;">
	<div class="max-w-3xl mx-auto px-6">
		<?php while ( have_posts() ) :
			the_post();
		?>
			<article>
				<div class="mb-8 fade-in-up">
					<div class="flex items-center gap-3 mb-4">
						<?php
						$categories = get_the_category();
						if ( ! empty( $categories ) ) :
						?>
							<span class="text-xs tracking-widest uppercase" style="color: var(--electric); font-family: 'JetBrains Mono', monospace; font-size: 0.6rem;">
								<?php echo esc_html( $categories[0]->name ); ?>
							</span>
						<?php endif; ?>
						<span style="height: 1px; flex: 1; background: var(--border-subtle);"></span>
						<time class="text-xs" style="color: var(--dim-grey); font-family: 'JetBrains Mono', monospace; font-size: 0.6rem;">
							<?php echo esc_html( get_the_date( 'M d, Y' ) ); ?>
						</time>
					</div>

					<h1 class="text-3xl md:text-4xl font-bold uppercase leading-tight mb-4" style="font-family: 'Impact', 'Haettenschweiler', 'Arial Narrow Bold', sans-serif; letter-spacing: -0.01em;">
						<?php the_title(); ?>
					</h1>

					<p class="text-sm" style="color: var(--dim-grey); font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; letter-spacing: 0.1em;">
						<?php
						printf(
							/* translators: %s: author name */
							esc_html__( 'by %s', 'dark-matter' ),
							esc_html( get_the_author() )
						);
						?>
						&mdash;
						<?php
						printf(
							/* translators: %s: reading time */
							esc_html__( '%s min read', 'dark-matter' ),
							esc_html( max( 1, round( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 250 ) ) )
						);
						?>
					</p>
				</div>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mb-12 overflow-hidden fade-in-up fade-in-up-delay-1" style="border: 1px solid var(--border-subtle);">
						<?php the_post_thumbnail( 'large', array(
							'class' => 'w-full',
							'style' => 'filter: saturate(0.4) contrast(1.1) brightness(0.8);',
						) ); ?>
					</div>
				<?php endif; ?>

				<div class="prose prose-invert max-w-none fade-in-up fade-in-up-delay-2" style="color: var(--muted-grey); line-height: 1.75; font-size: 1.05rem;">
					<?php the_content(); ?>
				</div>

				<div class="mt-16 pt-8" style="border-top: 1px solid var(--border-subtle);">
					<div class="flex items-center justify-between">
						<div>
							<?php
							$prev_post = get_previous_post();
							if ( $prev_post ) :
							?>
								<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="text-xs tracking-wider uppercase no-underline" style="color: var(--electric); font-family: 'JetBrains Mono', monospace; letter-spacing: 0.1em;">
									&larr; <?php esc_html_e( 'Previous', 'dark-matter' ); ?>
								</a>
							<?php endif; ?>
						</div>
						<div>
							<?php
							$next_post = get_next_post();
							if ( $next_post ) :
							?>
								<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="text-xs tracking-wider uppercase no-underline" style="color: var(--electric); font-family: 'JetBrains Mono', monospace; letter-spacing: 0.1em;">
									<?php esc_html_e( 'Next', 'dark-matter' ); ?> &rarr;
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();