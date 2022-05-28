<?php

class WPBakeryShortCode_TM_Separator extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;
		extract( $atts );

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

		switch ( $atts['style'] ) {
			case 'thin-line':
			case 'thick-line':
			case 'dash-line':
				$_color = Mitech_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['color'], $atts['custom_color'] );

				$mitech_shortcode_lg_css .= "$selector { $_color }";
				break;
			case 'thin-short-line':
			case 'thick-short-line':
				$_color = Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['color'], $atts['custom_color'] );

				$mitech_shortcode_lg_css .= "$selector .separator-wrap{ $_color }";
				break;
			case 'modern-dots':
				$_color = Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['color'], $atts['custom_color'] );

				$mitech_shortcode_lg_css .= "$selector .dot{ $_color }";
				break;
		}

		if ( $wrapper_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector { $wrapper_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}

}

vc_map( array(
	'name'     => esc_html__( 'Separator', 'mitech' ),
	'base'     => 'tm_separator',
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-call-to-action',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Modern Dots', 'mitech' )      => 'modern-dots',
				esc_html__( 'Thin Short Line', 'mitech' )  => 'thin-short-line',
				esc_html__( 'Thick Short Line', 'mitech' ) => 'thick-short-line',
				esc_html__( 'Thin Line', 'mitech' )        => 'thin-line',
				esc_html__( 'Thick Line', 'mitech' )       => 'thick-line',
				esc_html__( 'Dash Line', 'mitech' )        => 'dash-line',
			),
			'std'         => 'thick-short-line',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Color', 'mitech' ),
			'param_name'       => 'color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom color', 'mitech' ),
			'param_name'       => 'custom_color',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'heading'     => esc_html__( 'Smooth Scroll', 'mitech' ),
			'description' => esc_html__( 'Input valid id to smooth scroll to a section on click. ( For e.g: #about-us-section )', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'smooth_scroll',
		),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_alignment_fields(), Mitech_VC::get_vc_spacing_tab() ),
) );

