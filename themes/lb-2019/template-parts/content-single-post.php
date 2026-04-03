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

<div class="post post-single">
	<div class="post-single-taxonomies">
		<?php
		if ( has_category() ) {
			foreach ( get_the_category() as $category ) {
				echo '<span class="post-category post-single-pill"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></span>';
			}
		}
		if ( has_tag() ) {
			foreach ( get_the_tags() as $post_tag ) {
				echo '<span class="post-tag post-single-pill">
				<a href="' . esc_url( get_tag_link( $post_tag->term_id ) ) . '">' .
				esc_attr( $post_tag->name ) .
				'</a>' .
				'</span>';
			}
		}
		?>
	</div>
	
	<div class="post-single-content">
		<h1 class="post-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>

</div>
