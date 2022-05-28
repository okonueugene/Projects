<?php

class WPBakeryShortCode_TM_Slider_Group extends WPBakeryShortCodesContainer {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                    => esc_html__( 'Slider Group', 'mitech' ),
	'base'                    => 'tm_slider_group',
	'as_parent'               => array( 'only' => 'tm_box_icon,tm_box_image,tm_box_large_image,tm_team_member,tm_group' ),
	'content_element'         => true,
	'show_settings_on_create' => false,
	'is_container'            => true,
	'category'                => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                    => 'insight-i insight-i-carousel',
	'js_view'                 => 'VcColumnView',
	'params'                  => array_merge( array(
		array(
			'heading'    => esc_html__( 'Slider Style', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'style',
			'value'      => array(
				esc_html__( 'Normal', 'mitech' )         => '',
				esc_html__( 'With Separator', 'mitech' ) => 'separator',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Content has shadow?', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'content_shadow',
			'value'      => array(
				esc_html__( 'None', 'mitech' )   => '',
				esc_html__( 'Around', 'mitech' ) => '01',
				esc_html__( 'Bottom', 'mitech' ) => '02',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Loop', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'loop',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
			'std'        => '1',
		),
		array(
			'heading'     => esc_html__( 'Auto Play', 'mitech' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'mitech' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
		),
		array(
			'heading'    => esc_html__( 'Navigation', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'nav',
			'value'      => Mitech_VC::get_slider_navs(),
			'std'        => '',
		),
		Mitech_VC::extra_id_field( array(
			'heading'    => esc_html__( 'Slider Button ID', 'mitech' ),
			'param_name' => 'slider_button_id',
			'dependency' => array(
				'element' => 'nav',
				'value'   => array(
					'custom',
				),
			),
		) ),
		array(
			'heading'    => esc_html__( 'Pagination', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => Mitech_VC::get_slider_dots(),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Gutter', 'mitech' ),
			'type'       => 'number',
			'param_name' => 'gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
		),
		array(
			'heading'     => esc_html__( 'Items Display', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
		),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );

