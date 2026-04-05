<?php
/**
 * Se usa en "entradas"
 *
 * @package lb19
 */

?>

<div class="content-card content-card--split">
	<div class="content-card__media-wrap">
		<div class="post-image content-card__media">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" >
				<img
					class="article-image"
					src="
					<?php
					if ( has_post_thumbnail() ) {
							the_post_thumbnail_url( 'small' );
					}
					?>
					"
					alt=""
					border="0">
			</a>
		</div>
		<?php if ( has_category() || has_tag() ) : ?>
			<div class="content-card__tags content-card__tags--truncate">
				<?php
				if ( has_category() ) {
					foreach ( get_the_category() as $category ) {
						echo '<span class="content-pill"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></span>';
					}
				}
				if ( has_tag() ) {
					foreach ( get_the_tags() as $tag_post ) {
						echo '<span class="content-pill"><a href="' . esc_url( get_tag_link( $tag_post->term_id ) ) . '">' . esc_attr( $tag_post->name ) . '</a></span>';
					}
				}
				?>
			</div>
		<?php endif; ?>
	</div>
	<div class="content-card__body">

		<h2 class="content-card__title content-card__title--strong">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" ><?php the_title(); ?></a>
		</h2>
		<div class="content-card__meta">
			<span><?php the_modified_date(); ?></span>
		</div>

		<div class="content-card__content">
			<?php
			the_excerpt();
			?>

	</div>
		<div class="content-card__footer">
			<a class="content-cta"
				href="<?php the_permalink(); ?>" >Leer más</a>
		</div>
	</div>
</div>
