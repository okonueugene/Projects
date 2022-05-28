<?php

class WPBakeryShortCode_TM_Contact_Form_7_Box extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Contact Form 7 Box', 'mitech' ),
	'base'                      => 'tm_contact_form_7_box',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-contact-form-7',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Form', 'mitech' ),
			'param_name'  => 'id',
			'value'       => Mitech_VC::instance()->get_contact_form_7_list(),
			'save_always' => true,
			'admin_label' => true,
			'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'mitech' ),
		),
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
				esc_html__( '02', 'mitech' ) => '02',
				esc_html__( '03', 'mitech' ) => '03',
			),
			'std'         => '01',
		),
		Mitech_VC::extra_class_field(),
	),
) );
