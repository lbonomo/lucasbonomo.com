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
	echo '<nav class="post-nav">';
	next_posts_link( '<span class="post-nav__button">←</span>' );
	echo '<div class="post-nav__spacer"></div>';
	previous_posts_link( '<span class="post-nav__button">→</span>' );
	echo '</nav>';
	echo '<!-- mdl_the_posts_navigation -->';

}
