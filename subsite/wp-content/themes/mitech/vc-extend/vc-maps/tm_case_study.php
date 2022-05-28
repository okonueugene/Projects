<?php

add_filter( 'vc_autocomplete_tm_case_study_taxonomies_callback', array(
	'WPBakeryShortCode_TM_Case_Study',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_case_study_taxonomies_render', array(
	Mitech_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_case_study_filter_by_callback', array(
	'WPBakeryShortCode_TM_Case_Study',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_case_study_filter_by_render', array(
	Mitech_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Case_Study extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	public static function autocomplete_taxonomies_field_search( $search_string ) {
		$data = Mitech_VC::instance()->autocomplete_get_data_from_post_type( $search_string, 'case_study' );

		return $data;
	}

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;

		extract( $atts );

		$style = isset( $atts['style'] ) ? $atts['style'] : '';

		if ( in_array( $style, array(
			'grid',
			'metro',
			'metro-02',
		), true ) ) {
			Mitech_VC::get_grid_css( $selector, $atts );
		}

		$image_tmp = '';

		if ( $atts['custom_styling_enable'] === '1' ) {
			Mitech_VC::get_responsive_css( array(
				'element' => "$selector .post-overlay-title",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['overlay_title_font_size'],
						'unit'      => 'px',
					),
				),
			) );

			if ( isset( $atts['image_rounded'] ) && $atts['image_rounded'] !== '' ) {
				$image_tmp .= Mitech_Helper::get_css_prefix( 'border-radius', $atts['image_rounded'] );
			}
		}

		if ( $image_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .post-thumbnail img { {$image_tmp} }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'     => esc_html__( 'Case Study', 'mitech' ),
	'base'     => 'tm_case_study',
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-portfoliogrid',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Classic', 'mitech' )         => 'grid',
				esc_html__( 'Grid Metro', 'mitech' )           => 'metro',
				esc_html__( 'Grid Metro 02', 'mitech' )        => 'metro-02',
				esc_html__( 'Grid Masonry', 'mitech' )         => 'masonry',
				esc_html__( 'Grid Justify Gallery', 'mitech' ) => 'justified',
				esc_html__( 'Left Image List', 'mitech' )      => 'list',
				esc_html__( 'Carousel', 'mitech' )             => 'carousel',
			),
			'std'         => 'grid',
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
					'size' => '1:1',
				),
				array(
					'size' => '2:2',
				),
				array(
					'size' => '1:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:1',
				),
				array(
					'size' => '1:1',
				),
			) ) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'metro',
					'metro-02',
				),
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
					'grid',
					'metro',
					'metro-02',
					'masonry',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'mitech' ),
			'description' => esc_html__( 'Controls the gutter of grid.', 'mitech' ),
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
					'masonry',
					'justified',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Column Gutter', 'mitech' ),
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
					'metro',
					'metro-02',
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
					'metro',
					'metro-02',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Image Size', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'image_size',
			'value'      => array(
				esc_attr__( 'Default By Style', 'mitech' ) => '',
				esc_attr( '480x480' )                      => '480x480',
				esc_attr( '481x325' )                      => '481x325',
			),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Row Height', 'mitech' ),
			'description' => esc_html__( 'Controls the height of grid row.', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'justify_row_height',
			'std'         => 300,
			'min'         => 50,
			'max'         => 500,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Max Row Height', 'mitech' ),
			'description' => esc_html__( 'Controls the max height of grid row. Leave blank or 0 keep it disabled.', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'justify_max_row_height',
			'std'         => 0,
			'min'         => 0,
			'max'         => 500,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Last row alignment', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'justify_last_row_alignment',
			'value'      => array(
				esc_html__( 'Justify', 'mitech' )                              => 'justify',
				esc_html__( 'Left', 'mitech' )                                 => 'nojustify',
				esc_html__( 'Center', 'mitech' )                               => 'center',
				esc_html__( 'Right', 'mitech' )                                => 'right',
				esc_html__( 'Hide ( if row can not be justified )', 'mitech' ) => 'hide',
			),
			'std'        => 'justify',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Enable Popup Video?', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'enable_popup_video',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'masonry',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Caption Style', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'caption_style',
			'value'      => array(
				esc_html__( 'None', 'mitech' )     => '',
				esc_html__( 'Style 01', 'mitech' ) => '01',
				esc_html__( 'Style 02', 'mitech' ) => '02',
			),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'masonry',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Overlay Style', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'overlay_style',
			'value'      => array(
				esc_html__( 'None', 'mitech' )     => '',
				esc_html__( 'Faded 01', 'mitech' ) => 'faded',
				esc_html__( 'Faded 02', 'mitech' ) => 'faded-02',
				esc_html__( 'Faded 03', 'mitech' ) => 'faded-03',
				esc_html__( 'Parallax', 'mitech' ) => 'parallax',
			),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'metro-02',
					'masonry',
					'justified',
				),
			),
		),
		Mitech_VC::get_animation_field( array(
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'metro-02',
					'masonry',
					'justified',
				),
			),
		) ),
		Mitech_VC::extra_class_field(),
		Mitech_VC::extra_id_field(),
		array(
			'group'      => esc_html__( 'Data Settings', 'mitech' ),
			'type'       => 'hidden',
			'param_name' => 'main_query',
			'std'        => '',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'mitech' ),
			'heading'     => esc_html__( 'Items per page', 'mitech' ),
			'description' => esc_html__( 'Number of items to show per page. Leave blank to use default option.', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'std'         => '',
			'min'         => 1,
			'max'         => 100,
			'step'        => 1,
		),
		array(
			'group'              => esc_html__( 'Data Settings', 'mitech' ),
			'heading'            => esc_html__( 'Narrow data source', 'mitech' ),
			'description'        => esc_html__( 'Enter categories, tags or custom taxonomies.', 'mitech' ),
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
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Styling Enable', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'custom_styling_enable',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Overlay Title Font Size', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'overlay_title_font_size',
			'min'         => 8,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Image Rounded', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'image_rounded',
			'description' => esc_html__( 'Input a valid radius. For e.g: 10px. Leave blank to use default.', 'mitech' ),
		),
	), Mitech_VC::get_slider_options( array( 'dependency' => array( 'carousel' ) ) ), Mitech_VC::get_grid_filter_fields(), Mitech_VC::get_grid_pagination_fields(), Mitech_VC::get_vc_spacing_tab() ),
) );

