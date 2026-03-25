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
	echo '<nav class="post-nav col-span-12 grid grid-cols-2 gap-4 items-center">';
	next_posts_link( '<span class="inline-flex items-center justify-center rounded-full px-4 py-2 text-sm font-medium bg-[var(--color-secondary)] text-[var(--color-secondary-text)]">←</span>' );
	echo '<div class="justify-self-center"></div>';
	previous_posts_link( '<span class="inline-flex items-center justify-center rounded-full px-4 py-2 text-sm font-medium bg-[var(--color-secondary)] text-[var(--color-secondary-text)]">→</span>' );
	echo '</nav>';
	echo '<!-- mdl_the_posts_navigation -->';

}
