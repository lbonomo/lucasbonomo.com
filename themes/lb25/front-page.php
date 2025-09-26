<?php
/**
 * Main entry point for the application
 * @package    LB25
 * @author     Lucas Bonomo <bonomo.lucas@gmail.com>
 */

get_header();
the_post();

?>

<div class="">
	<?php the_content(); ?>
</div>


<?php get_footer(); ?>