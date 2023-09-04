<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */

?>

<div class="mdl-cell mdl-cell--12-col mdl-shadow--4dp">
	<div class="mdl-grid mdl-cell mdl-cell--12-col post-title">
		<div class="mdl-cell mdl-cell--12-col">
			<h1><?php	the_title(); ?></h1>
		</div>
	</div>

	<div class="mdl-card__supporting-text">
		<?php the_content(); ?>
	</div>

</div>
