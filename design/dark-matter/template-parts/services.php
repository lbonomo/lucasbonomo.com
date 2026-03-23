<?php
/**
 * Template Part: Services Section
 *
 * @package dark-matter
 */

$services = array(
	array(
		'number' => '01',
		'title'  => __( 'Systems Design', 'dark-matter' ),
		'desc'   => __( 'Architectural planning and design systems that scale. From component libraries to full-stack infrastructure blueprints.', 'dark-matter' ),
		'tags'   => array( 'Architecture', 'Design Systems', 'Documentation' ),
	),
	array(
		'number' => '02',
		'title'  => __( 'Frontend Engineering', 'dark-matter' ),
		'desc'   => __( 'High-performance interfaces built with React, Vue, and modern CSS. Pixel-perfect implementations with accessibility baked in.', 'dark-matter' ),
		'tags'   => array( 'React', 'Vue', 'Performance' ),
	),
	array(
		'number' => '03',
		'title'  => __( 'Full-Stack Development', 'dark-matter' ),
		'desc'   => __( 'End-to-end product development from API design to deployment pipelines. Node, Go, and WordPress at scale.', 'dark-matter' ),
		'tags'   => array( 'Node.js', 'Go', 'WordPress' ),
	),
	array(
		'number' => '04',
		'title'  => __( 'Creative Direction', 'dark-matter' ),
		'desc'   => __( 'Brand identity, motion design, and visual storytelling. Translating complex ideas into compelling digital experiences.', 'dark-matter' ),
		'tags'   => array( 'Branding', 'Motion', 'Strategy' ),
	),
);
?>

<section id="services" class="py-20 md:py-32" style="background: var(--void);">
	<div class="max-w-screen-xl mx-auto px-6">

		<?php dark_matter_section_header(
			'01',
			__( 'Services', 'dark-matter' ),
			__( 'Focused capabilities across design and engineering. Each engagement is scoped to deliver measurable outcomes.', 'dark-matter' )
		); ?>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
			<?php foreach ( $services as $index => $service ) : ?>
				<div class="dm-card p-8 fade-in-up fade-in-up-delay-<?php echo esc_attr( $index + 1 ); ?>">
					<div class="flex items-start justify-between mb-6">
						<span class="service-number" style="font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; letter-spacing: 0.2em; color: var(--electric);">
							<?php echo esc_html( $service['number'] ); ?>
						</span>
						<span style="color: var(--dim-grey); font-family: 'JetBrains Mono', monospace; font-size: 0.6rem;">//</span>
					</div>

					<h3 class="text-xl font-bold mb-3 uppercase tracking-wide" style="font-family: 'Impact', 'Haettenschweiler', 'Arial Narrow Bold', sans-serif; letter-spacing: 0.02em; color: var(--cool-white);">
						<?php echo esc_html( $service['title'] ); ?>
					</h3>

					<p class="text-sm leading-relaxed mb-6" style="color: var(--muted-grey);">
						<?php echo esc_html( $service['desc'] ); ?>
					</p>

					<div class="flex flex-wrap gap-2">
						<?php foreach ( $service['tags'] as $tag ) : ?>
							<span class="text-xs px-3 py-1" style="font-family: 'JetBrains Mono', monospace; font-size: 0.6rem; letter-spacing: 0.1em; color: var(--muted-grey); border: 1px solid var(--border-subtle);">
								<?php echo esc_html( $tag ); ?>
							</span>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>