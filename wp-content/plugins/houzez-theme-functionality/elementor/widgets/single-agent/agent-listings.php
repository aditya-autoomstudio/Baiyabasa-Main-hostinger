<?php
namespace Elementor;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Houzez_Agent_Listings extends Widget_Base {
    use \HouzezThemeFunctionality\Elementor\Traits\Houzez_Preview_Query;

	public function get_name() {
		return 'houzez-agent-listings';
	}

	public function get_title() {
		return __( 'Agent Listings', 'houzez-theme-functionality' );
	}

	public function get_icon() {
		return 'houzez-element-icon houzez-single-agent eicon-gallery-grid';
	}

	public function get_categories() {
		if(get_post_type() === 'fts_builder' && htb_get_template_type(get_the_id()) === 'single-agent')  {
            return ['houzez-single-agent-builder']; 
        }

        return [ 'houzez-single-agent' ];
	}

	public function get_keywords() {
		return ['agent', 'listings', 'houzez' ];
	}

	protected function register_controls() {
		parent::register_controls();

		$prop_types = array();
        $prop_status = array();
        
        houzez_get_terms_array( 'property_status', $prop_status );
        houzez_get_terms_array( 'property_type', $prop_types );

		$this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'houzez-theme-functionality' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'listings_layout',
            [
                'label'     => esc_html__( 'Listings Layout', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'list-view-v1' => 'List View v1',
                    'grid-view-v1' => 'Grid View v1',
                    'list-view-v2' => 'List View v2',
                    'grid-view-v2' => 'Grid View v2',
                    'grid-view-v3' => 'Grid View v3',
                    'list-view-v4' => 'List View v4',
                    'list-view-v5' => 'List View v5',
                    'grid-view-v5' => 'Grid View v5',
                    'grid-view-v6' => 'Grid View v6',
                    'list-view-v7' => 'List View v7',
                    'grid-view-v7' => 'Grid View v7',
                ],
                'description' => '',
                'default' => 'grid-view-v1',
            ]
        );

        $this->add_control(
            'module_type',
            [
                'label'     => esc_html__( 'Columns', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                	'grid-view-2-cols'    => esc_html__( 'Grid View 2 Columns', 'houzez-theme-functionality'),
                    'grid-view-3-cols'  => esc_html__( 'Grid View 3 Columns', 'houzez-theme-functionality'),
                    'grid-view-4-cols'  => esc_html__( 'Grid View 4 Columns', 'houzez-theme-functionality'),
                ],
                'description' => '',
                'default' => 'grid-view-3-cols',
                'condition' => [
                	'listings_layout' => ['grid-view-v1', 'grid-view-v2', 'grid-view-v3', 'grid-view-v5', 'grid-view-v6', 'grid-view-v7']
                ]
            ]
        );

        $this->add_control(
            'listing_tabs',
            [
                'label' => __( 'Show Listing Tabs', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'houzez-theme-functionality' ),
                'label_off' => __( 'Hide', 'houzez-theme-functionality' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'tabs_field',
            [
                'label'     => esc_html__( 'Tab Type', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => array(
                    'property_status' => esc_html__('Status', 'houzez-theme-functionality'),
                    'property_type' => esc_html__('Type', 'houzez-theme-functionality'),
                    'property_city' => esc_html__('City', 'houzez-theme-functionality'),
                ),
                'description' => '',
                'default' => 'property_status',
                'condition' => [
                	'listing_tabs' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'type_data',
            [
                'label'     => esc_html__( 'Select Types', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $prop_types,
                'description' => '',
                'multiple' => true,
                'default' => '',
                'condition' => [
                    'tabs_field' => 'property_type',
                    'listing_tabs' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'status_data',
            [
                'label'     => esc_html__( 'Select Statuses', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $prop_status,
                'description' => '',
                'multiple' => true,
                'default' => '',
                'condition' => [
                    'tabs_field' => 'property_status',
                    'listing_tabs' => 'yes',
                ],
            ]
        );


        $this->add_control(
            'city_data',
            [
                'label'         => esc_html__( 'Select Cities', 'houzez-theme-functionality' ),
                'multiple'      => true,
                'label_block'   => false,
                'type'          => 'houzez_autocomplete',
                'make_search'   => 'houzez_get_taxonomies',
                'render_result' => 'houzez_render_taxonomies',
                'taxonomy'      => array('property_city'),
                'condition' => [
                    'tabs_field' => 'property_city',
                    'listing_tabs' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_all',
            [
                'label' => __( 'Show All Tab', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'houzez-theme-functionality' ),
                'label_off' => __( 'Hide', 'houzez-theme-functionality' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                	'listing_tabs' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'homey_section_typography',
            [
                'label' => esc_html__( 'Tabs Style', 'houzez-theme-functionality' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'listing_tabs' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} #houzez-listings-tabs-wrap .nav-link',
            ]
        );

        $this->add_control(
            'listing_tabs_color',
            [
                'label'     => esc_html__( 'Tabs Color', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#222222',
                'selectors' => [
                    '{{WRAPPER}} #houzez-listings-tabs-wrap .nav-link' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'search_tabs_active_color',
            [
                'label'     => esc_html__( 'Tabs Active Color', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#222222',
                'selectors' => [
                    '{{WRAPPER}} #houzez-listings-tabs-wrap .nav-link.active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'search_tabs_bg_color',
            [
                'label'     => esc_html__( 'Tabs Background Color', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ebebeb',
                'selectors' => [
                    '{{WRAPPER}} #houzez-listings-tabs-wrap .nav-link' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'search_active_tabs_bg_color',
            [
                'label'     => esc_html__( 'Active Tabs Background Color', 'houzez-theme-functionality' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} #houzez-listings-tabs-wrap .nav-link.active' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'houzez-theme-functionality' ),
                'selector' => '{{WRAPPER}} #houzez-listings-tabs-wrap .nav-link',
            ]
        );

        $this->add_control(
            'margin',
            [
                'label' => __( 'Margin', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #houzez-listings-tabs-wrap .nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => __( 'Padding', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #houzez-listings-tabs-wrap .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        

        $this->add_control(
            'radius',
            [
                'label' => __( 'Radius', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #houzez-listings-tabs-wrap .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {
		
		global $settings, $post, $houzez_local;

        $houzez_local = houzez_get_localization();

		$settings = $this->get_settings_for_display();

        $this->single_agent_preview_query(); // Only for preview

        htf_get_template_part('elementor/template-part/single-agent/agent-listings');

        $this->reset_preview_query(); // Only for preview

	}

}
Plugin::instance()->widgets_manager->register( new Houzez_Agent_Listings );