<?php
/**
 * Template helper functions
 *
 * @package dark-matter
 */

if ( ! function_exists( 'dark_matter_render_post_card' ) ) {
	/**
	 * Render a post card component.
	 *
	 * @param WP_Post $post The post object.
	 * @param array   $args Optional display arguments.
	 */
	function dark_matter_render_post_card( $post, $args = array() ) {
		$defaults = array(
			'show_excerpt' => true,
			'show_date'    => true,
			'show_meta'    => true,
		);
		$args = wp_parse_args( $args, $defaults );
		?>
		<article class="dm-card overflow-hidden fade-in-up" style="font-family: 'Trebuchet MS', 'Lucida Grande', sans-serif;">
			<?php if ( has_post_thumbnail( $post ) ) : ?>
				<div class="dm-card-image">
					<?php echo get_the_post_thumbnail( $post, 'medium_large', array( 'class' => 'w-full' ) ); ?>
				</div>
			<?php else : ?>
				<div class="dm-card-image" style="background: linear-gradient(135deg, var(--deep-navy), var(--card-bg)); height: 200px; display: flex; align-items: center; justify-content: center;">
					<span style="color: var(--dim-grey); font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;">No Image</span>
				</div>
			<?php endif; ?>

			<div class="p-6">
				<?php if ( $args['show_meta'] ) : ?>
					<div class="flex items-center gap-3 mb-3">
						<?php
						$categories = get_the_category( $post->ID );
						if ( ! empty( $categories ) ) :
						?>
							<span class="text-xs tracking-widest uppercase" style="color: var(--electric); font-family: 'JetBrains Mono', monospace; font-size: 0.6rem;">
								<?php echo esc_html( $categories[0]->name ); ?>
							</span>
						<?php endif; ?>
						<?php if ( $args['show_date'] ) : ?>
							<span class="text-xs" style="color: var(--dim-grey); font-family: 'JetBrains Mono', monospace; font-size: 0.6rem;">
								<?php echo esc_html( get_the_date( 'M d, Y', $post ) ); ?>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<h3 class="text-lg font-semibold mb-2 leading-tight" style="font-family: 'Space Grotesk', 'Trebuchet MS', sans-serif;">
					<a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="no-underline transition-colors duration-200" style="color: var(--cool-white);">
						<?php echo esc_html( get_the_title( $post ) ); ?>
					</a>
				</h3>

				<?php if ( $args['show_excerpt'] ) : ?>
					<p class="text-sm leading-relaxed" style="color: var(--muted-grey);">
						<?php echo esc_html( get_the_excerpt( $post ) ); ?>
					</p>
				<?php endif; ?>

				<div class="mt-4 pt-4" style="border-top: 1px solid var(--border-subtle);">
					<a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="text-xs tracking-wider uppercase no-underline transition-colors duration-200" style="color: var(--electric); font-family: 'JetBrains Mono', monospace; letter-spacing: 0.1em;">
						<?php esc_html_e( 'Read More', 'dark-matter' ); ?> &rarr;
					</a>
				</div>
			</div>
		</article>
		<?php
	}
}

if ( ! function_exists( 'dark_matter_render_cpt_card' ) ) {
	/**
	 * Render a CPT card component.
	 *
	 * @param WP_Post $post The post object.
	 * @param array   $args Optional display arguments.
	 */
	function dark_matter_render_cpt_card( $post, $args = array() ) {
		$defaults = array(
			'show_excerpt' => true,
			'label_text'   => '',
		);
		$args = wp_parse_args( $args, $defaults );

		$post_type_obj = get_post_type_object( get_post_type( $post ) );
		$label = ! empty( $args['label_text'] ) ? $args['label_text'] : ( $post_type_obj ? $post_type_obj->labels->singular_name : '' );
		?>
		<article class="dm-card overflow-hidden fade-in-up" style="font-family: 'Trebuchet MS', 'Lucida Grande', sans-serif;">
			<?php if ( has_post_thumbnail( $post ) ) : ?>
				<div class="dm-card-image">
					<?php echo get_the_post_thumbnail( $post, 'medium_large', array( 'class' => 'w-full' ) ); ?>
				</div>
			<?php else : ?>
				<div class="dm-card-image" style="background: linear-gradient(135deg, var(--deep-navy), var(--card-bg)); height: 200px; display: flex; align-items: center; justify-content: center;">
					<div style="width: 48px; height: 48px; border: 1px solid var(--border-subtle); display: flex; align-items: center; justify-content: center;">
						<span style="color: var(--electric); font-family: 'JetBrains Mono', monospace; font-size: 0.7rem;">//</span>
					</div>
				</div>
			<?php endif; ?>

			<div class="p-6">
				<?php if ( $label ) : ?>
					<span class="inline-block text-xs tracking-widest uppercase mb-3" style="color: var(--electric); font-family: 'JetBrains Mono', monospace; font-size: 0.6rem;">
						<?php echo esc_html( $label ); ?>
					</span>
				<?php endif; ?>

				<h3 class="text-lg font-semibold mb-2 leading-tight" style="font-family: 'Space Grotesk', 'Trebuchet MS', sans-serif;">
					<a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="no-underline transition-colors duration-200" style="color: var(--cool-white);">
						<?php echo esc_html( get_the_title( $post ) ); ?>
					</a>
				</h3>

				<?php if ( $args['show_excerpt'] ) : ?>
					<p class="text-sm leading-relaxed" style="color: var(--muted-grey);">
						<?php echo esc_html( get_the_excerpt( $post ) ); ?>
					</p>
				<?php endif; ?>

				<div class="mt-4 pt-4" style="border-top: 1px solid var(--border-subtle);">
					<a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="text-xs tracking-wider uppercase no-underline transition-colors duration-200" style="color: var(--electric); font-family: 'JetBrains Mono', monospace; letter-spacing: 0.1em;">
						<?php esc_html_e( 'View Details', 'dark-matter' ); ?> &rarr;
					</a>
				</div>
			</div>
		</article>
		<?php
	}
}

if ( ! function_exists( 'dark_matter_section_header' ) ) {
	/**
	 * Render a section header with number, title and subtitle.
	 *
	 * @param string $number  Section number (e.g. "01").
	 * @param string $title   Section title.
	 * @param string $subtitle Optional subtitle.
	 */
	function dark_matter_section_header( $number, $title, $subtitle = '' ) {
		?>
		<div class="mb-12 fade-in-up">
			<div class="flex items-center gap-4 mb-4">
				<span class="service-number text-xs tracking-widest" style="color: var(--electric); font-family: 'JetBrains Mono', monospace; letter-spacing: 0.2em;">
					<?php echo esc_html( $number ); ?>
				</span>
				<span class="block flex-1" style="height: 1px; background: var(--border-subtle);"></span>
			</div>
			<h2 class="text-2xl md:text-3xl font-bold uppercase tracking-wide" style="font-family: 'Impact', 'Haettenschweiler', 'Arial Narrow Bold', sans-serif; letter-spacing: 0.02em;">
				<?php echo esc_html( $title ); ?>
			</h2>
			<?php if ( $subtitle ) : ?>
				<p class="mt-3 text-sm leading-relaxed max-w-xl" style="color: var(--muted-grey);">
					<?php echo esc_html( $subtitle ); ?>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
}