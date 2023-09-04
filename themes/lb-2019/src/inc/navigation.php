<?php
/**
 * Post Navigation
 *
 * @package lb19
 */

/**
 * Post Navigation butons
 *
 * Imprime la barra de navegacion entre paginas
 */
function mdl_the_posts_navigation() {
	echo '<!-- mdl_the_posts_navigation -->';
	echo '<nav class="post-nav mdl-cell mdl-cell--12-col mdl-grid">';
	next_posts_link( '<button class="mdl-button mdl-js-button mdl-button--fab mdl-color--secondary"><i class="material-icons mdl-color-text--secondary" role="presentation">navigate_before</i></button>' );
	echo '<div class="mdl-layout-spacer"></div>';
	previous_posts_link( '<button class="mdl-button mdl-js-button  mdl-button--fab mdl-color--secondary"><i class="material-icons mdl-color-text--secondary" role="presentation">navigate_next</i></button>' );
	echo '</nav>';
	echo '<!-- mdl_the_posts_navigation -->';

}
