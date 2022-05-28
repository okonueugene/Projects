<?php

class WPBakeryShortCode_TM_Timeline extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Timeline', 'mitech' ),
	'base'                      => 'tm_timeline',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-timeline',
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
		Mitech_VC::extra_class_field(),
		Mitech_VC::extra_id_field(),
		array(
			'group'      => esc_html__( 'Items', 'mitech' ),
			'heading'    => esc_html__( 'Items', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'    => esc_html__( 'Image', 'mitech' ),
					'type'       => 'attach_image',
					'param_name' => 'image',
				),
				array(
					'heading'     => esc_html__( 'Title', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Date Time', 'mitech' ),
					'description' => esc_html__( 'Date and time format (yyyy/mm/dd hh:mm).', 'mitech' ),
					'type'        => 'datetimepicker',
					'param_name'  => 'datetime',
					'value'       => '',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Text', 'mitech' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );
