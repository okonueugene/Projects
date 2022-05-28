<?php

class WPBakeryShortCode_TM_Message_Box extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
		global $mitech_shortcode_lg_css_array;

		$tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );
		$tmp .= Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'], $atts['background_gradient'] );

		if ( $tmp !== '' ) {
			$mitech_shortcode_lg_css_array[ $selector ][] = $tmp;
		}
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Message Box', 'mitech' ),
	'base'                      => 'tm_message_box',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-testimonials',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Message Box Presets', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'mitech' )       => '',
				esc_html__( 'Informational', 'mitech' ) => 'info',
				esc_html__( 'Warning', 'mitech' )       => 'warning',
				esc_html__( 'Success', 'mitech' )       => 'success',
				esc_html__( 'Error', 'mitech' )         => 'error',
			),
			'std'         => '',
		),
	), Mitech_VC::icon_libraries( array( 'allow_none' => true, 'group' => '' ) ), array(
		array(
			'heading'    => esc_html__( 'Message text', 'mitech' ),
			'type'       => 'textarea_html',
			'param_name' => 'content',
			'std'        => wp_kses( __( '<p>I am message box. Click edit button to change this text.</p>', 'mitech' ), 'mitech-default' ),
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background color', 'mitech' ),
			'param_name'       => 'background_color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )     => '',
				esc_html__( 'Primary', 'mitech' )     => 'primary',
				esc_html__( 'Secondary', 'mitech' )   => 'secondary',
				esc_html__( 'Gradient', 'mitech' )    => 'gradient',
				esc_html__( 'Transparent', 'mitech' ) => 'transparent',
				esc_html__( 'Custom', 'mitech' )      => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom background color', 'mitech' ),
			'param_name'       => 'custom_background_color',
			'dependency'       => array(
				'element' => 'background_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Gradient', 'mitech' ),
			'type'       => 'gradient',
			'param_name' => 'background_gradient',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text color', 'mitech' ),
			'param_name'       => 'text_color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom text color', 'mitech' ),
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
