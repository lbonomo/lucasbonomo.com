<?php
/**
 * Template Part: Latest Posts
 *
 * @package dark-matter
 */

$recent_posts = get_posts( array(
	'numberposts' => 3,
	'post_status' => 'publish',
) );

if ( empty( $recent_posts ) ) {
	return;
}
?>

<section id="journal" class="py-20 md:py-32" style="background: var(--deep-navy);">
	<div class="max-w-screen-xl mx-auto px-6">

		<?php dark_matter_section_header(
			'02',
			__( 'Journal', 'dark-matter' ),
			__( 'Thoughts on systems thinking, engineering craft, and the intersection of design and technology.', 'dark-matter' )
		); ?>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
			<?php foreach ( $recent_posts as $post ) :
				setup_postdata( $post );
				dark_matter_render_post_card( $post );
			endforeach;
			wp_reset_postdata();
			?>
		</div>

		<div class="mt-12 text-center fade-in-up">
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn-electric inline-block no-underline" style="font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.75rem 2rem;">
				<?php esc_html_e( 'View All Entries', 'dark-matter' ); ?> &rarr;
			</a>
		</div>
	</div>
</section>