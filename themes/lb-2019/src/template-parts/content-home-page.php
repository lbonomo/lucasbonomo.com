<?php
/**
 * Template part for displaying the Home Page content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */

?>
<!-- template-parts/content-home-page.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'home-page-template__article mdl-cell mdl-cell--12-col' ); ?>>
	<div class="home-page-template__content">
		<?php
			the_content();
		?>
	</div>
</article>
<!-- template-parts/content-home-page.php -->
