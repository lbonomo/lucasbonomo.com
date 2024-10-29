<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lucas_2025
 */

?>

<header class="inset-x-0 top-0 z-50 sticky bg-white border-b-2 mb-3">
	<div class="max-w-4xl m-auto">
		<!-- <nav class="relative px-4 py-4 flex justify-between items-center bg-white"> -->
		<nav class="mx-auto flex items-center justify-between p-2 lg:px-8">
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
	</div>
</header>