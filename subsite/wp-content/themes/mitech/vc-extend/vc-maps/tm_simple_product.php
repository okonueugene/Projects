<?php

class WPBakeryShortCode_TM_Simple_Product extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_grid_css( $selector, $atts );

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Simple Product', 'mitech' ),
	'base'     => 'tm_simple_product',
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-product',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid', 'mitech' ) => 'grid',
			),
			'std'         => 'grid',
		),
		array(
			'heading'     => esc_html__( 'Columns', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 6,
			'step'        => 1,
			'suffix'      => '',
			'media_query' => array(
				'lg' => '4',
				'md' => '',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'grid' ),
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
				),
			),
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Products', 'mitech' ),
			'heading'    => esc_html__( 'Products', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'products',
			'params'     => array(
				array(
					'heading'    => esc_html__( 'Image', 'mitech' ),
					'type'       => 'attach_image',
					'param_name' => 'image',
				),
				array(
					'heading'     => esc_html__( 'Name', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'name',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Category', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'category',
				),
				array(
					'heading'    => esc_html__( 'Description', 'mitech' ),
					'type'       => 'textarea',
					'param_name' => 'desc',
				),
				array(
					'heading'    => esc_html__( 'Regular Price', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'price',
				),
				array(
					'heading'    => esc_html__( 'Sale Price', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'sale_price',
				),
				array(
					'heading'    => esc_html__( 'Currency', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'currency',
				),
				array(
					'heading'    => esc_html__( 'Link', 'mitech' ),
					'type'       => 'vc_link',
					'param_name' => 'link',
				),
				array(
					'heading'    => esc_html__( 'Badge', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'badge',
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );
