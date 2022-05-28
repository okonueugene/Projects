<?php

class WPBakeryShortCode_TM_Counter extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		$align = 'center';

		extract( $atts );

		$tmp = "text-align: {$align}";

		$number_tmp      = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['number_color'], $atts['custom_number_color'] );
		$text_tmp        = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );
		$description_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['description_color'], $atts['custom_description_color'] );
		$icon_tmp        = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$background_tmp  = Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'] );

		if ( $number_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .number-wrap { $number_tmp }";
		}

		if ( $text_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .heading { $text_tmp }";
		}

		if ( $description_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .description { $text_tmp }";
		}

		if ( $icon_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .icon { $icon_tmp }";
		}

		if ( $background_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .counter-wrap { $background_tmp }";
		}

		$mitech_shortcode_lg_css .= "$selector { $tmp }";

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$style_group = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Counter', 'mitech' ),
	'base'                      => 'tm_counter',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-counter',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
				esc_html__( '02', 'mitech' ) => '02',
				esc_html__( '03', 'mitech' ) => '03',
				esc_html__( '04', 'mitech' ) => '04',
			),
			'std'         => '01',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Counter Animation', 'mitech' ),
			'param_name' => 'animation',
			'value'      => array(
				esc_html__( 'None', 'mitech' )       => 'none',
				esc_html__( 'Counter Up', 'mitech' ) => 'counter-up',
				esc_html__( 'Odometer', 'mitech' )   => 'odometer',
			),
			'std'        => 'counter-up',
		),
		array(
			'heading'    => esc_html__( 'Text Align', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'align',
			'value'      => array(
				esc_html__( 'Left', 'mitech' )   => 'left',
				esc_html__( 'Center', 'mitech' ) => 'center',
				esc_html__( 'Right', 'mitech' )  => 'right',
			),
			'std'        => 'center',
		),
		array(
			'group'       => esc_html__( 'Data', 'mitech' ),
			'heading'     => esc_html__( 'Number', 'mitech' ),
			'type'        => 'number',
			'admin_label' => true,
			'param_name'  => 'number',
		),
		array(
			'group'       => esc_html__( 'Data', 'mitech' ),
			'heading'     => esc_html__( 'Number Prefix', 'mitech' ),
			'description' => esc_html__( 'Prefix your number with a symbol or text.', 'mitech' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'number_prefix',
		),
		array(
			'group'       => esc_html__( 'Data', 'mitech' ),
			'heading'     => esc_html__( 'Number Suffix', 'mitech' ),
			'description' => esc_html__( 'Suffix your number with a symbol or text.', 'mitech' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'number_suffix',
		),
		array(
			'group'      => esc_html__( 'Data', 'mitech' ),
			'type'       => 'textarea',
			'heading'    => esc_html__( 'Sub Heading', 'mitech' ),
			'param_name' => 'sub_heading',
		),
		array(
			'group'       => esc_html__( 'Data', 'mitech' ),
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Heading', 'mitech' ),
			'admin_label' => true,
			'param_name'  => 'text',
		),
		array(
			'group'      => esc_html__( 'Data', 'mitech' ),
			'type'       => 'textarea',
			'heading'    => esc_html__( 'Description', 'mitech' ),
			'param_name' => 'description',
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'            => $style_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Number Color', 'mitech' ),
			'param_name'       => 'number_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $style_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Number Color', 'mitech' ),
			'param_name'       => 'custom_number_color',
			'dependency'       => array(
				'element' => 'number_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Heading Color', 'mitech' ),
			'param_name'       => 'text_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $style_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Heading Color', 'mitech' ),
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Description Color', 'mitech' ),
			'param_name'       => 'description_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $style_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Description Color', 'mitech' ),
			'param_name'       => 'custom_description_color',
			'dependency'       => array(
				'element' => 'description_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Icon Color', 'mitech' ),
			'param_name'       => 'icon_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $style_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Icon Color', 'mitech' ),
			'param_name'       => 'custom_icon_color',
			'dependency'       => array(
				'element' => 'icon_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background Color', 'mitech' ),
			'param_name'       => 'background_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $style_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Background Color', 'mitech' ),
			'param_name'       => 'custom_background_color',
			'dependency'       => array(
				'element' => 'background_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
	), Mitech_VC::icon_libraries( array( 'allow_none' => true ) ), Mitech_VC::get_vc_spacing_tab() ),
) );
