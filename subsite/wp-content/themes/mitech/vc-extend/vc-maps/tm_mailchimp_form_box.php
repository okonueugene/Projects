<?php

class WPBakeryShortCode_TM_Mailchimp_Form_Box extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Mailchimp Form Box', 'mitech' ),
	'base'                      => 'tm_mailchimp_form_box',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-mailchimp-form',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Widget title', 'mitech' ),
			'param_name'  => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'mitech' ),
		),
		array(
			'heading'     => esc_html__( 'Form Id', 'mitech' ),
			'description' => esc_html__( 'Input the id of form. Leave blank to show default form.', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'form_id',
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
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );
