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

	<div class="post col-span-12 rounded-xl border border-slate-200 bg-white shadow-sm">
		<div class="grid gap-6 p-6 md:p-8 post-title">
			<div>
				<h1><?php the_title(); ?></h1>
			</div>

			<?php if ( count( $characteristics ) >= 1 ) : ?>
			<div class="w-full flex flex-wrap gap-2">
				<?php foreach ( $characteristics as $characterist ) : ?>
					<span class="characterist inline-flex items-center rounded-full border border-slate-300 px-3 py-1 text-xs">
						<span><?php echo esc_html( $characterist ); ?></span>
					</span>
				<?php endforeach ?>
			</div>
			<?php endif; ?>

			<div>
				<a href="<?php echo esc_url( $fields['url'] ); ?>" target="_blank" rel="noopener noreferrer">
					<?php the_post_thumbnail('large', array( 'class' => 'proyect-image' )); ?>
				</a>
			</div>

			<div class="w-full text-right">
				<!-- <span class="post-date"> <?php echo esc_html( get_the_date() ); ?></span> -->
			</div>

			<div>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
