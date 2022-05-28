<?php

class WPBakeryShortCode_VC_Wp_Custom_HTML extends WPBakeryShortCode {

}

vc_map( array(
	'name'     => esc_html__( 'WP Custom HTML', 'mitech' ),
	'base'     => 'vc_wp_custom_html',
	'category' => esc_html__( 'WordPress Widgets', 'mitech' ),
	'icon'     => 'icon-wpb-wp',
	'class'    => 'wpb_vc_wp_widget',
	'params'   => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Widget title', 'mitech' ),
			'param_name'  => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'mitech' ),
		),
		array(
			'type'       => 'textarea_raw_html',
			'holder'     => 'div',
			'heading'    => esc_html__( 'Text', 'mitech' ),
			'param_name' => 'content',
		),
		Mitech_VC::extra_id_field(),
		Mitech_VC::extra_class_field(),
	),
) );
