<?php

class WPBakeryShortCode_TM_Simple_Job_Listing extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Simple Job Listing', 'mitech' ),
	'base'                      => 'tm_simple_job_listing',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		Mitech_VC::get_animation_field(),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Jobs', 'mitech' ),
			'heading'    => esc_html__( 'Jobs', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'jobs',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Job Name', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'name',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Time', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'time',
				),
				array(
					'heading'    => esc_html__( 'Description', 'mitech' ),
					'type'       => 'textarea',
					'param_name' => 'description',
				),
				array(
					'heading'    => esc_html__( 'Button', 'mitech' ),
					'type'       => 'vc_link',
					'param_name' => 'button',
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
