<?php

class WPBakeryShortCode_TM_Restaurant_Menu extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Restaurant Menu', 'mitech' ),
	'base'                      => 'tm_restaurant_menu',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-restaurant-menu',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'description' => esc_html__( 'Select restaurant menu style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
			),
			'admin_label' => true,
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Menus', 'mitech' ),
			'heading'    => esc_html__( 'Menus', 'mitech' ),
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
					'heading'    => esc_html__( 'Price', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'price',
				),
				array(
					'heading'     => esc_html__( 'Badge', 'mitech' ),
					'type'        => 'dropdown',
					'param_name'  => 'badge',
					'value'       => array(
						esc_html__( 'None', 'mitech' ) => '',
						esc_html__( 'New', 'mitech' )  => 'new',
					),
					'admin_label' => true,
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
