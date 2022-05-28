<?php

class WPBakeryShortCode_TM_Blockquote extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$content_tab = esc_html__( 'Content', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Blockquote', 'mitech' ),
	'base'                      => 'tm_blockquote',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-blockquote',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'mitech' ) => '01',
				esc_html__( 'Style 02', 'mitech' ) => '02',
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Text', 'mitech' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
