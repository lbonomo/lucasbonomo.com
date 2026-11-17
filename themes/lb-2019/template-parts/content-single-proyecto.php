<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */

$fields          = function_exists( 'get_fields' ) ? get_fields() : array();
$characteristics = array();
$terms           = get_the_terms( get_the_ID(), 'caracteristica' );

if ( is_array( $terms ) && ! is_wp_error( $terms ) ) {
	$characteristics = array_map(
		function ( $term ) {
			return $term->name;
		},
		$terms
	);
}

?>

<!-- template-parts/content-single-proyecto.php -->

	<div class="post-single">
		<div>
			<h1 class="post-title"><?php the_title(); ?></h1>
		</div>

		<?php if ( count( $characteristics ) >= 1 ) : ?>
		<div class="content-panel__tags">
			<?php foreach ( $characteristics as $characterist ) : ?>
				<span class="characterist content-pill">
					<span><?php echo esc_html( $characterist ); ?></span>
				</span>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<div class="project-image-wrappr">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'large', array( 'class' => 'proyect-image' ) );
			}
			?>

			<?php if ( ! empty( $fields['status'] ) && 'On-line' === $fields['status'] && ! empty( $fields['url'] ) ) : ?>
				<div class="project-live-action">
					<a class="content-cta" href="<?php echo esc_url( $fields['url'] ); ?>" target="_blank" rel="noopener noreferrer">
						<?php esc_html_e( 'Ver proyecto en vivo', 'lb19' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>


		<div class="proyecto-single-content content-panel__body--compact">
			<?php the_content(); ?>
		</div>
	</div>
