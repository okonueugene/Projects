<?php

function mitech_vc_wp_posts_get_inline_css( $selector = '', $atts ) {
	global $mitech_shortcode_lg_css;

	$link_tmp       = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['link_color'], $atts['custom_link_color'] );
	$link_hover_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['link_hover_color'], $atts['custom_link_hover_color'] );

	if ( $link_tmp !== '' ) {
		$mitech_shortcode_lg_css .= "$selector a { $link_tmp }";
	}

	if ( $link_hover_tmp !== '' ) {
		$mitech_shortcode_lg_css .= "$selector a:hover { $link_hover_tmp }";
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_add_params( 'vc_wp_posts', array(
	array(
		'heading'    => esc_html__( 'Sidebar Position', 'mitech' ),
		'type'       => 'dropdown',
		'param_name' => 'sidebar_position',
		'value'      => array(
			esc_html__( 'Left', 'mitech' )  => 'left',
			esc_html__( 'Right', 'mitech' ) => 'right',
		),
		'std'        => 'right',
	),
	array(
		'group'            => $styling_tab,
		'heading'          => esc_html__( 'Link Color', 'mitech' ),
		'type'             => 'dropdown',
		'param_name'       => 'link_color',
		'value'            => array(
			esc_html__( 'Default Color', 'mitech' )   => '',
			esc_html__( 'Primary Color', 'mitech' )   => 'primary',
			esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
			esc_html__( 'Custom Color', 'mitech' )    => 'custom',
		),
		'std'              => '',
		'edit_field_class' => 'vc_col-sm-6 col-break',
	),
	array(
		'group'            => $styling_tab,
		'heading'          => esc_html__( 'Custom Link Color', 'mitech' ),
		'type'             => 'colorpicker',
		'param_name'       => 'custom_link_color',
		'dependency'       => array(
			'element' => 'link_color',
			'value'   => array( 'custom' ),
		),
		'std'              => '#fff',
		'edit_field_class' => 'vc_col-sm-6',
	),
	array(
		'group'            => $styling_tab,
		'heading'          => esc_html__( 'Link Hover Color', 'mitech' ),
		'type'             => 'dropdown',
		'param_name'       => 'link_hover_color',
		'value'            => array(
			esc_html__( 'Default Color', 'mitech' )   => '',
			esc_html__( 'Primary Color', 'mitech' )   => 'primary',
			esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
			esc_html__( 'Custom Color', 'mitech' )    => 'custom',
		),
		'std'              => '',
		'edit_field_class' => 'vc_col-sm-6 col-break',
	),
	array(
		'group'            => $styling_tab,
		'heading'          => esc_html__( 'Custom Link Hover Color', 'mitech' ),
		'type'             => 'colorpicker',
		'param_name'       => 'custom_link_hover_color',
		'dependency'       => array(
			'element' => 'link_hover_color',
			'value'   => array( 'custom' ),
		),
		'std'              => '#fff',
		'edit_field_class' => 'vc_col-sm-6',
	),
) );
