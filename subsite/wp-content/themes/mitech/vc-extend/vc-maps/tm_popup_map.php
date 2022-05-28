<?php

class WPBakeryShortCode_TM_Popup_Map extends WPBakeryShortCode {

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

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Popup Map', 'mitech' ),
	'base'                      => 'tm_popup_map',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-map',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'mitech' ) => '01',
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Embed URL', 'mitech' ),
			'type'       => 'textarea',
			'param_name' => 'embed',
		),
		array(
			'heading'    => esc_html__( 'Video Text', 'mitech' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
	), Mitech_VC::get_alignment_fields(), array(
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );
