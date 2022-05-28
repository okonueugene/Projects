<?php

class WPBakeryShortCode_TM_SoundCloud extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'SoundCloud', 'mitech' ),
	'base'                      => 'tm_soundcloud',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'    => esc_html__( 'Embed Code', 'mitech' ),
			'type'       => 'textarea_html',
			'param_name' => 'content',
		),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
