<?php

add_filter( 'vc_autocomplete_tm_view_demo_items_page_callback', array(
	Mitech_VC::instance(),
	'autocomplete_pages_field_callback',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_view_demo_items_page_render', array(
	Mitech_VC::instance(),
	'autocomplete_pages_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_View_Demo extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_grid_css( $selector, $atts );

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'View Demo', 'mitech' ),
	'base'                      => 'tm_view_demo',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-iconbox',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
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
				'md' => '3',
				'sm' => '2',
				'xs' => '1',
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
		),
		array(
			'heading'    => esc_html__( 'Show Filter', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_enable',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'mitech' ),
			'heading'    => esc_html__( 'Items', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Page', 'mitech' ),
					'type'        => 'autocomplete',
					'param_name'  => 'page',
					'admin_label' => true,
					'settings'    => array(
						'groups' => true,
					),
				),
				array(
					'heading'     => esc_html__( 'Custom Title', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Custom Link', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'link',
				),
				array(
					'heading'    => esc_html__( 'Image', 'mitech' ),
					'type'       => 'attach_image',
					'param_name' => 'image',
				),
				array(
					'heading'     => esc_html__( 'Category', 'mitech' ),
					'description' => esc_html__( 'Multi categories separator with comma', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'category',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Badge', 'mitech' ),
					'type'       => 'dropdown',
					'param_name' => 'badge',
					'value'      => array(
						esc_html__( 'None', 'mitech' )        => '',
						esc_html__( 'Coming Soon', 'mitech' ) => 'coming',
						esc_html__( 'New', 'mitech' )         => 'new',
					),
					'std'        => '',
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
