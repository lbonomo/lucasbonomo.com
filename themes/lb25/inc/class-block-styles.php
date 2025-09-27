<?php
/**
 * Block Styles Registration Class
 *
 * @package LB25
 * @author Lucas Bonomo <bonomo.lucas@gmail.com>
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Class LB25_Block_Styles
 * 
 * Handles registration of custom block styles for the theme
 */
class LB25_Block_Styles
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		add_action('init', array($this, 'register_block_styles'));
	}

	/**
	 * Register all block styles
	 *
	 * @return void
	 */
	public function register_block_styles()
	{
		$this->register_cover_styles();
		$this->register_group_styles();
		$this->register_columns_styles();
		$this->register_gallery_styles();
		$this->register_quote_styles();
		$this->register_button_styles();
		$this->register_heading_styles();
	}

	/**
	 * Register Cover block styles
	 *
	 * @return void
	 */
	private function register_cover_styles()
	{
		register_block_style('core/cover', array(
			'name'  => 'hero',
			'label' => __('Hero', 'lb25'),
		));
	}

	/**
	 * Register Group block styles
	 *
	 * @return void
	 */
	private function register_group_styles()
	{
		$group_styles = array(
			array(
				'name'  => 'section-benefits',
				'label' => __('Benefits Section', 'lb25'),
			),
			array(
				'name'  => 'card',
				'label' => __('Card', 'lb25'),
			),
			array(
				'name'  => 'section-glow',
				'label' => __('Section with Glow', 'lb25'),
			),
			array(
				'name'  => 'section-padding',
				'label' => __('Section Padding', 'lb25'),
			),
			array(
				'name'  => 'section-hero',
				'label' => __('Hero Section', 'lb25'),
			),
			array(
				'name'  => 'section-white',
				'label' => __('White Section', 'lb25'),
			),
			array(
				'name'  => 'section-gray',
				'label' => __('Gray Section', 'lb25'),
			),
		);

		foreach ($group_styles as $style) {
			register_block_style('core/group', $style);
		}
	}

	/**
	 * Register Columns block styles
	 *
	 * @return void
	 */
	private function register_columns_styles()
	{
		$columns_styles = array(
			array(
				'name'  => 'benefits-grid',
				'label' => __('Benefits Grid', 'lb25'),
			),
			array(
				'name'  => 'services-grid',
				'label' => __('Services Grid', 'lb25'),
			),
			array(
				'name'  => 'testimonials-grid',
				'label' => __('Testimonials Grid', 'lb25'),
			),
		);

		foreach ($columns_styles as $style) {
			register_block_style('core/columns', $style);
		}
	}

	/**
	 * Register Gallery block styles
	 *
	 * @return void
	 */
	private function register_gallery_styles()
	{
		register_block_style('core/gallery', array(
			'name'  => 'portfolio-grid',
			'label' => __('Portfolio Grid', 'lb25'),
		));
	}

	/**
	 * Register Quote block styles
	 *
	 * @return void
	 */
	private function register_quote_styles()
	{
		$quote_styles = array(
			array(
				'name'  => 'testimonial',
				'label' => __('Testimonial', 'lb25'),
			),
			array(
				'name'  => 'testimonial-card',
				'label' => __('Testimonial Card', 'lb25'),
			),
		);

		foreach ($quote_styles as $style) {
			register_block_style('core/quote', $style);
		}
	}

	/**
	 * Register Button block styles
	 *
	 * @return void
	 */
	private function register_button_styles()
	{
		$button_styles = array(
			array(
				'name'  => 'primary',
				'label' => __('Primary Button', 'lb25'),
			),
			array(
				'name'  => 'secondary',
				'label' => __('Secondary Button', 'lb25'),
			),
			array(
				'name'  => 'outline',
				'label' => __('Outline Button', 'lb25'),
			),
		);

		foreach ($button_styles as $style) {
			register_block_style('core/button', $style);
		}
	}

	/**
	 * Register Heading block styles
	 *
	 * @return void
	 */
	private function register_heading_styles()
	{
		$heading_styles = array(
			array(
				'name'  => 'hero-title',
				'label' => __('Hero Title', 'lb25'),
			),
			array(
				'name'  => 'section-title',
				'label' => __('Section Title', 'lb25'),
			),
			array(
				'name'  => 'highlight',
				'label' => __('Highlighted Text', 'lb25'),
			),
		);

		foreach ($heading_styles as $style) {
			register_block_style('core/heading', $style);
		}
	}

	/**
	 * Get all registered block styles
	 * Useful for debugging or displaying available styles
	 *
	 * @return array
	 */
	public function get_registered_styles()
	{
		return array(
			'core/cover' => array('hero'),
			'core/group' => array('section-benefits', 'card', 'section-glow', 'section-padding', 'section-hero', 'section-white', 'section-gray'),
			'core/columns' => array('benefits-grid', 'services-grid', 'testimonials-grid'),
			'core/gallery' => array('portfolio-grid'),
			'core/quote' => array('testimonial', 'testimonial-card'),
			'core/button' => array('primary', 'secondary', 'outline'),
			'core/heading' => array('hero-title', 'section-title', 'highlight'),
		);
	}
}

// Initialize the class
new LB25_Block_Styles();