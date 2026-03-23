<?php
/**
 * Custom Nav Menu Walkers
 *
 * @package dark-matter
 */

if ( ! class_exists( 'Dark_Matter_Nav_Walker' ) ) {
	class Dark_Matter_Nav_Walker extends Walker_Nav_Menu {
		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$output .= '<a href="' . esc_url( $item->url ) . '" class="nav-link text-xs tracking-wider uppercase no-underline transition-colors duration-200" style="color: var(--muted-grey);">';
			$output .= esc_html( $item->title );
			$output .= '</a>';
		}

		public function end_el( &$output, $item, $depth = 0, $args = null ) {
			// No wrapping li needed.
		}
	}
}

if ( ! class_exists( 'Dark_Matter_Mobile_Nav_Walker' ) ) {
	class Dark_Matter_Mobile_Nav_Walker extends Walker_Nav_Menu {
		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			$output .= '<a href="' . esc_url( $item->url ) . '" class="text-xs tracking-wider uppercase no-underline block py-2" style="color: var(--muted-grey); border-bottom: 1px solid var(--border-subtle);">';
			$output .= esc_html( $item->title );
			$output .= '</a>';
		}

		public function end_el( &$output, $item, $depth = 0, $args = null ) {
			// No wrapping li needed.
		}
	}
}

if ( ! function_exists( 'dark_matter_fallback_menu' ) ) {
	function dark_matter_fallback_menu() {
		$links = array(
			'#services' => __( 'Services', 'dark-matter' ),
			'#work'     => __( 'Work', 'dark-matter' ),
			'#journal'  => __( 'Journal', 'dark-matter' ),
			'#about'    => __( 'About', 'dark-matter' ),
		);
		foreach ( $links as $href => $label ) {
			echo '<a href="' . esc_url( $href ) . '" class="nav-link text-xs tracking-wider uppercase no-underline transition-colors duration-200" style="color: var(--muted-grey);">' . esc_html( $label ) . '</a>';
		}
	}
}

if ( ! function_exists( 'dark_matter_fallback_mobile_menu' ) ) {
	function dark_matter_fallback_mobile_menu() {
		echo '<div class="flex flex-col gap-4 pt-4">';
		$links = array(
			'#services' => __( 'Services', 'dark-matter' ),
			'#work'     => __( 'Work', 'dark-matter' ),
			'#journal'  => __( 'Journal', 'dark-matter' ),
			'#about'    => __( 'About', 'dark-matter' ),
		);
		foreach ( $links as $href => $label ) {
			echo '<a href="' . esc_url( $href ) . '" class="text-xs tracking-wider uppercase no-underline block py-2" style="color: var(--muted-grey); border-bottom: 1px solid var(--border-subtle);">' . esc_html( $label ) . '</a>';
		}
		echo '</div>';
	}
}