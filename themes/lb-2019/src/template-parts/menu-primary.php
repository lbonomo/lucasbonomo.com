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
	// si el menu principal no existe, no mostrar nada!
	// TODO - Mejorar el codigo. Pasar a PHP con printf o echo.
	// Devuelve booleano Si una ubicación de menú de navegación registrada tiene un menú asignado.
	?>
	<div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">
	<?php
	$menu_location = 'primary';
	$locations     = get_nav_menu_locations();
	$menu_id       = $locations[ $menu_location ];
	$menu_items    = wp_get_nav_menu_items( $menu_id );

	foreach ( $menu_items as $key => $item ) {

		if ( $current_url === $item->url ) {
			$active = true;
		} else {
			$active = false;
		}
		// TODO - Resolver el tema de los submenus.
		?>
		<a href="<?php echo esc_url( $item->url ); ?>"
			 class="mdl-layout__tab mdl-color-text--primary <?php if ( $active ) { echo 'is-active';} ?> ">
			 <?php echo esc_attr($item->title); ?>
		 </a>
		<?php } ?>
	</div>
	<?php
}
?>

<!-- Primary menu -->
