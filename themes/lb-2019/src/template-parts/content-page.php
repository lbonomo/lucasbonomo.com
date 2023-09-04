<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */

?>
<!-- template-parts/content-page.php -->
<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">

	<?php
	if ( ! is_front_page() ) {
		echo '<div class="mdl-card__title">';
		the_title( '<h2 class="">', '</h2>' );
		echo '</div>';
	}
	?>

	<div class="mdl-card__supporting-text">
		<?php the_content(); ?>
	</div>
</div>
<!-- template-parts/content-page.php -->
