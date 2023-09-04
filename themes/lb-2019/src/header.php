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
	<meta name="apple-mobile-web-app-title" content="Material Design Lite">
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

		div.post.mdl-cell {

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
<body class="mdl-lb19 mdl-color--grey-100 mdl-color-text--grey-900 mdl-base">

	<div class="mdl-layout__container has-scrolling-header">

		<div <?php body_class('mdl-layout mdl-js-layout mdl-layout--fixed-header'); ?> >

			<header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
				<div class="lb19-brand">
					<!-- Separador  -->
					<div class="mdl-layout--large-screen-only mdl-layout__header-row"></div>
					<!-- Separador  -->

					<!-- Title -->
					<?php get_template_part( 'template-parts/header', 'title' ); ?>
					<!-- Title -->

					<!-- Separador  -->
		      <div class="mdl-layout--large-screen-only mdl-layout__header-row"></div>
					<!-- Separador  -->
				</div>

				<!-- Primary menu -->
				<?php get_template_part( 'template-parts/menu', 'primary' ); ?>
				<!-- Primary menu -->

	    </header>

			<div class="lb19-ribbon mdl-color--primary-contrast"></div>

			<!-- Contenido principal -->
			<main class="lb19-main mdl-layout__content ">
