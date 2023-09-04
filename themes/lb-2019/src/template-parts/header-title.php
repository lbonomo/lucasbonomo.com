<?php
/**
 * Header title
 *
 * @package lb19
 */

?>

<div class="mdl-layout__header-row content-logo-row mdl-layout--large-screen-only">
	<span class="mdl-layout__title">
		<?php the_custom_logo(); ?>
		<?php if ( ! has_custom_logo() ) { ?>
			<h1><a class="mdl-color-text--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php }; ?>

	<?php if ( get_bloginfo( 'description' ) !== '' ) { ?>
		<span class="mdl-layout__title"><?php bloginfo( 'description' ); ?></span>
	<?php }; ?>

	</span>
</div>
