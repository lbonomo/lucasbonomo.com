<?php
/**
 * Setup deterministic fixtures for Services Grid block tests.
 *
 * Run with:
 * lando wp --path=/app/wordpress eval-file /app/wordpress/wp-content/plugins/simple-service/tests/fixtures/setup-service-block-fixtures.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	echo "This script must run inside WordPress context.\n";
	exit( 1 );
}

/**
 * Create or reuse an attachment from raw image bytes.
 *
 * @param string $slug     Attachment slug.
 * @param string $filename Attachment filename.
 * @param string $bytes    Binary image contents.
 * @return int
 */
function simple_service_test_upsert_attachment( $slug, $filename, $bytes ) {
	$existing = get_page_by_path( $slug, OBJECT, 'attachment' );

	if ( $existing ) {
		return (int) $existing->ID;
	}

	$upload = wp_upload_bits( $filename, null, $bytes );

	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}

	$attachment_id = wp_insert_attachment(
		array(
			'post_mime_type' => 'image/png',
			'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
			'post_name'      => $slug,
			'post_status'    => 'inherit',
		),
		$upload['file']
	);

	if ( is_wp_error( $attachment_id ) || ! $attachment_id ) {
		return 0;
	}

	if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) {
		require_once ABSPATH . 'wp-admin/includes/image.php';
	}

	$attachment_metadata = wp_generate_attachment_metadata( $attachment_id, $upload['file'] );
	if ( ! is_wp_error( $attachment_metadata ) && is_array( $attachment_metadata ) ) {
		wp_update_attachment_metadata( $attachment_id, $attachment_metadata );
	}

	return (int) $attachment_id;
}

/**
 * Create or update a service post by slug.
 *
 * @param string $slug    Slug.
 * @param array  $payload Post payload.
 * @return int
 */
function simple_service_test_upsert_service( $slug, $payload ) {
	$existing = get_page_by_path( $slug, OBJECT, 'service' );

	$data = array_merge(
		array(
			'post_type'    => 'service',
			'post_status'  => 'publish',
			'post_name'    => $slug,
			'post_title'   => '',
			'post_excerpt' => '',
			'post_content' => '',
		),
		$payload
	);

	if ( $existing ) {
		$data['ID'] = (int) $existing->ID;
		return (int) wp_update_post( $data );
	}

	return (int) wp_insert_post( $data );
}

$beta_id = simple_service_test_upsert_service(
	'service-beta-test',
	array(
		'post_title'   => 'Service Beta Test',
		'post_excerpt' => 'Short excerpt for Service Beta Test.',
		'post_content' => 'LONG_DESCRIPTION_BETA_TEST full description for the back side of the card.',
	)
);

$alpha_id = simple_service_test_upsert_service(
	'service-alpha-test',
	array(
		'post_title'   => 'Service Alpha Test',
		'post_excerpt' => '',
		'post_content' => 'LONG_DESCRIPTION_ALPHA_TEST alpha fallback excerpt content generated from post content when no explicit excerpt is set.',
	)
);

$draft_id = simple_service_test_upsert_service(
	'service-draft-test',
	array(
		'post_title'   => 'Service Draft Test',
		'post_status'  => 'draft',
		'post_excerpt' => 'This must not appear in frontend output.',
		'post_content' => 'Draft long content.',
	)
);

$png_bytes = base64_decode( 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=' );

$beta_image_id  = simple_service_test_upsert_attachment( 'service-beta-test-image', 'service-beta-test.png', $png_bytes );
$alpha_image_id = simple_service_test_upsert_attachment( 'service-alpha-test-image', 'service-alpha-test.png', $png_bytes );

if ( $beta_image_id ) {
	set_post_thumbnail( $beta_id, $beta_image_id );
}

if ( $alpha_image_id ) {
	set_post_thumbnail( $alpha_id, $alpha_image_id );
}

$page_slug = 'service-block-page-test';
$page      = get_page_by_path( $page_slug, OBJECT, 'page' );

$block_markup = sprintf(
	'<!-- wp:simple-service/services-grid {"selectedServiceIds":[%1$d,%2$d,%3$d]} /-->',
	$beta_id,
	$alpha_id,
	$draft_id
);

$page_payload = array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_name'    => $page_slug,
	'post_title'   => 'Service Block Page Test',
	'post_content' => $block_markup,
);

if ( $page ) {
	$page_payload['ID'] = (int) $page->ID;
	$page_id            = (int) wp_update_post( $page_payload );
} else {
	$page_id = (int) wp_insert_post( $page_payload );
}

update_option(
	'simple_service_test_fixture_ids',
	array(
		'beta'    => $beta_id,
		'alpha'   => $alpha_id,
		'draft'   => $draft_id,
		'page_id' => $page_id,
	)
);

echo wp_json_encode(
	array(
		'page_url' => get_permalink( $page_id ),
		'ids'      => get_option( 'simple_service_test_fixture_ids' ),
		'images'   => array(
			'beta'  => $beta_image_id,
			'alpha' => $alpha_image_id,
		),
	),
	JSON_PRETTY_PRINT
);
echo "\n";
