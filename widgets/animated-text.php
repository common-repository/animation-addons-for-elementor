<?php
namespace WCF_ADDONS\Widgets;

use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly
}

/**
 * Text
 *
 * Elementor widget for animated text.
 *
 * @since 1.0.0
 */
class Animated_Text extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wcf--text';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'WCF Animated Text', 'animation-addons-for-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wcf eicon-text';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'weal-coder-addon' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label'   => esc_html__( 'Text', 'animation-addons-for-elementor' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => esc_html__( 'Alignment', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'   => '',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'animation-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Text Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf--text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .wcf--text, {{WRAPPER}} .wcf--text *',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'text_shadow',
				'selector' => '{{WRAPPER}} .wcf--text',
			]
		);

		$this->add_control(
			'heading_link',
			[
				'label'     => esc_html__( 'Link', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_link_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf--text a:hover,{{WRAPPER}} .wcf--text a:focus' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( '' === $settings['text'] ) {
			return;
		}

		$this->add_render_attribute( 'text-attr', 'class', 'wcf--text' );

		$title_html = sprintf( '<div %1$s>%2$s</div>', $this->get_render_attribute_string( 'text-attr' ), $this->parse_text_editor( $settings['text'] ) );

		echo wp_kses_post( $title_html );
	}
}