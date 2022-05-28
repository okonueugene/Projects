<?php

class WPBakeryShortCode_TM_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;

		$wrapper_tmp = $tmp = '';

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

		$tmp .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$tmp .= Mitech_Helper::get_shortcode_css_color_inherit( 'background', $atts['icon_bg_color'], $atts['custom_icon_bg_color'] );

		if ( $wrapper_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector  { $wrapper_tmp }";
		}

		if ( $tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .icon { $tmp }";
		}

		if ( isset( $atts['font_size'] ) ) {
			Mitech_VC::get_responsive_css( array(
				'element' => "$selector .icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$params = array_merge( Mitech_VC::icon_libraries( array(
	'allow_none' => true,
	'group'      => '',
) ), Mitech_VC::get_alignment_fields(), array(
	array(
		'heading'     => esc_html__( 'Style', 'mitech' ),
		'type'        => 'dropdown',
		'param_name'  => 'style',
		'value'       => array(
			esc_html__( 'Style 01', 'mitech' ) => '01',
			esc_html__( 'Style 02', 'mitech' ) => '02',
			esc_html__( 'Style 03', 'mitech' ) => '03',
		),
		'admin_label' => true,
		'std'         => '01',
	),
	array(
		'heading'     => esc_html__( 'Font Size', 'mitech' ),
		'type'        => 'number_responsive',
		'param_name'  => 'font_size',
		'min'         => 8,
		'suffix'      => 'px',
		'media_query' => array(
			'lg' => '',
			'md' => '',
			'sm' => '',
			'xs' => '',
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Icon Color', 'mitech' ),
		'type'       => 'dropdown',
		'param_name' => 'icon_color',
		'value'      => array(
			esc_html__( 'Default Color', 'mitech' )   => '',
			esc_html__( 'Primary Color', 'mitech' )   => 'primary',
			esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
			esc_html__( 'Custom Color', 'mitech' )    => 'custom',
		),
		'std'        => '',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Custom Icon Color', 'mitech' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_icon_color',
		'dependency' => array(
			'element' => 'icon_color',
			'value'   => 'custom',
		),
		'std'        => '#fff',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Icon Background Color', 'mitech' ),
		'type'       => 'dropdown',
		'param_name' => 'icon_bg_color',
		'value'      => array(
			esc_html__( 'Default Color', 'mitech' )   => '',
			esc_html__( 'Primary Color', 'mitech' )   => 'primary',
			esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
			esc_html__( 'Custom Color', 'mitech' )    => 'custom',
		),
		'std'        => '',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Custom Icon Background Color', 'mitech' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_icon_bg_color',
		'dependency' => array(
			'element' => 'icon_bg_color',
			'value'   => 'custom',
		),
		'std'        => '#222',
	),
	Mitech_VC::get_animation_field(),
	Mitech_VC::extra_class_field(),
), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() );

vc_map( array(
	'name'                      => esc_html__( 'Icon', 'mitech' ),
	'base'                      => 'tm_icon',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => $params,
) );
