<?php

class WPBakeryShortCode_TM_Image_Hotspot_Content extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Image Hotspot Content', 'mitech' ),
	'base'                      => 'tm_image_hotspot_content',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-blockquote',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Heading', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
		),

		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Text', 'mitech' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
	),
) );
