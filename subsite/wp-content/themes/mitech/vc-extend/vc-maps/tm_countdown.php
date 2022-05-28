<?php

class WPBakeryShortCode_TM_CountDown extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;
		$skin = '';
		extract( $atts );

		if ( $skin === 'custom' ) {
			$number_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['number_color'], $atts['custom_number_color'] );
			$text_tmp   = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );

			if ( $number_tmp !== '' ) {
				$mitech_shortcode_lg_css .= "$selector .number { $number_tmp }";
			}

			if ( $text_tmp !== '' ) {
				$mitech_shortcode_lg_css .= "$selector .text { $text_tmp }";
			}
		}

		if ( $atts['align'] !== '' ) {
			$mitech_shortcode_lg_css .= "$selector { text-align: {$atts['align']}; }";
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

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Countdown', 'mitech' ),
	'base'                      => 'tm_countdown',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-countdownclock',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
				esc_html__( '02', 'mitech' ) => '02',
				esc_html__( '03', 'mitech' ) => '03',
			),
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Skin', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Custom', 'mitech' ) => 'custom',
				esc_html__( 'Dark', 'mitech' )   => 'dark',
				esc_html__( 'Light', 'mitech' )  => 'light',
			),
			'std'         => 'dark',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Number Color', 'mitech' ),
			'param_name'       => 'number_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'              => 'secondary',
			'edit_field_class' => 'vc_col-sm-6 col-break',
			'dependency'       => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Number Color', 'mitech' ),
			'param_name'       => 'custom_number_color',
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'       => array(
				'element' => 'number_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text Color', 'mitech' ),
			'param_name'       => 'text_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'              => 'custom',
			'edit_field_class' => 'vc_col-sm-6 col-break',
			'dependency'       => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Text Color', 'mitech' ),
			'param_name'       => 'custom_text_color',
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#ababab',
		),
	), Mitech_VC::get_alignment_fields(),
		array(
			array(
				'heading'     => esc_html__( 'Date Time', 'mitech' ),
				'description' => esc_html__( 'Date and time format (yyyy/mm/dd hh:mm).', 'mitech' ),
				'type'        => 'datetimepicker',
				'param_name'  => 'datetime',
				'value'       => '',
				'admin_label' => true,
				'settings'    => array(
					'minDate' => 0,
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( '"Days" text', 'mitech' ),
				'description' => esc_html__( 'Leave blank to use default.', 'mitech' ),
				'param_name'  => 'days',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( '"Hours" text', 'mitech' ),
				'description' => esc_html__( 'Leave blank to use default.', 'mitech' ),
				'param_name'  => 'hours',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( '"Minutes" text', 'mitech' ),
				'description' => esc_html__( 'Leave blank to use default.', 'mitech' ),
				'param_name'  => 'minutes',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( '"Seconds" text', 'mitech' ),
				'description' => esc_html__( 'Leave blank to use default.', 'mitech' ),
				'param_name'  => 'seconds',
			),
			Mitech_VC::extra_class_field(),
		),
		Mitech_VC::get_vc_spacing_tab() ),
) );

