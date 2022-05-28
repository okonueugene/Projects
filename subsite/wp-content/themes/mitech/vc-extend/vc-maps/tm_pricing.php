<?php

class WPBakeryShortCode_TM_Pricing extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Pricing Box', 'mitech' ),
	'base'                      => 'tm_pricing',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-pricing',
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
			),
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Highlight', 'mitech' ),
			'description' => esc_html__( 'Checked the box if you want highlight this item.', 'mitech' ),
			'type'        => 'checkbox',
			'param_name'  => 'highlight',
			'value'       => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
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
				esc_html__( 'Default By Style', 'mitech' ) => '',
				esc_html__( 'Full', 'mitech' )             => 'full',
				esc_html__( 'Custom', 'mitech' )           => 'custom',
			),
			'std'         => '',
			'dependency'  => array(
				'element'   => 'image',
				'not_empty' => true,
			),
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
			'heading'     => esc_html__( 'Title', 'mitech' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'title',
		),
		array(
			'heading'     => esc_html__( 'Description', 'mitech' ),
			'description' => esc_html__( 'Controls the text that display under price', 'mitech' ),
			'type'        => 'textarea',
			'param_name'  => 'desc',
		),
		array(
			'heading'          => esc_html__( 'Currency', 'mitech' ),
			'type'             => 'textfield',
			'param_name'       => 'currency',
			'value'            => '$',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'heading'          => esc_html__( 'Price', 'mitech' ),
			'type'             => 'textfield',
			'param_name'       => 'price',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'heading'          => esc_html__( 'Period', 'mitech' ),
			'type'             => 'textfield',
			'param_name'       => 'period',
			'value'            => 'per monthly',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'heading'    => esc_html__( 'Features', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'features',
			'params'     => array(
				array(
					'heading'    => esc_html__( 'Icon', 'mitech' ),
					'type'       => 'iconpicker',
					'param_name' => 'icon',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'fontawesome5',
						'iconsPerPage' => 300,
					),
					'value'      => '',
				),
				array(
					'heading'     => esc_html__( 'Text', 'mitech' ),
					'type'        => 'textarea',
					'param_name'  => 'text',
					'admin_label' => true,
				),
			),
		),
		array(
			'type'       => 'vc_link',
			'heading'    => esc_html__( 'Button', 'mitech' ),
			'param_name' => 'button',
		),
		Mitech_VC::get_animation_field(),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::icon_libraries( array(
		'allow_none' => true,
	) ), Mitech_VC::get_vc_spacing_tab() ),
) );
