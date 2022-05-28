<?php

class WPBakeryShortCode_TM_Instagram extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;

		$tmp = '';

		if ( $atts['rounded'] !== '' ) {
			$tmp .= Mitech_Helper::get_css_prefix( 'border-radius', "{$atts['rounded']}px" );
		}

		if ( $tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .inner { $tmp }";
		}

		Mitech_VC::get_grid_css( $selector, $atts );

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Instagram', 'mitech' ),
	'base'                      => 'tm_instagram',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-instagram',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid', 'mitech' ) => 'grid',
			),
			'std'         => 'grid',
		),
		array(
			'heading'    => esc_html__( 'User Name', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'username',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Image Size', 'mitech' ),
			'param_name'  => 'size',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Thumbnail 150x150', 'mitech' )   => 'thumbnail',
				esc_html__( 'Small 240x240', 'mitech' )       => 'small',
				esc_html__( 'Small 320x320', 'mitech' )       => 'medium',
				esc_html__( 'Large 480x480', 'mitech' )       => 'large',
				esc_html__( 'Extra Large 640x640', 'mitech' ) => 'extra_large',
				esc_html__( 'Original', 'mitech' )            => 'original',
			),
			'std'         => 'large',
		),
		array(
			'heading'    => esc_html__( 'Number of items', 'mitech' ),
			'type'       => 'number',
			'param_name' => 'number_items',
			'std'        => '6',
		),
		array(
			'heading'     => esc_html__( 'Columns', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 10,
			'step'        => 1,
			'suffix'      => 'column (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'     => esc_html__( 'Columns Gutter', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'column_gutter',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid-caption',
					'metro',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Row Gutter', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'row_gutter',
			'min'         => 0,
			'max'         => 200,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid-caption',
					'metro',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Show User Name', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'show_user_name',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Show overlay likes and comments', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'overlay',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Open links in a new tab.', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'link_target',
			'value'      => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
			'std'        => '1',
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Rounded', 'mitech' ),
			'description' => esc_html__( 'Controls the rounded of images', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'rounded',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
