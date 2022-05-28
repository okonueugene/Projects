<?php

class WPBakeryShortCode_TM_Text_Box extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Text Box', 'mitech' ),
	'base'                      => 'tm_text_box',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-dropcap',
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
				esc_html__( 'Style 03', 'mitech' ) => '03',
				esc_html__( 'Style 04', 'mitech' ) => '04',
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Heading', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
		),
		array(
			'heading'    => esc_html__( 'Text', 'mitech' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
