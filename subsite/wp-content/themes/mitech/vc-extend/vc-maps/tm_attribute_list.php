<?php

class WPBakeryShortCode_TM_Attribute_List extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Attribute List', 'mitech' ),
	'base'     => 'tm_attribute_list',
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-portfoliogrid',
	'params'   => array_merge( array(
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
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Attributes', 'mitech' ),
			'heading'    => esc_html__( 'Attributes', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'attributes',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Name', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'name',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Value', 'mitech' ),
					'type'       => 'textarea',
					'param_name' => 'value',
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );

