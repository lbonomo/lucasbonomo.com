<?php
/**
 * Native core/gallery block enhancement for lightbox support.
 *
 * @package lb19
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enrich native core/gallery block HTML with full-size image URLs for the lightbox.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block data.
 * @return string
 */
function lb19_enhance_gallery_block_for_lightbox( $block_content, $block ) {
	if ( empty( $block_content ) || ! is_string( $block_content ) ) {
		return $block_content;
	}

	if ( class_exists( 'WP_HTML_Tag_Processor' ) ) {
		$processor = new WP_HTML_Tag_Processor( $block_content );

		if ( $processor->next_tag( array( 'class_name' => 'wp-block-gallery' ) ) ) {
			$processor->set_attribute( 'data-lb-gallery-lightbox', 'true' );
		}

		while ( $processor->next_tag( 'img' ) ) {
			if ( $processor->get_attribute( 'data-lb-full-src' ) ) {
				continue;
			}

			$attachment_id = 0;
			$data_id       = $processor->get_attribute( 'data-id' );
			if ( is_string( $data_id ) && ctype_digit( $data_id ) ) {
				$attachment_id = (int) $data_id;
			}

			if ( ! $attachment_id ) {
				$class_attr = $processor->get_attribute( 'class' );
				if ( is_string( $class_attr ) && preg_match( '/\bwp-image-(\d+)\b/', $class_attr, $matches ) ) {
					$attachment_id = (int) $matches[1];
				}
			}

			if ( $attachment_id > 0 ) {
				$full_url = wp_get_attachment_image_url( $attachment_id, 'full' );
				if ( $full_url ) {
					$processor->set_attribute( 'data-lb-full-src', esc_url( $full_url ) );
				}
			}
		}

		return $processor->get_updated_html();
	}

	// Fallback for WordPress versions without WP_HTML_Tag_Processor.
	$block_content = preg_replace_callback(
		'/<img\b[^>]*>/i',
		function ( $matches ) {
			$img_tag = $matches[0];

			if ( false !== stripos( $img_tag, 'data-lb-full-src=' ) ) {
				return $img_tag;
			}

			$attachment_id = 0;
			if ( preg_match( '/\bdata-id=["\'](\d+)["\']/i', $img_tag, $id_match ) ) {
				$attachment_id = (int) $id_match[1];
			} elseif ( preg_match( '/\bwp-image-(\d+)\b/i', $img_tag, $class_match ) ) {
				$attachment_id = (int) $class_match[1];
			}

			if ( $attachment_id > 0 ) {
				$full_url = wp_get_attachment_image_url( $attachment_id, 'full' );
				if ( $full_url ) {
					$attr    = ' data-lb-full-src="' . esc_url( $full_url ) . '"';
					$img_tag = preg_replace( '/\s*\/?>$/', $attr . '$0', $img_tag, 1 );
				}
			}

			return $img_tag;
		},
		$block_content
	);

	return $block_content;
}
add_filter( 'render_block_core/gallery', 'lb19_enhance_gallery_block_for_lightbox', 10, 2 );
