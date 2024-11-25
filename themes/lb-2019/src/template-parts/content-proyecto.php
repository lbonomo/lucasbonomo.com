<?php
/**
 * Se usa en "entradas"
 *
 * @package lb19
 */

$characteristics = array_map(
	fn($term) => $term->name,
	get_the_terms(get_the_ID(), 'caracteristica')
);
?>

<div class="mdl-grid mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet mdl-card mdl-shadow--4dp">

	<?php if ( count($characteristics) >= 1 ) : ?>
		<div class="characteristics">
		<?php foreach ( $characteristics as $characterist ) : ?>
			<span class="mdl-chip characterist">
				<span class="mdl-chip__text"><?php echo $characterist; ?></span>
			</span>
		<?php endforeach ?>
	</div>
	<?php endif; ?>

	<div class="mdl-cell mdl-cell--12-col">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" >
			<?php
				the_post_thumbnail('large', array(
					'class' => 'proyect-image'
				));
			?>
	</div>
	<div class="mdl-cell mdl-cell--12-col">

		<h2 class="mdl-card__title-text">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" ><?php the_title(); ?></a>
		</h2>

		
		<!-- <div class="mdl-card__supporting-text padding-top"><span></span></div> -->

		<div class="mdl-card__supporting-text no-left-padding">
			<?php
			the_excerpt();
			// Categorias y etiquetas.
			if ( has_category() ) {
				foreach ( get_the_category() as $category ) {
					echo '<span class="mdl-chip post-category"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '"><span class="mdl-chip__text">' . esc_html( $category->name ) . '</span></a></span>';
				}
			}
			if ( has_tag() ) {
				foreach ( get_the_tags() as $tag_post ) {
					echo '<span class="mdl-chip post-tag"><a href="' . esc_url( get_tag_link( $tag_post->term_id ) ) . '"><span class="mdl-chip__text">' . esc_attr( $tag_post->name ) . '</span></a></span>';
				}
			}

			?>

	</div>
		<div class="mdl-card__actions mdl-grid">
			<div class="mdl-layout-spacer"></div>
			<a class="mdl-button mdl-js-button mdl-button--raised mdl-color--secondary mdl-color-text--secondary"
				href="<?php the_permalink(); ?>" >Leer más</a>
		</div>
	</div>
</div>
