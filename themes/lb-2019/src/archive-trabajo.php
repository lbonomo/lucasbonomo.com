<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */
require get_template_directory() . '/inc/navigation.php';

# Get post tipe in archive file.

get_header();

add_filter( 'pre_get_posts', 'custom_change_portfolio_posts_per_page' );
/**
 * Change Posts Per Page for Portfolio Archive.
 * 
 * @param object $query data
 *
 */
function custom_change_portfolio_posts_per_page( $query ) {

    if ( $query->is_post_type_archive( 'portfolio' ) && ! is_admin() && $query->is_main_query() ) {
          $query->set( 'posts_per_page', '3' );
    }

    return $query;
}


?>

<div class="mdl-grid">
	<?php if (have_posts()) {
	
				echo "<header class='page-header'><h1 class='page-title'>Trabajos</h1></header>";
				$class = ( 0 == get_query_var('paged') ) ? 'grid-trabajos first-page' : 'grid-trabajos';
				echo "<div class='$class'>";
					while (have_posts()) {
						the_post();
						$args = array(
							'fp' => get_query_var('paged'),
						);
						get_template_part('template-parts/content', get_post_type(), $args );
					}
				echo "</div>";
				the_posts_pagination();
				} else {
					get_template_part('template-parts/content', 'none');
				}
		?>

</div>
<!-- #primary -->

<?php
get_footer();
