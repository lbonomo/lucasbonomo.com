<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lb19
 */

?>
		</main>
	<?php if ( is_active_sidebar( 'sidebar-1' ) ||
	is_active_sidebar( 'sidebar-2' ) ||
	is_active_sidebar( 'sidebar-3' ) ||
	is_active_sidebar( 'sidebar-4' ) ) { ?>

			<footer class="site-footer bg-[var(--color-primary)]/90 text-[var(--color-primary-text)] mt-12">
				<div class="mx-auto w-fit max-w-7xl px-4 py-10 grid gap-8 md:grid-cols-4">
					<div>
						<?php if ( is_active_sidebar( 'sidebar-1' ) ) { dynamic_sidebar( 'sidebar-1' );	} ?>
					</div>
					<div>
						<?php if ( is_active_sidebar( 'sidebar-2' ) ) { dynamic_sidebar( 'sidebar-2' );	} ?>
					</div>
					<div>
						<?php if ( is_active_sidebar( 'sidebar-3' ) ) { dynamic_sidebar( 'sidebar-3' );	} ?>
					</div>
					<div>
						<?php if ( is_active_sidebar( 'sidebar-4' ) ) { dynamic_sidebar( 'sidebar-4' );	} ?>
					</div>
				</div>
			</footer>
		<?php } ?>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>
