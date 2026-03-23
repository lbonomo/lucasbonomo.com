<?php
/**
 * Template Part: Hero Section
 *
 * @package dark-matter
 */
?>
<section id="hero" class="relative flex items-end overflow-hidden" style="min-height: 100vh; background: var(--void);">

	<div class="hero-bg-element">
		<img
			src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero.png' ); ?>"
			alt="<?php esc_attr_e( 'Hero portrait', 'dark-matter' ); ?>"
			loading="eager"
		/>
	</div>

	<div class="hero-scanline"></div>
	<div class="hero-grid-overlay"></div>

	<div class="hidden lg:block absolute top-24 right-8 text-right z-10" style="font-family: 'JetBrains Mono', monospace; font-size: 0.6rem; letter-spacing: 0.1em; color: var(--dim-grey); line-height: 1.8;">
		53.3498&deg; N<br/>
		6.2603&deg; W<br/>
		<br/>
		v3.2.1
	</div>

	<div class="relative z-10 w-full max-w-screen-xl mx-auto px-6" style="padding-bottom: 8vh; padding-top: 100px;">

		<div class="flex items-center gap-3 mb-8 fade-in-up" style="font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: var(--electric);">
			<span class="status-dot"></span>
			<?php esc_html_e( 'Available for Q2 2026', 'dark-matter' ); ?>
		</div>

		<h1 class="fade-in-up fade-in-up-delay-1" style="font-family: 'Impact', 'Haettenschweiler', 'Arial Narrow Bold', 'Franklin Gothic Bold', sans-serif; font-weight: 900; font-size: clamp(3.5rem, 10vw, 8rem); line-height: 0.88; letter-spacing: -0.03em; text-transform: uppercase; color: var(--electric); max-width: 80vw; margin-bottom: 2.5rem;">
			<span class="block"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
		</h1>

		<p class="fade-in-up fade-in-up-delay-2" style="font-family: 'Trebuchet MS', 'Lucida Grande', sans-serif; font-size: 1.05rem; line-height: 1.65; color: var(--muted-grey); max-width: 480px; margin-bottom: 3rem;">
			<?php echo esc_html( get_bloginfo( 'description' ) ?: __( 'Systems designer and full-stack engineer building precise, performance-driven digital products. I partner with studios and startups to ship work that scales cleanly.', 'dark-matter' ) ); ?>
		</p>

		<a href="#work" class="btn-electric inline-block no-underline fade-in-up fade-in-up-delay-3" style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.85rem 2.5rem;">
			<?php esc_html_e( 'View Selected Work', 'dark-matter' ); ?>
		</a>
	</div>

	<div class="hidden lg:flex absolute right-8 z-10 text-right" style="bottom: 8vh; font-family: 'JetBrains Mono', monospace;">
		<div>
			<div class="mb-2" style="font-size: 0.6rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--dim-grey);">
				<?php esc_html_e( 'Discipline', 'dark-matter' ); ?>
				<span style="color: var(--muted-grey);">// <?php esc_html_e( 'Design + Engineering', 'dark-matter' ); ?></span>
			</div>
			<div class="mb-2" style="font-size: 0.6rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--dim-grey);">
				<?php esc_html_e( 'Stack', 'dark-matter' ); ?>
				<span style="color: var(--muted-grey);">// <?php esc_html_e( 'React, Node, WordPress, Go', 'dark-matter' ); ?></span>
			</div>
			<div style="font-size: 0.6rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--dim-grey);">
				<?php esc_html_e( 'Based', 'dark-matter' ); ?>
				<span style="color: var(--muted-grey);">// <?php esc_html_e( 'Dublin, IE', 'dark-matter' ); ?></span>
			</div>
		</div>
	</div>

	<div class="absolute left-1/2 transform -translate-x-1/2 flex flex-col items-center gap-2 z-10" style="bottom: 3vh;">
		<span class="scroll-line"></span>
		<span style="font-family: 'JetBrains Mono', monospace; font-size: 0.55rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--dim-grey); writing-mode: vertical-lr;">
			<?php esc_html_e( 'Scroll', 'dark-matter' ); ?>
		</span>
	</div>
</section>