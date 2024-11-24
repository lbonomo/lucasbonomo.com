<?php
/**
 * WPO de Carga condicional.
 * https://lucasbonomo.com/thunderbird/.
 *
 * @package WordPress.
 */

// Evito los problemas con los POST (como el de WooCommerce).
if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

	$request_uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );

	// Esto afecta a todas las entradas "/entradas/*".
	if ( preg_match( '/\/entradas\/*\//', $request_uri ) ) {
		$request_uri = '/entradas/';
	}


	if ( preg_match( '/\/proyectos\/*\//', $request_uri ) ) {
		$request_uri = '/proyectos/';
	}

	switch ( $request_uri ) {

		case '/':
			add_filter( 'option_active_plugins', 'wpo_home', 1 );
			break;

		case '/entradas/':
			add_filter( 'option_active_plugins', 'wpo_entradas', 1 );
			break;

		case '/thunderbird/':
			add_filter( 'option_active_plugins', 'wpo_thunderbird', 1 );
			break;

		case '/proyectos/':
			add_filter( 'option_active_plugins', 'wpo_proyectos', 1 );
			break;
	}
}

/** Filter plugins Home.
 * Ojo, no carga ningun plugin nuevo.
 */
function wpo_home() {
	$plugin_list = array(
		'promotore-simple-analytics/promotore-simple-analytics.php',
		'tua-forma/tua-forma.php',
		'seo-by-rank-math/rank-math.php',
		'simple-social-icons/simple-social-icons.php',
	);
	return $plugin_list;
}

/** Filter plugins /entradas.
 */
function wpo_entradas() {
	$plugin_list = array(
		'promotore-simple-analytics/promotore-simple-analytics.php',
		'seo-by-rank-math/rank-math.php',
		'simple-social-icons/simple-social-icons.php',
	);
	return $plugin_list;
}

/** Filter plugins /thunderbird.
 */
function wpo_thunderbird() {
	$plugin_list = array(
		'promotore-simple-analytics/promotore-simple-analytics.php',
		'tua-forma/tua-forma.php',
		'seo-by-rank-math/rank-math.php',
		'simple-social-icons/simple-social-icons.php',
		'envira-gallery-lite/envira-gallery-lite.php',
	);
	return $plugin_list;
}


/** Filter plugins /proyectos/*.
 */
function wpo_proyectos($plugin_list) {
	$plugin_list = array(
		'tua-forma/tua-forma.php',
		'seo-by-rank-math/rank-math.php',
		'envira-gallery-lite/envira-gallery-lite.php',
		'advanced-custom-fields-pro/acf.php',
		'promotore-simple-analytics/promotore-simple-analytics.php'
	);
	return $plugin_list;
}

/** Filter plugins.
 *
 * @param array $plugin_list Lista de plugins a filtrar.
 */
function wpo_log( $plugin_list ) {
	error_log( 'plugin_list: ' . print_r($plugin_list, true) );
	error_log( 'request_uri: ' . $request_uri );
	// unset($plugin_list["model"]);
	return $plugin_list;
}
