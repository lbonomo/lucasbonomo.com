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

			<footer class="mdl-mega-footer mdl-color--primary-dark">
				<div class="mdl-mega-footer--middle-section">
					<div class="mdl-mega-footer--drop-down-section">
						<?php if ( is_active_sidebar( 'sidebar-1' ) ) { dynamic_sidebar( 'sidebar-1' );	} ?>
					</div>
					<div class="mdl-mega-footer--drop-down-section">
						<?php if ( is_active_sidebar( 'sidebar-2' ) ) { dynamic_sidebar( 'sidebar-2' );	} ?>
					</div>
					<div class="mdl-mega-footer--drop-down-section">
						<?php if ( is_active_sidebar( 'sidebar-3' ) ) { dynamic_sidebar( 'sidebar-3' );	} ?>
					</div>
					<div class="mdl-mega-footer--drop-down-section">
						<?php if ( is_active_sidebar( 'sidebar-4' ) ) { dynamic_sidebar( 'sidebar-4' );	} ?>
					</div>
				</div>
			</footer>
		<?php } else { ?>
			<!-- Si no hay widgets.... -->
			<footer class="mdl-mini-footer mdl-color--primary-dark">
				  <div class="mdl-mini-footer__right-section">
						<a href="https://getmdl.io/">
							<img height="50px" src="<?php echo get_stylesheet_directory_uri().'/assets/images/logo-mdl.svg' ?>" />
						</a>
				</div>
			</footer>
		<?php } ?>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>
