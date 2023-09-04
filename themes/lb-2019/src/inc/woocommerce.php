<?php
/**
 * Functions and definitions
 *
 * @package lb19
 */

/**
 * Agrego el soporte de WooCommerce al tema.
 */
function lb91_add_woocommerce_support() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 1,
				'min_rows'        => 1,
				'max_rows'        => 1,
				'default_columns' => 2,
				'min_columns'     => 2,
				'max_columns'     => 2,
			),
		)
	);
}
add_action( 'after_setup_theme', 'lb91_add_woocommerce_support' );

// Elimino todos los estilos de WooCoomerce y cargo los propios del Tema
// https://docs.woocommerce.com/document/disable-the-default-stylesheet/.
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Encolo un CSS cuando esta activo WooCommerce.
wp_enqueue_style( 'lb-mercadopago', get_template_directory_uri() . '/css/mercadopago.css', 'woocommerce-mercadopago-basic-checkout-styles', '1.0.0' );
wp_enqueue_style( 'lb-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', 'woocommerce-mercadopago-basic-checkout-styles', '1.0.0' );

// ### Tienda ###
// Elimino el contador de productos.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
// Elimino el formulario de busqueda.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Paginado
// https://docs.woocommerce.com/document/woo_pagination/
// Ver inc/navigation.php.


/**
 * Producto.
 */
function get_title() {
	return apply_filters( 'woocommerce_product_title', $this->get_name(), $this );
};


/**
 * Remove product meta
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

/**
 * Elimino el boton de descripcion
 *
 * @param array $tabs - WooCommerce tabs.
 */
function woo_remove_product_tabs( $tabs ) {
	// TODO - Me gustaria dejar la descripcion, pero eliminar el enlace.
	// Remove the description tab.
	unset( $tabs['description'] );
	return $tabs;
}

/**
 * Remove image Zoom in store
 */
function remove_image_zoom_support() {
	remove_theme_support( 'wc-product-gallery-zoom' );
	remove_theme_support( 'wc-product-gallery-lightbox' );
	remove_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

/**
 * Remove image Zoom
 *
 * @param string  $html - No recuerdo de que se trata.
 * @param integer $post_id - The ID of the product.
 */
function custom_unlink_single_product_image( $html, $post_id ) {
	return get_the_post_thumbnail( $post_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
}
add_filter( 'woocommerce_single_product_image_html', 'custom_unlink_single_product_image', 10, 2 );

/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
