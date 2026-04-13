<?php
/**
 * Render callback for the services grid block.
 *
 * @package SimpleService
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$selected_service_ids = array_values(
	array_filter(
		array_map( 'absint', isset( $attributes['selectedServiceIds'] ) ? (array) $attributes['selectedServiceIds'] : array() )
	)
);

if ( empty( $selected_service_ids ) ) {
	return;
}

$services = get_posts(
	array(
		'post_type'      => 'service',
		'post_status'    => 'publish',
		'posts_per_page' => count( $selected_service_ids ),
		'post__in'       => $selected_service_ids,
		'orderby'        => 'post__in',
	)
);

if ( empty( $services ) ) {
	return;
}

$card_height = isset( $attributes['cardHeight'] ) ? (int) $attributes['cardHeight'] : 160;
$card_height = max( 160, min( 700, $card_height ) );
$title_font_size = isset( $attributes['titleFontSize'] ) ? (int) $attributes['titleFontSize'] : 23;
$title_font_size = max( 12, min( 72, $title_font_size ) );
$description_font_size = isset( $attributes['descriptionFontSize'] ) ? (int) $attributes['descriptionFontSize'] : 16;
$description_font_size = max( 12, min( 72, $description_font_size ) );
$font_color = isset( $attributes['fontColor'] ) ? sanitize_hex_color( $attributes['fontColor'] ) : '#0f172a';
$card_background = isset( $attributes['cardBackground'] ) ? sanitize_hex_color( $attributes['cardBackground'] ) : '#ffffff';

if ( ! $font_color ) {
	$font_color = '#0f172a';
}

if ( ! $card_background ) {
	$card_background = '#ffffff';
}

$style_vars = sprintf(
	'--simple-service-card-height:%1$dpx;--simple-service-title-font-size:%2$dpx;--simple-service-description-font-size:%3$dpx;--simple-service-font-color:%4$s;--simple-service-card-background:%5$s;',
	$card_height,
	$title_font_size,
	$description_font_size,
	$font_color,
	$card_background
);

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'simple-service-grid',
		'style' => $style_vars,
	)
);

?>
<div <?php echo wp_kses_data( $wrapper_attributes ); ?>>
	<?php foreach ( $services as $service ) : ?>
		<?php
		$service_id               = $service->ID;
		$service_title            = get_the_title( $service_id );
		$service_content          = (string) get_post_field( 'post_content', $service_id );
		$service_content_trimmed  = trim( wp_strip_all_tags( $service_content ) );
		$service_excerpt          = has_excerpt( $service_id ) ? get_the_excerpt( $service_id ) : wp_trim_words( wp_strip_all_tags( $service_content ), 24 );
		$service_long_description = $service_content_trimmed ? wp_kses_post( wpautop( $service_content ) ) : '<p>' . esc_html( $service_excerpt ) . '</p>';
		$service_image            = get_the_post_thumbnail( $service_id, 'large', array( 'class' => 'simple-service-grid__image' ) );
		?>
		<article class="simple-service-grid__card" tabindex="0">
			<div class="simple-service-grid__card-inner">
				<div class="simple-service-grid__face simple-service-grid__face--front">
					<div class="simple-service-grid__layer-3d simple-service-grid__layer-3d--front">
						<?php if ( $service_image ) : ?>
							<div class="simple-service-grid__media">
								<?php echo $service_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						<?php endif; ?>
						<h3 class="simple-service-grid__title"><?php echo esc_html( $service_title ); ?></h3>
					</div>
				</div>
				<div class="simple-service-grid__face simple-service-grid__face--back">
					<div class="simple-service-grid__layer-3d simple-service-grid__layer-3d--back">
						<div class="simple-service-grid__long-description">
							<?php echo $service_long_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					</div>
				</div>
			</div>
		</article>
	<?php endforeach; ?>
</div>
<?php
