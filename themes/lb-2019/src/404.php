<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package lb19
 */

get_header();
?>
	<div class="mdl-grid content-max-width">
		<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
			<h1 class="not-found"><?php echo __('Oops! That page can’t be found.', 'lb19') ?></h1>
			<p class="not-found"><?php echo __('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'lb19') ?><p>
		</div>
	</div><!-- #primary -->
<?php
get_footer();
