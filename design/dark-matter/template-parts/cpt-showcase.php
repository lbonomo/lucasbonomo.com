<?php
/**
 * Template Part: CPT Showcase
 *
 * Dynamically queries a registered custom post type.
 *
 * Usage in templates:
 *   set_query_var( 'dm_cpt_slug', 'project' );
 *   set_query_var( 'dm_cpt_section_number', '03' );
 *   set_query_var( 'dm_cpt_title', 'Selected Work' );
 *   set_query_var( 'dm_cpt_subtitle', 'Recent projects...' );
 *   set_query_var( 'dm_cpt_count', 4 );
 *   get_template_part( 'template-parts/cpt-showcase' );
 *
 * @package dark-matter
 */

$cpt_slug   = get_query_var( 'dm_cpt_slug', 'post' );
$section_no = get_query_var( 'dm_cpt_section_number', '03' );
$title      = get_query_var( 'dm_cpt_title', __( 'Selected Work', 'dark-matter' ) );
$subtitle   = get_query_var( 'dm_cpt_subtitle', '' );
$count      = absint( get_query_var( 'dm_cpt_count', 4 ) );

if ( ! post_type_exists( $cpt_slug ) && 'post' !== $cpt_slug ) {
	return;
}

$cpt_posts = get_posts( array(
	'post_type'   => $cpt_slug,
	'numberposts' => $count,
	'post_status' => 'publish',
) );

if ( empty( $cpt_posts ) ) {
	return;
}

$columns = $count >= 3 ? 'md:grid-cols-3' : 'md:grid-cols-2';
?>

<section id="work" class="py-20 md:py-32" style="background: var(--void);">
	<div class="max-w-screen-xl mx-auto px-6">

		<?php dark_matter_section_header( $section_no, $title, $subtitle ); ?>

		<div class="grid grid-cols-1 <?php echo esc_attr( $columns ); ?> gap-6">
			<?php foreach ( $cpt_posts as $cpt_post ) :
				dark_matter_render_cpt_card( $cpt_post );
			endforeach; ?>
		</div>
	</div>
</section>