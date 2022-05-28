<?php

class WPBakeryShortCode_TM_Image_Hotspot extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Image Hotspot', 'mitech' ),
	'base'                      => 'tm_image_hotspot',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-blockquote',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'mitech' )     => '',
				esc_html__( 'With Signal', 'mitech' ) => 'signal',
			),
			'std'         => '',
		),
		array(
			'heading'    => esc_html__( 'Image Hotspot', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'hotspot',
			'value'      => Mitech_Points_Image::instance()->get_vc_dropdown_option(),
		),
	),
) );
