<?php
/**
 * 404 Error Page
 *
 * @package dark-matter
 */

get_header();
?>

<main class="flex items-center justify-center" style="min-height: 80vh; background: var(--void);">
	<div class="text-center px-6">

		<div class="mb-8 fade-in-up" style="font-family: 'Impact', 'Haettenschweiler', 'Arial Narrow Bold', sans-serif; font-size: clamp(5rem, 15vw, 12rem); line-height: 0.9; letter-spacing: -0.03em; text-transform: uppercase; color: var(--electric); opacity: 0.15;">
			404
		</div>

		<div class="mb-4 fade-in-up fade-in-up-delay-1" style="font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: var(--electric);">
			<?php esc_html_e( '// Page Not Found', 'dark-matter' ); ?>
		</div>

		<h1 class="text-2xl md:text-3xl font-bold uppercase mb-4 fade-in-up fade-in-up-delay-2" style="font-family: 'Impact', 'Haettenschweiler', 'Arial Narrow Bold', sans-serif;">
			<?php esc_html_e( 'Signal Lost', 'dark-matter' ); ?>
		</h1>

		<p class="text-sm mb-10 fade-in-up fade-in-up-delay-3" style="color: var(--muted-grey); max-width: 400px; margin-left: auto; margin-right: auto;">
			<?php esc_html_e( 'The page you are looking for has been moved, deleted, or never existed. Try navigating back to a known location.', 'dark-matter' ); ?>
		</p>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-electric inline-block no-underline fade-in-up fade-in-up-delay-4" style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.85rem 2.5rem;">
			<?php esc_html_e( 'Return Home', 'dark-matter' ); ?>
		</a>
	</div>
</main>

<?php
get_footer();