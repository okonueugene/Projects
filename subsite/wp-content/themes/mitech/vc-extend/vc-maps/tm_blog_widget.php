<?php

add_filter( 'vc_autocomplete_tm_blog_widget_taxonomies_callback', array(
	'WPBakeryShortCode_TM_Blog_Widget',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_blog_widget_taxonomies_render', array(
	Mitech_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Blog_Widget extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	public static function autocomplete_taxonomies_field_search( $search_string ) {
		$data = Mitech_VC::instance()->autocomplete_get_data_from_post_type( $search_string, 'post' );

		return $data;
	}

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Blog Widget', 'mitech' ),
	'base'     => 'tm_blog_widget',
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-blog',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Blog Widget Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'List', 'mitech' )        => 'list',
				esc_html__( 'Simple List', 'mitech' ) => 'simple-list',
			),
			'std'         => 'list',
		),
		array(
			'heading'    => esc_html__( 'Show Thumbnail?', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'show_thumbnail',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
			'std'        => '1',
		),
		array(
			'heading'    => esc_html__( 'Show Categories?', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'show_category',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
			'std'        => '1',
		),
		array(
			'heading'    => esc_html__( 'Show Date?', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'show_date',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
			'std'        => '1',
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'       => esc_html__( 'Data Settings', 'mitech' ),
			'heading'     => esc_html__( 'Items per page', 'mitech' ),
			'description' => esc_html__( 'Number of items to show per page.', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'std'         => 9,
			'min'         => 1,
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
	), Mitech_VC::get_vc_spacing_tab() ),
) );
