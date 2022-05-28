<?php

class WPBakeryShortCode_TM_Slider_Parallel_Scroll extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slides_tab  = esc_html__( 'Slides', 'mitech' );
$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Slider Parallel Scroll', 'mitech' ),
	'base'                      => 'tm_slider_parallel_scroll',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Image Size', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'image_size',
			'value'      => array(
				esc_html__( '1170x560 (1 Column)', 'mitech' ) => '1170x560',
				esc_html__( '1170x600 (1 Column)', 'mitech' ) => '1170x600',
				esc_html__( '600x400 (1 Column)', 'mitech' )  => '600x400',
				esc_html__( '500x338 (3 Columns)', 'mitech' ) => '500x338',
				esc_html__( '500x676 (3 Columns)', 'mitech' ) => '500x676',
				esc_html__( '500x244 (3 Columns)', 'mitech' ) => '500x244',
				esc_html__( 'Custom', 'mitech' )              => 'custom',
				esc_html__( 'Full', 'mitech' )                => 'full',
			),
			'std'        => '500x338',
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
			'heading'     => esc_html__( 'Auto Play', 'mitech' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'mitech' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
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
					'heading'    => esc_html__( 'Text', 'mitech' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
				array(
					'heading'    => esc_html__( 'Link', 'mitech' ),
					'type'       => 'vc_link',
					'param_name' => 'link',
					'value'      => esc_html__( 'Link', 'mitech' ),
				),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Text Align', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'text_align',
			'value'      => array(
				esc_html__( 'Default', 'mitech' ) => '',
				esc_html__( 'Left', 'mitech' )    => 'left',
				esc_html__( 'Center', 'mitech' )  => 'center',
				esc_html__( 'Right', 'mitech' )   => 'right',
				esc_html__( 'Justify', 'mitech' ) => 'justify',
			),
			'std'        => '',

		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
