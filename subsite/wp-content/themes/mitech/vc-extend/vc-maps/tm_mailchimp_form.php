<?php

class WPBakeryShortCode_TM_Mailchimp_Form extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;

		$button_tmp = $button_hover_tmp = '';

		$button_tmp       .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['font_color'], $atts['custom_font_color'] );
		$button_tmp       .= Mitech_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['button_border_color'], $atts['custom_button_border_color'] );
		$button_tmp       .= Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['button_bg_color'], $atts['custom_button_bg_color'], $atts['button_bg_gradient'] );
		$button_hover_tmp .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['font_color_hover'], $atts['custom_font_color_hover'] );
		$button_hover_tmp .= Mitech_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['button_border_color_hover'], $atts['custom_button_border_color_hover'] );
		$button_hover_tmp .= Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['button_bg_color_hover'], $atts['custom_button_bg_color_hover'], $atts['button_bg_gradient_hover'] );

		if ( $button_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .form-submit{ $button_tmp }";
		}

		if ( $button_hover_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .form-submit:hover { $button_hover_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$button_styling_tab = esc_html__( 'Button Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Mailchimp Form', 'mitech' ),
	'base'                      => 'tm_mailchimp_form',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-mailchimp-form',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Widget title', 'mitech' ),
			'param_name'  => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'mitech' ),
		),
		array(
			'heading'     => esc_html__( 'Form Id', 'mitech' ),
			'description' => esc_html__( 'Input the id of form. Leave blank to show default form.', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'form_id',
		),
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
				esc_html__( '02', 'mitech' ) => '02',
				esc_html__( '03', 'mitech' ) => '03',
				esc_html__( '04', 'mitech' ) => '04',
				esc_html__( '05', 'mitech' ) => '05',
				esc_html__( '06', 'mitech' ) => '06',
			),
			'std'         => '01',
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background color', 'mitech' ),
			'param_name'       => 'button_bg_color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )     => '',
				esc_html__( 'Primary', 'mitech' )     => 'primary',
				esc_html__( 'Secondary', 'mitech' )   => 'secondary',
				esc_html__( 'Gradient', 'mitech' )    => 'gradient',
				esc_html__( 'Transparent', 'mitech' ) => 'transparent',
				esc_html__( 'Custom', 'mitech' )      => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom background color', 'mitech' ),
			'param_name'       => 'custom_button_bg_color',
			'dependency'       => array(
				'element' => 'button_bg_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'      => $button_styling_tab,
			'heading'    => esc_html__( 'Background Gradient', 'mitech' ),
			'type'       => 'gradient',
			'param_name' => 'button_bg_gradient',
			'dependency' => array(
				'element' => 'button_bg_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text color', 'mitech' ),
			'param_name'       => 'font_color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom text color', 'mitech' ),
			'param_name'       => 'custom_font_color',
			'dependency'       => array(
				'element' => 'font_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Border color', 'mitech' ),
			'param_name'       => 'button_border_color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Border color', 'mitech' ),
			'param_name'       => 'custom_button_border_color',
			'dependency'       => array(
				'element' => 'button_border_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Icon color', 'mitech' ),
			'param_name'       => 'button_icon_color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Icon color', 'mitech' ),
			'param_name'       => 'custom_button_icon_color',
			'dependency'       => array(
				'element' => 'button_icon_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background color (on hover)', 'mitech' ),
			'param_name'       => 'button_bg_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )     => '',
				esc_html__( 'Primary', 'mitech' )     => 'primary',
				esc_html__( 'Secondary', 'mitech' )   => 'secondary',
				esc_html__( 'Gradient', 'mitech' )    => 'gradient',
				esc_html__( 'Transparent', 'mitech' ) => 'transparent',
				esc_html__( 'Custom', 'mitech' )      => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom background color (on hover)', 'mitech' ),
			'param_name'       => 'custom_button_bg_color_hover',
			'dependency'       => array(
				'element' => 'button_bg_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'      => $button_styling_tab,
			'heading'    => esc_html__( 'Background Gradient (on hover)', 'mitech' ),
			'type'       => 'gradient',
			'param_name' => 'button_bg_gradient_hover',
			'dependency' => array(
				'element' => 'button_bg_color_hover',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text color (on hover)', 'mitech' ),
			'param_name'       => 'font_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Text color (on hover)', 'mitech' ),
			'param_name'       => 'custom_font_color_hover',
			'dependency'       => array(
				'element' => 'font_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Border color (on hover)', 'mitech' ),
			'param_name'       => 'button_border_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $button_styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Border color (on hover)', 'mitech' ),
			'param_name'       => 'custom_button_border_color_hover',
			'dependency'       => array(
				'element' => 'button_border_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
