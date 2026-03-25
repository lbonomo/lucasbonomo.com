<?php
/**
 * Se usa en "entradas"
 *
 * @package lb19
 */

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

<div class="proyecto-card">

	<?php if ( count( $characteristics ) >= 1 ) : ?>
		<div class="proyecto-card-tags">
		<?php foreach ( $characteristics as $characterist ) : ?>
		<span class="characterist proyecto-card-pill">
			<span><?php echo esc_html( $characterist ); ?></span>
		</span>
		<?php endforeach ?>
	</div>
	<?php endif; ?>

	<div class="proyecto-card-media">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" >
			<?php
				the_post_thumbnail('large', array(
					'class' => 'proyect-image'
				));
			?>
		</a>
	</div>
	<div class="proyecto-card-body">

		<h2 class="proyecto-card-title">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" ><?php the_title(); ?></a>
		</h2>

		
		<!-- <div class="pt-3"><span></span></div> -->

		<div class="proyecto-card-content">
			<?php
			the_excerpt();
			// Categorias y etiquetas.
			if ( has_category() ) {
				foreach ( get_the_category() as $category ) {
					echo '<span class="post-category proyecto-card-pill"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></span>';
				}
			}
			if ( has_tag() ) {
				foreach ( get_the_tags() as $tag_post ) {
					echo '<span class="post-tag proyecto-card-pill"><a href="' . esc_url( get_tag_link( $tag_post->term_id ) ) . '">' . esc_attr( $tag_post->name ) . '</a></span>';
				}
			}

			?>

	</div>
		<div class="proyecto-card-footer">
			<a class="cta"
				href="<?php the_permalink(); ?>" >Leer más</a>
		</div>
	</div>
</div>
