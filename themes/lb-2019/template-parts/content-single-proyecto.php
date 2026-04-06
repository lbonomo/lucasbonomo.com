<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */

$fields          = get_fields();
$characteristics = array();
$terms           = get_the_terms( get_the_ID(), 'caracteristica' );

// var_dump($fields);

if ( is_array( $terms ) && ! is_wp_error( $terms ) ) {
	$characteristics = array_map(
		function ( $term ) {
			return $term->name;
		},
		$terms
	);
}

?>

<!-- template-parts/content-single.php -->

	<div class="post-single">
		<div>
			<h1><?php the_title(); ?></h1>
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
			<?php the_post_thumbnail( 'large', array( 'class' => 'proyect-image' ) ); ?>

			<?php if ( ! empty( $fields['status'] )  && 'On-line' === $fields['status'] ) : ?>
				<a class="content-cta" href="<?php echo esc_url( $fields['url'] ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Visit project', 'lb19' ); ?>
				</a>
			<?php endif; ?>
		</div>


		<div>
			<?php the_content(); ?>
		</div>
	</div>
