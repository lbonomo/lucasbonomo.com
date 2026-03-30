<?php
/**
 * Footer template
 *
 * @package dark-matter
 */
?>

<footer class="py-12 border-t" style="border-color: var(--border-subtle); background: var(--void);">
	<div class="max-w-screen-xl mx-auto px-6">
		<div class="flex flex-col md:flex-row items-center justify-between gap-6">
			<div class="flex items-center gap-2" style="font-family: 'JetBrains Mono', 'Courier New', monospace;">
				<span class="logo-cursor"></span>
				<span class="text-xs tracking-widest uppercase" style="color: var(--electric);">
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</span>
			</div>

			<p class="text-xs footer-credit" style="color: var(--dim-grey); font-family: 'JetBrains Mono', 'Courier New', monospace; letter-spacing: 0.05em;">
				<?php
				printf(
					/* translators: 1: Telex link, 2: WordPress link */
					esc_html__( 'Created with %1$s, powered by %2$s', 'dark-matter' ),
					'<a href="https://telex.automattic.ai" target="_blank" rel="noopener noreferrer">Telex</a>',
					'<a href="https://wordpress.org" target="_blank" rel="noopener noreferrer">WordPress</a>'
				);
				?>
			</p>

			<div class="text-xs" style="color: var(--dim-grey); font-family: 'JetBrains Mono', 'Courier New', monospace; letter-spacing: 0.1em;">
				&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>