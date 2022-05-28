<?php

add_filter( 'vc_autocomplete_tm_blog_taxonomies_callback', array(
	'WPBakeryShortCode_TM_Blog',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_blog_taxonomies_render', array(
	Mitech_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_blog_filter_by_callback', array(
	'WPBakeryShortCode_TM_Blog',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_blog_filter_by_render', array(
	Mitech_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Blog extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	function autocomplete_taxonomies_field_search( $search_string ) {
		$data = Mitech_VC::instance()->autocomplete_get_data_from_post_type( $search_string, 'post' );

		return $data;
	}

	public function get_inline_css( $selector = '', $atts ) {
		$style = isset( $atts['style'] ) ? $atts['style'] : '';

		if ( in_array( $style, array(
			'grid-classic',
			'grid-metro',
		), true ) ) {
			Mitech_VC::get_grid_css( $selector, $atts );
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Blog', 'mitech' ),
	'base'     => 'tm_blog',
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-blog',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Blog Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'List Large Image', 'mitech' )      => 'list',
				esc_html__( 'List Large Image 02', 'mitech' )   => 'list-02',
				esc_html__( 'List Left Large Image', 'mitech' ) => 'list-left-large-image',
				esc_html__( 'List Small Image', 'mitech' )      => 'list-small-image',
				esc_html__( 'List Small Image 02', 'mitech' )   => 'list-small-image-02',
				esc_html__( 'Grid Classic', 'mitech' )          => 'grid-classic',
				esc_html__( 'Grid Masonry', 'mitech' )          => 'grid-masonry',
				esc_html__( 'Grid Metro', 'mitech' )            => 'grid-metro',
			),
			'std'         => 'list',
		),
		array(
			'heading'    => esc_html__( 'Metro Layout', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'metro_layout',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Item Size', 'mitech' ),
					'type'        => 'dropdown',
					'param_name'  => 'size',
					'admin_label' => true,
					'value'       => array(
						esc_html__( 'Width 1 - Height 1', 'mitech' ) => '1:1',
						esc_html__( 'Width 1 - Height 2', 'mitech' ) => '1:2',
						esc_html__( 'Width 2 - Height 1', 'mitech' ) => '2:1',
						esc_html__( 'Width 2 - Height 2', 'mitech' ) => '2:2',
					),
					'std'         => '1:1',
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'size' => '2:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
			) ) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'grid-metro' ),
			),
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
				'lg' => '3',
				'md' => '',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid-classic',
					'grid-masonry',
					'grid-metro',
				),
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
					'grid-classic',
					'grid-metro',
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
					'grid-classic',
					'grid-metro',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'mitech' ),
			'description' => esc_html__( 'Controls the gutter of grid. Default 30px', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'gutter',
			'std'         => 30,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid-masonry',
				),
			),
		),
		Mitech_VC::get_animation_field(),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Data Settings', 'mitech' ),
			'type'       => 'hidden',
			'param_name' => 'main_query',
			'std'        => '',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'mitech' ),
			'heading'     => esc_html__( 'Items per page', 'mitech' ),
			'description' => esc_html__( 'Number of items to show per page. Input "-1" to show all posts. Leave blank to use global setting.', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'std'         => '',
			'min'         => -1,
			'max'         => 100,
			'step'        => 1,
		),
		array(
			'group'              => esc_html__( 'Data Settings', 'mitech' ),
			'heading'            => esc_html__( 'Narrow data source', 'mitech' ),
			'description'        => esc_html__( 'Enter categories, tags or custom taxonomies.', 'mitech' ),
			'admin_label'        => true,
			'type'               => 'autocomplete',
			'param_name'         => 'taxonomies',
			'settings'           => array(
				'multiple'       => true,
				'min_length'     => 1,
				'groups'         => true,
				'unique_values'  => true,
				'display_inline' => true,
				'delay'          => 500,
				'auto_focus'     => true,
			),
			'param_holder_class' => 'vc_not-for-custom',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'mitech' ),
			'heading'     => esc_html__( 'Order by', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'orderby',
			'value'       => array(
				esc_html__( 'Date', 'mitech' )                  => 'date',
				esc_html__( 'Post ID', 'mitech' )               => 'ID',
				esc_html__( 'Author', 'mitech' )                => 'author',
				esc_html__( 'Title', 'mitech' )                 => 'title',
				esc_html__( 'Last modified date', 'mitech' )    => 'modified',
				esc_html__( 'Post/page parent ID', 'mitech' )   => 'parent',
				esc_html__( 'Number of comments', 'mitech' )    => 'comment_count',
				esc_html__( 'Menu order/Page Order', 'mitech' ) => 'menu_order',
				esc_html__( 'Meta value', 'mitech' )            => 'meta_value',
				esc_html__( 'Meta value number', 'mitech' )     => 'meta_value_num',
				esc_html__( 'Random order', 'mitech' )          => 'rand',
			),
			'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'mitech' ),
			'std'         => 'date',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'mitech' ),
			'heading'     => esc_html__( 'Sort order', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'order',
			'value'       => array(
				esc_html__( 'Descending', 'mitech' ) => 'DESC',
				esc_html__( 'Ascending', 'mitech' )  => 'ASC',
			),
			'description' => esc_html__( 'Select sorting order.', 'mitech' ),
			'std'         => 'DESC',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'mitech' ),
			'heading'     => esc_html__( 'Meta key', 'mitech' ),
			'description' => esc_html__( 'Input meta key for grid ordering.', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'meta_key',
			'dependency'  => array(
				'element' => 'orderby',
				'value'   => array(
					'meta_value',
					'meta_value_num',
				),
			),
		),
	), Mitech_VC::get_grid_filter_fields(), Mitech_VC::get_grid_pagination_fields(), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );
