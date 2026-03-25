<?php
/**
 * Se usa en "entradas"
 *
 * @package lb19
 */

$characteristics = array();
$terms           = get_the_terms( get_the_ID(), 'caracteristica' );

if ( is_array( $terms ) && ! is_wp_error( $terms ) ) {
	$characteristics = array_map(
		function ( $term ) {
			return $term->name;
		},
		$terms
	);
}
?>

<div class="col-span-12 md:col-span-6 grid gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

	<?php if ( count( $characteristics ) >= 1 ) : ?>
		<div class="w-full flex flex-wrap gap-2">
		<?php foreach ( $characteristics as $characterist ) : ?>
		<span class="characterist inline-flex items-center rounded-full border border-slate-300 px-3 py-1 text-xs">
			<span><?php echo esc_html( $characterist ); ?></span>
		</span>
		<?php endforeach ?>
	</div>
	<?php endif; ?>

	<div class="w-full">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" >
			<?php
				the_post_thumbnail('large', array(
					'class' => 'proyect-image'
				));
			?>
		</a>
	</div>
	<div class="w-full">

		<h2 class="text-2xl font-semibold leading-tight">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" ><?php the_title(); ?></a>
		</h2>

		
		<!-- <div class="pt-3"><span></span></div> -->

		<div class="space-y-3 mt-3">
			<?php
			the_excerpt();
			// Categorias y etiquetas.
			if ( has_category() ) {
				foreach ( get_the_category() as $category ) {
					echo '<span class="post-category inline-flex items-center rounded-full border border-slate-300 px-3 py-1 text-xs"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></span>';
				}
			}
			if ( has_tag() ) {
				foreach ( get_the_tags() as $tag_post ) {
					echo '<span class="post-tag inline-flex items-center rounded-full border border-slate-300 px-3 py-1 text-xs"><a href="' . esc_url( get_tag_link( $tag_post->term_id ) ) . '">' . esc_attr( $tag_post->name ) . '</a></span>';
				}
			}

			?>

	</div>
		<div class="flex justify-end">
			<a class="inline-flex items-center rounded-md px-4 py-2 text-sm font-semibold bg-[var(--color-secondary)] text-[var(--color-secondary-text)]"
				href="<?php the_permalink(); ?>" >Leer más</a>
		</div>
	</div>
</div>
