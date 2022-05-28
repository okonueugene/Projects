<?php

class WPBakeryShortCode_TM_Slider_Button extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;

		$wrapper_tmp = '';

		if ( $atts['align'] !== '' ) {
			$wrapper_tmp .= "text-align: {$atts['align']};";
		}

		if ( $atts['md_align'] !== '' ) {
			$mitech_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$mitech_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$mitech_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		if ( $wrapper_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector { $wrapper_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Slider Button', 'mitech' ),
	'base'                      => 'tm_slider_button',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
				esc_html__( '02', 'mitech' ) => '02',
			),
			'admin_label' => true,
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Skin', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'value'       => array(
				esc_html__( 'Dark', 'mitech' )  => 'dark',
				esc_html__( 'Light', 'mitech' ) => 'light',
			),
			'admin_label' => true,
			'std'         => 'dark',
		),
		Mitech_VC::extra_id_field(),
	), Mitech_VC::get_alignment_fields(), Mitech_VC::get_vc_spacing_tab() ),
) );
