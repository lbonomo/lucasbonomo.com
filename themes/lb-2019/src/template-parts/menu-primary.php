<?php
/**
 * Primary menu
 *
 * @package lb19
 */

$protocol = ( is_ssl() ) ? 'https' : 'http';

if ( isset( $_SERVER['HTTP_HOST'] ) && isset( $_SERVER['REQUEST_URI'] ) ) {
	$current_url = esc_url(
		$protocol . '://' .
		sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) .
		sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) )
	);
} else {
	$current_url = '';
}

if ( has_nav_menu( 'primary' ) ) {
	?>
	<nav class="mdl-navigation">
	<?php
	$menu_location = 'primary';
	$locations     = get_nav_menu_locations();
	$menu_id       = $locations[ $menu_location ];
	$menu_items    = wp_get_nav_menu_items( $menu_id );

	if ( $menu_items ) {
		foreach ( $menu_items as $key => $item ) {
			if ( $current_url === $item->url ) {
				$active = true;
			} else {
				$active = false;
			}
			?>
			<a href="<?php echo esc_url( $item->url ); ?>"
				 class="mdl-navigation__link <?php if ( $active ) { echo 'is-active';} ?> ">
				 <?php echo esc_html( $item->title ); ?>
			 </a>
			<?php
		}
	}
	?>
	</nav>
	<?php
}
?>
