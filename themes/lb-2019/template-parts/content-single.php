<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */

?>

<!-- template-parts/content-single.php -->

<div class="post-single">
	<div class="p-6 md:p-8">
		<?php the_content(); ?>
	</div>

	<div class="flex flex-wrap items-center gap-2 px-6 pb-6 md:px-8 md:pb-8">
		<?php
		if ( has_category() ) {
			foreach ( get_the_category() as $category ) {
				echo '<span class="post-category inline-flex items-center rounded-full border border-slate-300 px-3 py-1 text-xs"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></span>';
			}
		}
		if ( has_tag() ) {
			foreach ( get_the_tags() as $tag_item ) {
				echo '<span class="post-tag inline-flex items-center rounded-full border border-slate-300 px-3 py-1 text-xs"><a href="' . esc_url( get_tag_link( $tag_item->term_id ) ) . '">' . esc_attr( $tag_item->name ) . '</a></span>';
			}
		}
		?>
		<span class="ml-auto text-sm text-slate-500"><?php lb19_posted_by(); ?></span>
	</div>
</div>
