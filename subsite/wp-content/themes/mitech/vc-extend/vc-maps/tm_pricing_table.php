<?php

class WPBakeryShortCode_TM_Pricing_Table extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Pricing Table', 'mitech' ),
	'base'                      => 'tm_pricing_table',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-pricing',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Heading', 'mitech' ),
			'type'        => 'textarea',
			'admin_label' => true,
			'param_name'  => 'heading',
		),
		array(
			'heading'     => esc_html__( 'Feature Labels', 'mitech' ),
			'description' => esc_html__( 'Input each feature label per line.', 'mitech' ),
			'type'        => 'textarea',
			'param_name'  => 'features_labels',
			'admin_label' => true,
		),
		array(
			'heading'          => esc_html__( 'Currency', 'mitech' ),
			'type'             => 'textfield',
			'param_name'       => 'currency',
			'value'            => '$',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'heading'          => esc_html__( 'Period', 'mitech' ),
			'type'             => 'textfield',
			'param_name'       => 'period',
			'value'            => '/ monthly',
			'edit_field_class' => 'vc_col-sm-4',
		),
		Mitech_VC::get_animation_field(),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'mitech' ),
			'heading'    => esc_html__( 'Items', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Featured', 'mitech' ),
					'description' => esc_html__( 'Checked the box if you want make this item featured', 'mitech' ),
					'type'        => 'checkbox',
					'param_name'  => 'featured',
					'value'       => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
				),
				array(
					'heading'     => esc_html__( 'Title', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'          => esc_html__( 'Price', 'mitech' ),
					'type'             => 'textfield',
					'param_name'       => 'price',
					'edit_field_class' => 'vc_col-sm-4',
				),
				array(
					'heading'     => esc_html__( 'Feature List', 'mitech' ),
					'type'        => 'textarea',
					'param_name'  => 'features',
					'description' => esc_html__( 'Input each feature per line, use [check] for check icon.', 'mitech' ),
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Button', 'mitech' ),
					'param_name' => 'button',
				),
			),
		),
	), Mitech_VC::icon_libraries( array(
		'allow_none' => true,
	) ), Mitech_VC::get_vc_spacing_tab() ),
) );
