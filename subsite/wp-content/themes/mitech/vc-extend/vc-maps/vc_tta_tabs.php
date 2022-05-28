<?php

function mitech_vc_tta_tabs_get_inline_css( $selector = '', $atts ) {
	global $mitech_shortcode_lg_css;

	$border_color = $atts['custom_border_color'];

	if ( isset( $border_color ) && $border_color !== '' ) {
		$mitech_shortcode_lg_css .= "$selector .vc_tta-tab { border-color: {$border_color}; }";
	}
}

$_color_field                                               = WPBMap::getParam( 'vc_tta_tabs', 'color' );
$_color_field['value'][ esc_html__( 'Primary', 'mitech' ) ] = 'primary';
$_color_field['std']                                        = 'primary';
vc_update_shortcode_param( 'vc_tta_tabs', $_color_field );

vc_update_shortcode_param( 'vc_tta_tabs', array(
	'param_name' => 'style',
	'value'      => array(
		esc_html__( 'Center Button', 'mitech' )    => 'mitech-01',
		esc_html__( 'Stretch Button', 'mitech' )   => 'mitech-02',
		esc_html__( 'Center Button 02', 'mitech' ) => 'mitech-03',
		esc_html__( 'Classic', 'mitech' )          => 'classic',
		esc_html__( 'Modern', 'mitech' )           => 'modern',
		esc_html__( 'Flat', 'mitech' )             => 'flat',
		esc_html__( 'Outline', 'mitech' )          => 'outline',
	),
) );

vc_add_params( 'vc_tta_tabs', array(
	array(
		'group'      => esc_html__( 'Styling', 'mitech' ),
		'heading'    => esc_html__( 'Border Color', 'mitech' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_border_color',
		'dependency' => array(
			'element' => 'style',
			'value'   => array( 'mitech-02' ),
		),
		'std'        => '',
	),
) );
