<?php

class WPBakeryShortCode_TM_Gradation extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;

		$icon_tmp    = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$icon_tmp    .= Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['icon_background_color'], $atts['custom_icon_background_color'] );
		$heading_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['heading_color'], $atts['custom_heading_color'] );
		$text_tmp    = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );
		$dot_tmp     = Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['dot_color'], $atts['custom_dot_color'] );

		if ( $icon_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .icon{ $icon_tmp }";
		}

		if ( $heading_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .heading { $heading_tmp }";
		}

		if ( $text_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .text{ $text_tmp }";
		}

		if ( $dot_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .dot{ $dot_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Gradation', 'mitech' ),
	'base'                      => 'tm_gradation',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Style 01', 'mitech' ) => '01',
				esc_html__( 'Style 02', 'mitech' ) => '02',
			),
			'admin_label' => true,
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Items', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Title', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Description', 'mitech' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'mitech' ),
					'param_name' => 'icon',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'fontawesome5',
						'iconsPerPage' => 300,
					),
				),
				array(
					'heading'    => esc_html__( 'Button', 'mitech' ),
					'type'       => 'vc_link',
					'param_name' => 'button',
					'value'      => esc_html__( 'Button', 'mitech' ),
				),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Heading Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'heading_color',
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
			'heading'    => esc_html__( 'Custom Heading Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_heading_color',
			'dependency' => array(
				'element' => 'heading_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#222',
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
			'std'        => '#999',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Icon Background Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_background_color',
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
			'param_name' => 'custom_icon_background_color',
			'dependency' => array(
				'element' => 'icon_background_color',
				'value'   => 'custom',
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Text Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'text_color',
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
			'heading'    => esc_html__( 'Custom Text Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_text_color',
			'dependency' => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#999',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Dot Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'dot_color',
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
			'heading'    => esc_html__( 'Custom Dot Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_dot_color',
			'dependency' => array(
				'element' => 'dot_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
