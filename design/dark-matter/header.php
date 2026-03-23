<?php
/**
 * Header template
 *
 * @package dark-matter
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="max-w-screen-xl mx-auto px-6 flex items-center justify-between h-16">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2 no-underline" style="font-family: 'JetBrains Mono', 'Courier New', monospace;">
			<span class="logo-cursor"></span>
			<span class="text-xs tracking-widest uppercase" style="color: var(--electric);">
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</span>
		</a>

		<nav class="hidden md:flex items-center gap-8" style="font-family: 'JetBrains Mono', 'Courier New', monospace;">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'fallback_cb'    => 'dark_matter_fallback_menu',
				'walker'         => new Dark_Matter_Nav_Walker(),
			) );
			?>
			<a href="#contact" class="btn-electric text-xs tracking-wider uppercase px-5 py-2 no-underline" style="font-family: 'JetBrains Mono', 'Courier New', monospace;">
				<?php esc_html_e( 'Start a Project', 'dark-matter' ); ?>
			</a>
		</nav>

		<button id="dm-mobile-toggle" class="md:hidden flex flex-col gap-1.5 p-2 bg-transparent border-0 cursor-pointer" aria-label="<?php esc_attr_e( 'Toggle navigation', 'dark-matter' ); ?>">
			<span class="block w-6 h-px" style="background: var(--electric);"></span>
			<span class="block w-4 h-px" style="background: var(--electric);"></span>
			<span class="block w-6 h-px" style="background: var(--electric);"></span>
		</button>
	</div>

	<div id="dm-mobile-menu" class="hidden md:hidden px-6 pb-6" style="background: rgba(10, 10, 10, 0.95); font-family: 'JetBrains Mono', 'Courier New', monospace;">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '<div class="flex flex-col gap-4 pt-4">%3$s</div>',
			'fallback_cb'    => 'dark_matter_fallback_mobile_menu',
			'walker'         => new Dark_Matter_Mobile_Nav_Walker(),
		) );
		?>
		<a href="#contact" class="btn-electric text-xs tracking-wider uppercase px-5 py-3 no-underline block text-center mt-4">
			<?php esc_html_e( 'Start a Project', 'dark-matter' ); ?>
		</a>
	</div>
</header>

<div style="height: 64px;"></div>