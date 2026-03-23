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
	<nav class="flex flex-wrap items-center gap-3 md:gap-4" aria-label="<?php esc_attr_e( 'Primary menu', 'lb19' ); ?>">
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
				 class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium uppercase tracking-wide text-slate-700 hover:bg-slate-100 hover:text-slate-900 <?php if ( $active ) { echo 'bg-slate-200 text-slate-900';} ?>">
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
