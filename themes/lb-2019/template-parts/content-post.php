<?php
/**
 * Se usa en "entradas"
 *
 * @package lb19
 */

?>

<div class="post-card">
	<div class="post-image post-card-media">
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
		<?php if ( has_category() || has_tag() ) : ?>
			<div class="post-card-taxonomies">
				<?php
				if ( has_category() ) {
					foreach ( get_the_category() as $category ) {
						echo '<span class="card-pill"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></span>';
					}
				}
				if ( has_tag() ) {
					foreach ( get_the_tags() as $tag_post ) {
						echo '<span class="card-pill"><a href="' . esc_url( get_tag_link( $tag_post->term_id ) ) . '">' . esc_attr( $tag_post->name ) . '</a></span>';
					}
				}
				?>
			</div>
		<?php endif; ?>
	</div>
	<div class="post-card-body">

		<h2 class="post-card-title">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" ><?php the_title(); ?></a>
		</h2>
		<div class="post-card-date">
			<span><?php the_modified_date(); ?></span>
		</div>

		<div class="post-card-content">
			<?php
			the_excerpt();
			?>

	</div>
		<div class="post-card-footer">
			<a class="post-card-link"
				href="<?php the_permalink(); ?>" >Leer más</a>
		</div>
	</div>
</div>
