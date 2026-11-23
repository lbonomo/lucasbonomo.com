<?php
/**
 * Native core/table block enhancement for accessibility and responsive layout.
 *
 * @package lb19
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enhance native core/table block HTML with region semantics, keyboard scrollability,
 * and column data-labels for responsive stacked layouts on narrow containers.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block data.
 * @return string
 */
function lb19_enhance_table_block( $block_content, $block ) {
	if ( empty( $block_content ) || ! is_string( $block_content ) || ! class_exists( 'DOMDocument' ) ) {
		return $block_content;
	}

	if ( false === stripos( $block_content, '<table' ) ) {
		return $block_content;
	}

	$previous_errors = libxml_use_internal_errors( true );

	$dom = new DOMDocument( '1.0', 'UTF-8' );
	$wrapped = '<div id="lb19-table-root">' . $block_content . '</div>';
	$loaded  = $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $wrapped, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );

	libxml_clear_errors();
	libxml_use_internal_errors( $previous_errors );

	if ( ! $loaded ) {
		return $block_content;
	}

	$root = $dom->getElementById( 'lb19-table-root' );
	if ( ! $root ) {
		return $block_content;
	}

	$figures = $root->getElementsByTagName( 'figure' );
	$figure  = null;
	foreach ( $figures as $candidate ) {
		$class_attr = $candidate->getAttribute( 'class' );
		if ( preg_match( '/\bwp-block-table\b/', $class_attr ) ) {
			$figure = $candidate;
			break;
		}
	}

	if ( $figure ) {
		if ( ! $figure->hasAttribute( 'tabindex' ) ) {
			$figure->setAttribute( 'tabindex', '0' );
		}
		if ( ! $figure->hasAttribute( 'role' ) ) {
			$figure->setAttribute( 'role', 'region' );
		}

		if ( ! $figure->hasAttribute( 'aria-labelledby' ) && ! $figure->hasAttribute( 'aria-label' ) ) {
			$captions = $figure->getElementsByTagName( 'figcaption' );
			if ( $captions->length > 0 ) {
				$caption = $captions->item( 0 );
				$cap_id  = $caption->getAttribute( 'id' );
				if ( '' === $cap_id ) {
					$cap_id = function_exists( 'wp_unique_id' )
						? wp_unique_id( 'lb-table-caption-' )
						: 'lb-table-caption-' . uniqid();
					$caption->setAttribute( 'id', $cap_id );
				}
				$figure->setAttribute( 'aria-labelledby', $cap_id );
			} else {
				$figure->setAttribute( 'aria-label', __( 'Tabla de datos', 'lb19' ) );
			}
		}
	}

	$tables = $root->getElementsByTagName( 'table' );
	if ( $tables->length > 0 ) {
		$table  = $tables->item( 0 );
		$theads = $table->getElementsByTagName( 'thead' );
		$tbodys = $table->getElementsByTagName( 'tbody' );

		if ( $theads->length > 0 && $tbodys->length > 0 ) {
			$thead_rows = $theads->item( 0 )->getElementsByTagName( 'tr' );
			if ( 1 === $thead_rows->length ) {
				$headers       = array();
				$has_spans     = false;
				$header_row    = $thead_rows->item( 0 );

				foreach ( $header_row->childNodes as $cell ) {
					if ( XML_ELEMENT_NODE !== $cell->nodeType ) {
						continue;
					}
					$tag = strtolower( $cell->nodeName );
					if ( 'th' !== $tag && 'td' !== $tag ) {
						continue;
					}
					if ( $cell->hasAttribute( 'colspan' ) || $cell->hasAttribute( 'rowspan' ) ) {
						$has_spans = true;
						break;
					}
					$headers[] = trim( preg_replace( '/\s+/', ' ', $cell->textContent ) );
				}

				if ( ! $has_spans && count( $headers ) > 0 ) {
					$body_rows = $tbodys->item( 0 )->getElementsByTagName( 'tr' );
					foreach ( $body_rows as $row ) {
						foreach ( $row->childNodes as $cell ) {
							if ( XML_ELEMENT_NODE !== $cell->nodeType ) {
								continue;
							}
							if ( $cell->hasAttribute( 'colspan' ) || $cell->hasAttribute( 'rowspan' ) ) {
								$has_spans = true;
								break 2;
							}
						}
					}

					if ( ! $has_spans ) {
						$table->setAttribute( 'data-lb-stackable', 'true' );

						foreach ( $body_rows as $row ) {
							$col_index = 0;
							foreach ( $row->childNodes as $cell ) {
								if ( XML_ELEMENT_NODE !== $cell->nodeType ) {
									continue;
								}
								$tag = strtolower( $cell->nodeName );
								if ( 'td' !== $tag && 'th' !== $tag ) {
									continue;
								}
								if ( 'td' === $tag && isset( $headers[ $col_index ] ) && '' !== $headers[ $col_index ] ) {
									$cell->setAttribute( 'data-label', $headers[ $col_index ] );
								}
								$col_index++;
							}
						}
					}
				}
			}
		}
	}

	$output = '';
	foreach ( $root->childNodes as $child ) {
		$output .= $dom->saveHTML( $child );
	}

	return '' !== $output ? $output : $block_content;
}
add_filter( 'render_block_core/table', 'lb19_enhance_table_block', 10, 2 );
