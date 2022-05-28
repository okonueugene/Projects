<?php

class WPBakeryShortCode_TM_List_Selection extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'List Selection', 'mitech' ),
	'base'                      => 'tm_list_selection',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Default', 'mitech' ) => '',
				esc_html__( '01', 'mitech' )      => '01',
			),
			'admin_label' => true,
			'std'         => '',
		),
		array(
			'heading'     => esc_html__( 'Place Holder Text', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'placeholder',
			'admin_label' => true,
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'mitech' ),
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
					'heading'    => esc_html__( 'Link', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'link',
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
