<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */

?>

<!-- template-parts/content-single-post.php -->

<div class="post mdl-cell mdl-cell--12-col mdl-shadow--4dp">

	<?php	if ( ! is_front_page() ) { ?>
		<div class="mdl-grid mdl-cell mdl-cell--12-col post-title">
			<div class="mdl-cell mdl-cell--12-col">
				<h1><?php	the_title(); ?></h1>
			</div>
		</div>

		<div class="mdl-grid mdl-cell mdl-cell--12-col">
			<span class="post-date"> <?php echo esc_html( get_the_date() ); ?></span>
			<div class="mdl-layout-spacer"></div>
			<?php lb19_posted_by(); ?>
		</div>

	<?php	} ?>

	<div class="mdl-card__supporting-text">
		<?php the_content(); ?>
	</div>

	<div class="mdl-card__actions mdl-grid">
		<?php
		if ( has_category() ) {
			foreach ( get_the_category() as $category ) {
				echo '<span class="mdl-chip post-category"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '"><span class="mdl-chip__text">' . esc_html( $category->name ) . '</a></span>';
			}
		}
		if ( has_tag() ) {
			foreach ( get_the_tags() as $post_tag ) {
				echo '<span class="mdl-chip post-tag">
				<a href="' . esc_url( get_tag_link( $post_tag->term_id ) ) . '">' .
				'<span class="mdl-chip__text">' . esc_attr( $post_tag->name ) . '</span>' .
				'</a>' .
				'</span>';
			}
		}
		?>
	</div>
</div>
