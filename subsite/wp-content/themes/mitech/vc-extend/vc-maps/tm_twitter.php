<?php

class WPBakeryShortCode_TM_Twitter extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;

		$icon_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$text_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );

		if ( $icon_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .tweet:before{ $icon_tmp }";
		}

		if ( $text_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .tweet{ $text_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slider_tab  = esc_html__( 'Slider Settings', 'mitech' );
$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Twitter', 'mitech' ),
	'base'                      => 'tm_twitter',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-twitter',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'List', 'mitech' )               => 'list',
				esc_html__( 'Slider', 'mitech' )             => 'slider',
				esc_html__( 'Slider Quote', 'mitech' )       => 'slider-quote',
				esc_html__( 'Slider Quote Light', 'mitech' ) => 'slider-quote-light',
			),
			'std'         => 'slider-quote',
		),
		array(
			'heading'    => esc_html__( 'Consumer Key', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'consumer_key',
		),
		array(
			'heading'    => esc_html__( 'Consumer Secret', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'consumer_secret',
		),
		array(
			'heading'    => esc_html__( 'Access Token', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'access_token',
		),
		array(
			'heading'    => esc_html__( 'Access Token Secret', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'access_token_secret',
		),
		array(
			'heading'    => esc_html__( 'Twitter Username', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'username',
		),
		array(
			'heading'    => esc_html__( 'Number of tweets', 'mitech' ),
			'type'       => 'number',
			'param_name' => 'number_items',
		),
		array(
			'heading'    => esc_html__( 'Heading', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
			'std'        => esc_html__( 'From Twitter', 'mitech' ),
		),
		array(
			'heading'    => esc_html__( 'Show date.', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'show_date',
			'value'      => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'       => $slider_tab,
			'heading'     => esc_html__( 'Speed', 'mitech' ),
			'description' => esc_html__( 'Duration of transition between slides (in ms). For e.g: 1000. Leave blank to use default.', 'mitech' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_speed',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
					'slider-quote-light',
				),
			),
		),
		array(
			'group'       => $slider_tab,
			'heading'     => esc_html__( 'Auto Play', 'mitech' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'mitech' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_auto_play',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
					'slider-quote-light',
				),
			),
		),
		array(
			'group'      => $slider_tab,
			'heading'    => esc_html__( 'Navigation', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Mitech_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
					'slider-quote-light',
				),
			),
		),
		Mitech_VC::extra_id_field( array(
			'group'      => $slider_tab,
			'heading'    => esc_html__( 'Slider Button ID', 'mitech' ),
			'param_name' => 'slider_button_id',
			'dependency' => array(
				'element' => 'carousel_nav',
				'value'   => array(
					'custom',
				),
			),
		) ),
		array(
			'group'      => $slider_tab,
			'heading'    => esc_html__( 'Pagination', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Mitech_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
					'slider-quote-light',
				),
			),
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Icon Color', 'mitech' ),
			'type'             => 'dropdown',
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Icon Color', 'mitech' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_icon_color',
			'dependency'       => array(
				'element' => 'icon_color',
				'value'   => 'custom',
			),
			'std'              => '#999',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Text Color', 'mitech' ),
			'type'             => 'dropdown',
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Text Color', 'mitech' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#999',
			'edit_field_class' => 'vc_col-sm-6',
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
