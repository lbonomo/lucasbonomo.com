<?php

get_header(); ?>

<?php
if ( have_posts() ) :
	?>
	<div class="max-w-4xl mx-auto px-4 prose">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<div>
			<h1><?php the_title(); ?></h1>
			<?php the_excerpt(); ?>
		</div>
		<?php
	endwhile;
	?>
	</div>
	<!-- Pagination -->
	<div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
		<?php the_posts_pagination(); ?>
	</div>
	<!-- Pagination -->
	<?php
endif;
?>

<?php
get_footer();
