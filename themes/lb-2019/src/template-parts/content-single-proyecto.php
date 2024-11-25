<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lb19
 */

$fields          = get_fields();
$characteristics = array_map(
	fn($term) => $term->name,
	get_the_terms(get_the_ID(), 'caracteristica')
);

?>

<!-- template-parts/content-single.php -->

				<div class="post mdl-cell mdl-cell--12-col mdl-shadow--4dp">
					<div class="mdl-grid mdl-cell mdl-cell--12-col post-title">
						<div class="mdl-cell mdl-cell--12-col">
							<h1><?php the_title(); ?></h1>
						</div>

						<?php if ( count($characteristics) >= 1 ) : ?>
						<div class="mdl-cell--12-col">
							<div class="mdl-layout-spacer"></div>
							<?php foreach ( $characteristics as $characterist ) : ?>
								<span class="mdl-chip characterist">
									<span class="mdl-chip__text"><?php echo $characterist; ?></span>
								</span>
							<?php endforeach ?>
						</div>
						<?php endif; ?>

						<div class="mdl-cell mdl-cell--12-col">
							<a href="<?php echo $fields['url']; ?>" target="_blank" rel="noopener noreferrer">
								<?php the_post_thumbnail('large', array( 'class' => 'proyect-image' )); ?>
							</a>
						</div>

						<div class="mdl-grid mdl-cell mdl-cell--12-col">
							<div class="mdl-layout-spacer"></div>
							<!-- <span class="post-date"> <?php echo esc_html( get_the_date() ); ?></span> -->
						</div>


						<div class="mdl-card__supporting-text">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
