<?php
/**
 * Template Part: Contact CTA Banner
 *
 * @package dark-matter
 */
?>
<section id="contact" class="py-20 md:py-32" style="background: var(--deep-navy);">
	<div class="max-w-screen-xl mx-auto px-6">
		<div class="contact-glow relative overflow-hidden p-12 md:p-20 text-center" style="background: var(--card-bg); border: 1px solid var(--border-subtle);">

			<div class="relative z-10">
				<div class="mb-6 fade-in-up" style="font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: var(--electric);">
					<?php esc_html_e( '// Ready to collaborate?', 'dark-matter' ); ?>
				</div>

				<h2 class="text-3xl md:text-5xl font-bold uppercase mb-6 fade-in-up fade-in-up-delay-1" style="font-family: 'Impact', 'Haettenschweiler', 'Arial Narrow Bold', sans-serif; letter-spacing: -0.01em; line-height: 1.05;">
					<?php esc_html_e( "Let's Build Something", 'dark-matter' ); ?><br/>
					<span style="color: var(--electric);"><?php esc_html_e( 'Extraordinary', 'dark-matter' ); ?></span>
				</h2>

				<p class="text-sm leading-relaxed max-w-lg mx-auto mb-10 fade-in-up fade-in-up-delay-2" style="color: var(--muted-grey);">
					<?php esc_html_e( 'I take on a limited number of projects each quarter to ensure every engagement gets the focus it deserves. Get in touch to discuss your next build.', 'dark-matter' ); ?>
				</p>

				<div class="flex flex-col sm:flex-row items-center justify-center gap-4 fade-in-up fade-in-up-delay-3">
					<a href="mailto:hello@example.com" class="btn-electric inline-block no-underline" style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.85rem 2.5rem;">
						<?php esc_html_e( 'Start a Conversation', 'dark-matter' ); ?>
					</a>
					<span class="text-xs" style="color: var(--dim-grey); font-family: 'JetBrains Mono', monospace; letter-spacing: 0.1em;">
						<?php esc_html_e( 'or', 'dark-matter' ); ?>
					</span>
					<a href="#" class="text-xs tracking-wider uppercase no-underline transition-colors duration-200" style="color: var(--electric); font-family: 'JetBrains Mono', monospace; letter-spacing: 0.1em;">
						<?php esc_html_e( 'Schedule a Call', 'dark-matter' ); ?> &rarr;
					</a>
				</div>
			</div>

			<div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse at 50% 0%, rgba(74, 240, 240, 0.05) 0%, transparent 60%);"></div>
		</div>
	</div>
</section>