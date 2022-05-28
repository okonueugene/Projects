<?php

class WPBakeryShortCode_TM_Slider_Modern extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slides_tab  = esc_html__( 'Slides', 'mitech' );
$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Slider Modern', 'mitech' ),
	'base'                      => 'tm_slider_modern',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'    => esc_html__( 'Style', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'style',
			'value'      => array(
				esc_html__( '01', 'mitech' ) => '01',
			),
			'std'        => '01',
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
		Mitech_VC::extra_class_field(),
		array(
			'group'      => $slides_tab,
			'heading'    => esc_html__( 'Slides', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Image', 'mitech' ),
					'type'        => 'attach_image',
					'param_name'  => 'image',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Title', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Sub Title', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'sub_title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Text', 'mitech' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
				array(
					'heading'    => esc_html__( 'Button', 'mitech' ),
					'type'       => 'vc_link',
					'param_name' => 'button',
					'value'      => esc_html__( 'Button', 'mitech' ),
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
