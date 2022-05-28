<?php

class WPBakeryShortCode_TM_Search_Form extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Search Form', 'mitech' ),
	'base'                      => 'tm_search_form',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-mailchimp-form',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '1', 'mitech' ) => '1',
			),
			'std'         => '1',
		),
		Mitech_VC::extra_class_field(),
	),
) );
