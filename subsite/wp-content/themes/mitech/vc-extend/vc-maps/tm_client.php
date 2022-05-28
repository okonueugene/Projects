<?php

class WPBakeryShortCode_TM_Client extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		if ( in_array( $atts['style'], array( 'grid' ) ) ) {
			Mitech_VC::get_grid_css( $selector, $atts );
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slides_tab = esc_html__( 'Slides', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Client Logos', 'mitech' ),
	'base'                      => 'tm_client',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Carousel', 'mitech' ) => 'carousel',
				esc_html__( 'Grid', 'mitech' )     => 'grid',
			),
			'std'         => 'carousel',
		),
		array(
			'heading'     => esc_html__( 'Alignment', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'alignment',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Left', 'mitech' ) => 'align-left',
				esc_html__( 'Center', 'mitech' )     => 'align-center',
				esc_html__( 'Right', 'mitech' )     => 'align-right',
			),
			'std'         => 'align-center',
		),
		array(
			'heading'     => esc_html__( 'Effect', 'mitech' ),
			'description' => esc_html__( 'Working when client has both images.', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'effect',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Scale up', 'mitech' ) => '',
				esc_html__( 'Move up', 'mitech' )  => 'move-up',
			),
			'std'         => '',
		),
		array(
			'heading'     => esc_html__( 'Hover Type', 'mitech' ),
			'description' => esc_html__( 'Working when client has only single image.', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'hover',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'None', 'mitech' )                => '',
				esc_html__( 'Grayscale to normal', 'mitech' ) => 'grayscale',
				esc_html__( 'Opacity to normal', 'mitech' )   => 'opacity',
				esc_html__( 'Normal to opacity', 'mitech' )   => 'faded',
			),
			'std'         => '',
		),
		array(
			'heading'     => esc_html__( 'Items Display', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 4,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Items Display', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 6,
				'md' => 4,
				'sm' => 3,
				'xs' => 2,
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Gutter', 'mitech' ),
			'type'       => 'number',
			'param_name' => 'gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
		),
		array(
			'heading'    => esc_html__( 'Loop', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'loop',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
			'std'        => '1',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Auto Play', 'mitech' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'mitech' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
			'std'         => 5000,
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Navigation', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Mitech_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		Mitech_VC::extra_id_field( array(
			'heading'    => esc_html__( 'Slider Button ID', 'mitech' ),
			'param_name' => 'slider_button_id',
			'dependency' => array(
				'element' => 'carousel_nav',
				'value'   => array(
					'custom',
				),
			),
		) ),
		array(
			'heading'    => esc_html__( 'Pagination', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Mitech_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => $slides_tab,
			'heading'    => esc_html__( 'Slides', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Image', 'mitech' ),
					'type'        => 'attach_image',
					'param_name'  => 'image',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Image Hover', 'mitech' ),
					'type'        => 'attach_image',
					'param_name'  => 'image_hover',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Link', 'mitech' ),
					'type'       => 'vc_link',
					'param_name' => 'link',
					'value'      => esc_html__( 'Link', 'mitech' ),
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
