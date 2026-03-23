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
					<!-- Title -->
					<?php get_template_part( 'template-parts/header', 'title' ); ?>
				</div>
	    </header>

			<div class="site-menu w-full border-b border-slate-200 bg-white">
				<div class="mx-auto w-full max-w-7xl px-4 py-3">
				<?php get_template_part( 'template-parts/menu', 'primary' ); ?>
				</div>
			</div>

			<div class="lb19-ribbon bg-[var(--color-primary)]"></div>

			<!-- Contenido principal -->
			<main class="lb19-main flex-1">
