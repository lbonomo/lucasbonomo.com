<?php

use PHPUnit\Framework\TestCase;

/**
 * Integration tests for Services Grid renderer.
 */
class ServicesGridRenderTest extends TestCase {
	/**
	 * @var int[]
	 */
	private $cleanup_post_ids = array();

	protected function tearDown(): void {
		foreach ( $this->cleanup_post_ids as $post_id ) {
			wp_delete_post( $post_id, true );
		}

		$this->cleanup_post_ids = array();
		parent::tearDown();
	}

	public function test_returns_empty_output_for_empty_selection() {
		$output = $this->render_block_with_attributes(
			array(
				'selectedServiceIds' => array(),
			)
		);

		$this->assertSame( '', $output );
	}

	public function test_renders_only_published_services_in_selected_order() {
		$first_id = $this->create_service_post(
			array(
				'post_title'   => 'First Service',
				'post_excerpt' => 'First short excerpt',
			)
		);
		$second_id = $this->create_service_post(
			array(
				'post_title'   => 'Second Service',
				'post_excerpt' => 'Second short excerpt',
			)
		);
		$draft_id = $this->create_service_post(
			array(
				'post_title'   => 'Draft Service',
				'post_status'  => 'draft',
				'post_excerpt' => 'Should not render',
			)
		);

		$output = $this->render_block_with_attributes(
			array(
				'selectedServiceIds' => array( $second_id, $draft_id, $first_id ),
			)
		);

		$this->assertStringContainsString( 'Second Service', $output );
		$this->assertStringContainsString( 'First Service', $output );
		$this->assertStringNotContainsString( 'Draft Service', $output );

		$this->assertLessThan(
			strpos( $output, 'First Service' ),
			strpos( $output, 'Second Service' ),
			'Services are not rendered in selected order.'
		);
	}

	public function test_falls_back_to_trimmed_content_when_excerpt_is_missing() {
		$post_id = $this->create_service_post(
			array(
				'post_title'   => 'No Excerpt Service',
				'post_excerpt' => '',
				'post_content' => 'Fallback content words one two three four five six seven eight nine ten eleven twelve.',
			)
		);

		$output = $this->render_block_with_attributes(
			array(
				'selectedServiceIds' => array( $post_id ),
			)
		);

		$this->assertStringContainsString( 'Fallback content words one two three', $output );
	}

	/**
	 * Render the block template in isolation.
	 *
	 * @param array $attributes Block attributes.
	 * @return string
	 */
	private function render_block_with_attributes( $attributes ) {
		$block   = null;
		$content = '';

		return include WP_PLUGIN_DIR . '/simple-service/blocks/services-grid/render.php';
	}

	/**
	 * Create a service post and schedule cleanup.
	 *
	 * @param array $overrides Post field overrides.
	 * @return int
	 */
	private function create_service_post( $overrides ) {
		$post_id = wp_insert_post(
			array_merge(
				array(
					'post_type'    => 'service',
					'post_status'  => 'publish',
					'post_title'   => 'Test Service',
					'post_excerpt' => '',
					'post_content' => '',
				),
				$overrides
			),
			true
		);

		$this->assertNotWPError( $post_id );

		$this->cleanup_post_ids[] = (int) $post_id;

		return (int) $post_id;
	}

	/**
	 * Assert helper for WP_Error values.
	 *
	 * @param mixed $value Value to inspect.
	 * @return void
	 */
	private function assertNotWPError( $value ) {
		$this->assertFalse( is_wp_error( $value ), is_wp_error( $value ) ? $value->get_error_message() : '' );
	}
}
