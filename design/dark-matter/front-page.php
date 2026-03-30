<?php
/**
 * Front Page Template
 *
 * @package dark-matter
 */

get_header();

// Hero
get_template_part( 'template-parts/hero' );

// Divider
echo '<div class="section-divider"></div>';

// Services
get_template_part( 'template-parts/services' );

// Divider
echo '<div class="section-divider"></div>';

// CPT Showcase — configure which CPT to display.
// Change 'dm_cpt_slug' to any registered custom post type slug.
set_query_var( 'dm_cpt_slug', 'post' );
set_query_var( 'dm_cpt_section_number', '03' );
set_query_var( 'dm_cpt_title', __( 'Selected Work', 'dark-matter' ) );
set_query_var( 'dm_cpt_subtitle', __( 'A curated selection of recent projects across design, engineering, and creative direction.', 'dark-matter' ) );
set_query_var( 'dm_cpt_count', 3 );
get_template_part( 'template-parts/cpt-showcase' );

// Divider
echo '<div class="section-divider"></div>';

// Latest Posts
get_template_part( 'template-parts/latest-posts' );

// Divider
echo '<div class="section-divider"></div>';

// Contact CTA
get_template_part( 'template-parts/contact-cta' );

get_footer();