<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */

$has_thumb = has_post_thumbnail();
$card_class = $has_thumb ? 'content-card content-card--split' : 'content-card content-card--full';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $card_class ); ?>>
	<?php if ( $has_thumb ) : ?>
		<div class="content-card__media-wrap">
			<div class="post-image content-card__media">
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<?php
					the_post_thumbnail(
						'medium_large',
						array(
							'class'   => 'article-image',
							'loading' => 'lazy',
						)
					);
					?>
				</a>
			</div>
		</div>
	<?php endif; ?>

	<div class="content-card__body">
		<?php if ( 'post' === get_post_type() && ( has_category() || has_tag() ) ) : ?>
			<div class="content-card__tags">
				<?php
				foreach ( get_the_category() as $category ) {
					echo '<span class="content-pill"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></span>';
				}
				if ( has_tag() ) {
					foreach ( get_the_tags() as $tag_post ) {
						echo '<span class="content-pill"><a href="' . esc_url( get_tag_link( $tag_post->term_id ) ) . '">' . esc_html( $tag_post->name ) . '</a></span>';
					}
				}
				?>
			</div>
		<?php endif; ?>

		<h2 class="content-card__title content-card__title--strong">
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="content-card__meta">
				<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			</div>
		<?php endif; ?>

		<div class="content-card__content">
			<?php the_excerpt(); ?>
		</div>
		<div class="content-card__footer">
			<a class="content-cta" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Leer más', 'lb19' ); ?></a>
		</div>
	</div>
</article>
