<?php
/**
 * Page Template
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
				<h1 class="text-3xl md:text-4xl font-bold uppercase leading-tight mb-8 fade-in-up" style="font-family: 'Impact', 'Haettenschweiler', 'Arial Narrow Bold', sans-serif; letter-spacing: -0.01em;">
					<?php the_title(); ?>
				</h1>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mb-12 overflow-hidden fade-in-up fade-in-up-delay-1" style="border: 1px solid var(--border-subtle);">
						<?php the_post_thumbnail( 'large', array(
							'class' => 'w-full',
							'style' => 'filter: saturate(0.4) contrast(1.1) brightness(0.8);',
						) ); ?>
					</div>
				<?php endif; ?>

				<div class="prose prose-invert max-w-none fade-in-up fade-in-up-delay-1" style="color: var(--muted-grey); line-height: 1.75; font-size: 1.05rem;">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();