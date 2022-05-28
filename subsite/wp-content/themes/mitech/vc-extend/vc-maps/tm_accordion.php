<?php

class WPBakeryShortCode_TM_Accordion extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Accordion', 'mitech' ),
	'base'                      => 'tm_accordion',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-accordion',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'mitech' ) => '01',
				esc_html__( 'Style 02', 'mitech' ) => '02',
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Multi Open', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'multi_open',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
		),
		array(
			'heading'     => esc_html__( 'Default Open', 'mitech' ),
			'description' => esc_html__( 'Input index of items that you want to open by default. For e.g: 1', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'open_index',
			'min'         => 1,
			'max'         => 100,
			'step'        => 1,
			'std'         => '',
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'mitech' ),
			'heading'    => esc_html__( 'Items', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Title', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Content', 'mitech' ),
					'type'       => 'textarea',
					'param_name' => 'content',
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
