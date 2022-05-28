<?php

class WPBakeryShortCode_TM_Case_Study_Details extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Case Study Details', 'mitech' ),
	'base'                      => 'tm_case_study_details',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-portfoliogrid',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Style 01', 'mitech' ) => '01',
			),
			'admin_label' => true,
			'std'         => '01',
		),
		Mitech_VC::get_animation_field(),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
