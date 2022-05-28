<?php

class WPBakeryShortCode_TM_Problem_Solution extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Problem And Solution', 'mitech' ),
	'base'                      => 'tm_problem_solution',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
			),
			'admin_label' => true,
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Problem Label', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'problem_label',
			'admin_label' => true,
		),
		array(
			'heading'    => esc_html__( 'Solution Label', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'solution_label',
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'mitech' ),
			'heading'    => esc_html__( 'Items', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Problem', 'mitech' ),
					'type'        => 'textarea',
					'param_name'  => 'problem',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Solution', 'mitech' ),
					'type'       => 'textarea',
					'param_name' => 'solution',
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
