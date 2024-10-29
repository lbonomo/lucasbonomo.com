<?php

/**
 * Primary menu
 *
 * @package lb19
 */

?>


<?php
if ( has_nav_menu( 'header' ) ) :
		// si el menu principal no existe, no mostrar nada!
		// TODO - Mejorar el codigo. Pasar a PHP con printf o echo.
		// Devuelve booleano Si una ubicación de menú de navegación registrada tiene un menú asignado.
	?>
			<div id="menu-icon" class="tham tham-e-squeeze tham-w-6">
				<div class="tham-box">
					<div class="tham-inner"></div>
				</div>
			</div>
			<!-- Primary menu -->
			<div id="menu" class="hidden bg-white absolute">
				<?php
				$menu_location = 'header';
				$locations     = get_nav_menu_locations();
				$menu_id       = $locations[ $menu_location ];
				$menu_items    = wp_get_nav_menu_items( $menu_id );
				foreach ( $menu_items as $key => $item ) :
					?>
					<a href="<?php echo esc_url( $item->url ); ?>">
						<?php echo esc_attr( $item->title ); ?>
					</a>
					<?php
				endforeach;
				?>
			</div>
			<!-- Primary menu -->
		<?php
	endif;
