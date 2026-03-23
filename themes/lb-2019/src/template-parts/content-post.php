<?php
/**
 * Se usa en "entradas"
 *
 * @package lb19
 */

?>

<div class="col-span-12 grid gap-6 rounded-xl border border-slate-200 bg-white p-4 shadow-sm md:grid-cols-12">
	<div class="post-image md:col-span-4">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" >
			<img
				class="article-image"
				src="
				<?php
				if ( has_post_thumbnail() ) {
						the_post_thumbnail_url( 'thumbnail' );
				}
				?>
				"
				alt=""
				border="0">
		</a>
	</div>
	<div class="md:col-span-8 flex flex-col gap-4">

		<h4 class="text-2xl font-semibold leading-tight">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" ><?php the_title(); ?></a>
		</h4>
		<div class="pt-1 text-sm text-slate-500">
			<span><?php the_modified_date(); ?></span>
		</div>

		<div class="space-y-3">
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
