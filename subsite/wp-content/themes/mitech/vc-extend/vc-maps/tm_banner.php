<?php

class WPBakeryShortCode_TM_Banner extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Banner', 'mitech' ),
	'base'     => 'tm_banner',
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-product-categories',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
				esc_html__( '02', 'mitech' ) => '02',
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Image', 'mitech' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		array(
			'heading'     => esc_html__( 'Image Size', 'mitech' ),
			'description' => esc_html__( 'Controls the size of image.', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'image_size',
			'value'       => array(
				esc_html__( 'Full', 'mitech' )   => 'full',
				esc_html__( 'Custom', 'mitech' ) => 'custom',
			),
			'std'         => 'full',
		),
		array(
			'heading'          => esc_html__( 'Image Width', 'mitech' ),
			'type'             => 'number',
			'param_name'       => 'image_size_width',
			'min'              => 0,
			'max'              => 1920,
			'step'             => 10,
			'suffix'           => 'px',
			'dependency'       => array(
				'element' => 'image_size',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'heading'          => esc_html__( 'Image Height', 'mitech' ),
			'type'             => 'number',
			'param_name'       => 'image_size_height',
			'min'              => 0,
			'max'              => 1920,
			'step'             => 10,
			'suffix'           => 'px',
			'dependency'       => array(
				'element' => 'image_size',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
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
		),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );
