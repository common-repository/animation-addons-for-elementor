<?php

namespace WCF_ADDONS\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Social Icons
 *
 * Elementor widget for social icons.
 *
 * @since 1.0.0
 */
class One_page_Nav extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'wcf--one-page-nav';
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
		return esc_html__( 'WCF One Page Nav', 'animation-addons-for-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_icon() {
		return 'wcf eicon-nav-menu';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_categories() {
		return [ 'weal-coder-addon' ];
	}

	public function get_style_depends() {
		return [ 'wcf--one-page-nav' ];
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
			'section_navigation',
			[
				'label' => esc_html__( 'Navigation', 'animation-addons-for-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'nav_text',
			[
				'label'   => esc_html__( 'Text', 'animation-addons-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Home', 'animation-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'section_id',
			[
				'label'       => esc_html__( 'Section ID', 'animation-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'section_id',
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label'            => esc_html__( 'Icon', 'animation-addons-for-elementor' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-home',
					'library' => 'fa-solid',
				],
				'skin'             => 'inline',
				'label_block'      => false,
			]
		);

		$this->add_control(
			'wcf_one_page_nav',
			[
				'label'       => esc_html__( 'One Page Nav', 'animation-addons-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'selected_icon' => [
							'value'   => 'fas fa-home',
							'library' => 'fa-solid',
						],
						'nav_text'      => esc_html__( 'Home', 'animation-addons-for-elementor' ),
					],
					[
						'selected_icon' => [
							'value'   => 'far fa-user',
							'library' => 'fa-solid',
						],
						'nav_text'      => esc_html__( 'About', 'animation-addons-for-elementor' ),
					],
					[
						'selected_icon' => [
							'value'   => 'far fa-question-circle',
							'library' => 'fa-solid',
						],
						'nav_text'      => esc_html__( 'Faq', 'animation-addons-for-elementor' ),
					],
				],
				'title_field' => '{{{ nav_text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Settings', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'nav_position',
			[
				'label'        => esc_html__( 'Navigation Position', 'animation-addons-for-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'toggle'       => false,
				'options'      => [
					'left'   => [
						'title' => esc_html__( 'Left', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-arrow-left',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-arrow-right',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-arrow-down',
					],
				],
				'default'      => 'right',
				'prefix_class' => 'wcf-onepage-nav-position-',
			]
		);

		$this->add_control(
			'nav_position_vr',
			[
				'label'        => esc_html__( 'Vertical Position', 'animation-addons-for-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'middle',
				'toggle'       => false,
				'options'      => [
					'top'    => [
						'title' => esc_html__( 'Top', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'wcf-onepage-nav-vr-',
				'condition'    => [ 'nav_position!' => 'bottom' ],
			]
		);

		$this->add_control(
			'nav_position_hr',
			[
				'label'        => esc_html__( 'Horizontal Position', 'animation-addons-for-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'center',
				'toggle'       => false,
				'options'      => [
					'left'   => [
						'title' => esc_html__( 'Left', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'animation-addons-for-elementor' ),
						'icon'  => ' eicon-h-align-right',
					],
				],
				'prefix_class' => 'wcf-onepage-nav-hr-',
				'condition'    => [ 'nav_position' => 'bottom' ],
			]
		);

		$this->add_control(
			'show_tooltip',
			[
				'label'        => esc_html__( 'Show Tooltip', 'animation-addons-for-elementor' ),
				'description'  => esc_html__( 'If enable this settings menu text will be hidden. ', 'animation-addons-for-elementor' ),
				'separator'    => 'before',
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'animation-addons-for-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'animation-addons-for-elementor' ),
				'return_value' => 'yes',
				'prefix_class' => 'wcf-show-tooltip-',
			]
		);

		$this->end_controls_section();

		//style
		$this->start_controls_section(
			'section_wrap_style',
			[
				'label' => esc_html__( 'Navigation Wrapper', 'animation-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'wrapper_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wcf--onepage-nav',
			]
		);

		$this->add_control(
			'wrapper_padding',
			[
				'label'      => esc_html__( 'Padding', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .wcf--onepage-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'wrapper_border',
				'selector'  => '{{WRAPPER}} .wcf--onepage-nav',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'wrapper_border-radius',
			[
				'label'      => esc_html__( 'Border Radius', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .wcf--onepage-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_item_style',
			[
				'label' => esc_html__( 'Navigation Item', 'animation-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'text_typography',
				'selector'  => '{{WRAPPER}} .wcf-onepage-nav-item a',
				'condition' => [ 'show_tooltip!' => 'yes' ],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wcf-onepage-nav-item  i, {{WRAPPER}} .wcf-onepage-nav-item svg' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_gap',
			[
				'label'      => esc_html__( 'Icon Gap', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default'    => [
					'unit' => 'px',
					'size' => 8,
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wcf-onepage-nav-item a' => 'gap: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [ 'show_tooltip!' => 'yes' ],
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label'      => esc_html__( 'Item Gap', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wcf--onepage-nav' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'text_color_tabs'
		);

		$this->start_controls_tab(
			'text_color_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'text_color_normal',
			[
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf-onepage-nav-item a' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wcf-onepage-nav-item a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'text_color_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf-onepage-nav-item a:hover, {{WRAPPER}} .wcf-onepage-nav-item a:focus' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_background_hover',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wcf-onepage-nav-item a:hover, {{WRAPPER}} .wcf-onepage-nav-item a:focus',
			]
		);

		$this->add_control(
			'border_color_hover',
			[
				'label'     => esc_html__( 'Border Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [ 'item_border_border!' => '' ],
				'selectors' => [
					'{{WRAPPER}} .wcf-onepage-nav-item a:hover, {{WRAPPER}} .wcf-onepage-nav-item a:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => esc_html__( 'Padding', 'animation-addons-for-elementor' ),
				'separator'  => 'before',
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .wcf-onepage-nav-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'item_border',
				'selector' => '{{WRAPPER}} .wcf-onepage-nav-item a',
			]
		);

		$this->add_responsive_control(
			'item_border-radius',
			[
				'label'      => esc_html__( 'Border Radius', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .wcf-onepage-nav-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
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

		$migration_allowed = Icons_Manager::is_migration_allowed();

		$this->add_render_attribute( 'wrapper', 'class', 'wcf--onepage-nav' );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php
			foreach ( $settings['wcf_one_page_nav'] as $index => $item ) {
				?>
				<div class="wcf-onepage-nav-item">
					<a href="#<?php echo esc_attr( $item['section_id'] ); ?>">
						<?php
						$migrated = isset( $item['__fa4_migrated']['selected_icon'] );
						$is_new   = empty( $item['icon'] ) && $migration_allowed;
						if ( $is_new || $migrated ) {
							Icons_Manager::render_icon( $item['selected_icon'] );
						} else { ?>
							<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
						<?php }
						?>
						<span><?php echo esc_html( $item['nav_text'] ); ?></span>
					</a>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}
