<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="inset-x-0 top-0 z-50">
		<!-- <nav class="relative px-4 py-4 flex justify-between items-center bg-white"> -->
		<nav class="mx-auto flex max-w-7xl items-center justify-between p-2 lg:px-8">
		<!-- <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800"> -->
			<?php
			if ( has_site_icon() ) :
				?>
				<a href="<?php echo esc_url( get_site_url() ); ?>">
					<img src="<?php echo esc_url( get_site_icon_url() ); ?>" class="site-icon"/>
				</a>
				<?php
			endif;
			?>
			
			<!-- Custom search form -->
			<form role="search" method="get" class="search-form" action="https://lucasbonomo.lndo.site/">
				<input type="search" class="search-field" placeholder="Buscar…" value="" name="s">
			</form>
			<!-- Custom search form -->

			<?php
			get_template_part( 'template-parts/menu', 'header' );
			?>
		</nav>
	</header>
