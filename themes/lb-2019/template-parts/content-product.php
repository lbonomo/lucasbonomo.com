<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */

?>

<div class="col-span-12 rounded-xl border border-slate-200 bg-white shadow-sm">
	<div class="grid gap-4 p-6 md:p-8 post-title">
		<div>
			<h1><?php	the_title(); ?></h1>
		</div>
	</div>

	<div class="p-6 md:p-8">
		<?php the_content(); ?>
	</div>

</div>
