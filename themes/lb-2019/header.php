<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="icon" sizes="192x192" href="<?php echo get_template_directory_uri() ?>/assets/images/android-desktop.png">

	<!-- Add to homescreen for Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="LB19">
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri() ?>/assets/images/ios-desktop.png">

	<!-- Tile icon for Win8 (144x144 + tile color) -->
	<meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
	<meta name="msapplication-TileColor" content="#3372DF">
	<link rel="shortcut icon" href="images/favicon.png">


	<style>
	#view-source {
		position: fixed;
		display: block;
		right: 0;
		bottom: 0;
		margin-right: 40px;
		margin-bottom: 40px;
		z-index: 900;
	}

	<?php
	if ( is_single() ) { echo "

		.lb19-main {
			margin-top: -35vh;
			flex-shrink: 0;
		}

		div.lb19-brand {
			display: none;
		}

		div.lb19-ribbon {
			width: 100%;
	    height: 40vh;
	    -webkit-flex-shrink: 0;
	    -ms-flex-negative: 0;
	    flex-shrink: 0;
		}

		div.post {

		}

	"; } else {
				echo "
				div.lb19-ribbon {
					display: none;
				}";
	}
	;
	?>

</style>


<?php wp_head(); ?>

</head>
<body <?php body_class( 'lb19 lb19-body' ); ?>>
<?php wp_body_open(); ?>


<div class="has-scrolling-header lb19-layout-root">

		<div class="lb19-layout-shell">

			<header class="site-header site-header--sticky">
				<div class="site-header-container">
					<div class="site-header-row">
						<!-- Logo on the left -->
						<div class="site-brand-wrap">
							<?php get_template_part( 'template-parts/header', 'title' ); ?>
						</div>

						<!-- Menu on the right (hidden on mobile) -->
						<div class="site-nav-desktop">
							<?php get_template_part( 'template-parts/menu', 'primary' ); ?>
						</div>

						<!-- Mobile menu button -->
						<button class="menu-toggle site-menu-toggle"
								aria-expanded="false"
								aria-label="<?php esc_attr_e( 'Open menu', 'lb19' ); ?>"
								data-open-label="<?php esc_attr_e( 'Open menu', 'lb19' ); ?>"
								data-close-label="<?php esc_attr_e( 'Close menu', 'lb19' ); ?>"
								aria-controls="mobile-menu"
								id="mobile-menu-button">
							<span id="mobile-menu-label" class="screen-reader-text"><?php esc_html_e( 'Open menu', 'lb19' ); ?></span>
							<!-- Hamburger icon -->
							<svg class="hamburger-icon menu-toggle-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
							</svg>
							<!-- Close icon (X) -->
							<svg class="close-icon menu-toggle-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
					</div>

					<!-- Mobile menu (hidden by default) -->
					<div id="mobile-menu" class="site-mobile-menu is-hidden">
						<?php get_template_part( 'template-parts/menu', 'primary' ); ?>
					</div>
				</div>
	    </header>

			<div class="lb19-ribbon"></div>

			<!-- Contenido principal -->
			<main class="lb19-main lb19-main-content">
