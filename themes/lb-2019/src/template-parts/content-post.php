<?php
/**
 * Se usa en "entradas"
 *
 * @package lb19
 */

?>

<div class="mdl-grid mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
	<div class="mdl-card__media mdl-cell mdl-cell--12-col-tablet post-image">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" >
			<img
				class="article-image"
				src="
				<?php
				if ( has_post_thumbnail() ) {
						the_post_thumbnail_url( 'thumbnail' );
				}
				?>
				"
				alt=""
				border="0">
		</a>
	</div>
	<div class="mdl-cell mdl-cell--8-col">

		<h4 class="mdl-card__title-text">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" ><?php the_title(); ?></a>
		</h4>
		<div class="mdl-card__supporting-text padding-top">
			<span><?php the_modified_date(); ?></span>
		</div>

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
