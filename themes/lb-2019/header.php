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
<body <?php body_class( 'lb19 bg-slate-100 text-slate-900 min-h-screen' ); ?>>
<?php wp_body_open(); ?>


<div class="has-scrolling-header min-h-screen flex flex-col">

		<div class="min-h-screen flex flex-col">

			<header class="site-header bg-[var(--color-primary)] text-[var(--color-primary-text)] sticky top-0 z-40 shadow-sm">
				<div class="mx-auto w-full max-w-7xl px-4 py-4">
					<div class="flex items-center justify-between">
						<!-- Logo on the left -->
						<div class="flex-shrink-0">
							<?php get_template_part( 'template-parts/header', 'title' ); ?>
						</div>

						<!-- Menu on the right (hidden on mobile) -->
						<div class="hidden md:block">
							<?php get_template_part( 'template-parts/menu', 'primary' ); ?>
						</div>

						<!-- Mobile menu button -->
						<button class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-current hover:bg-white hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
								aria-expanded="false"
								aria-controls="mobile-menu"
								id="mobile-menu-button">
							<span class="sr-only"><?php esc_html_e( 'Open menu', 'lb19' ); ?></span>
							<!-- Hamburger icon -->
							<svg class="hamburger-icon block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
							</svg>
							<!-- Close icon (X) -->
							<svg class="close-icon hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
					</div>

					<!-- Mobile menu (hidden by default) -->
					<div id="mobile-menu" class="hidden md:hidden mt-4 border-t border-white border-opacity-20 pt-4">
						<?php get_template_part( 'template-parts/menu', 'primary' ); ?>
					</div>
				</div>
	    </header>

			<div class="lb19-ribbon bg-[var(--color-primary)]"></div>

			<!-- Contenido principal -->
			<main class="lb19-main flex-1">
