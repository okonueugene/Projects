<?php

add_filter( 'vc_autocomplete_tm_testimonial_taxonomies_callback', array(
	'WPBakeryShortCode_TM_Testimonial',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_testimonial_taxonomies_render', array(
	Mitech_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Testimonial extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	public static function autocomplete_taxonomies_field_search( $search_string ) {
		$data = Mitech_VC::instance()->autocomplete_get_data_from_post_type( $search_string, 'testimonial' );

		return $data;
	}

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;

		$text_tmp    = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );
		$name_tmp    = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['name_color'], $atts['custom_name_color'] );
		$by_line_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['by_line_color'], $atts['custom_by_line_color'] );

		if ( $text_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .testimonial-desc { $text_tmp }";
		}

		if ( $name_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .testimonial-name { $name_tmp }";
		}

		if ( $by_line_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .testimonial-by-line { $by_line_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Slider Options', 'mitech' );
$styling_group  = esc_html__( 'Styling', 'mitech' );

$slider_styles = array(
	'carousel',
	'carousel-02',
	'slider',
	'slider-02',
	'slider-big',
);

vc_map( array(
	'name'                      => esc_html__( 'Testimonials', 'mitech' ),
	'base'                      => 'tm_testimonial',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-testimonials',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Carousel', 'mitech' )    => 'carousel',
				esc_html__( 'Carousel 02', 'mitech' ) => 'carousel-02',
				esc_html__( 'Slider', 'mitech' )      => 'slider',
				esc_html__( 'Slider 02', 'mitech' )   => 'slider-02',
				esc_html__( 'Slider Big', 'mitech' )   => 'slider-big',
			),
			'std'         => 'carousel',
		),
		/*array(
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
					'grid',
				),
			),
		),*/
		Mitech_VC::extra_class_field(),
		array(
			'group'       => esc_html__( 'Data Settings', 'mitech' ),
			'heading'     => esc_html__( 'Number', 'mitech' ),
			'description' => esc_html__( 'Number of items to show.', 'mitech' ),
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
			'group'            => $styling_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text Color', 'mitech' ),
			'param_name'       => 'text_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Text Color', 'mitech' ),
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Name Color', 'mitech' ),
			'param_name'       => 'name_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Name Color', 'mitech' ),
			'param_name'       => 'custom_name_color',
			'dependency'       => array(
				'element' => 'name_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'By Line Color', 'mitech' ),
			'param_name'       => 'by_line_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom By Line Color', 'mitech' ),
			'param_name'       => 'custom_by_line_color',
			'dependency'       => array(
				'element' => 'by_line_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'heading'    => esc_html__( 'Loop', 'mitech' ),
			'group'      => $carousel_group,
			'type'       => 'checkbox',
			'param_name' => 'loop',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
			'std'        => '1',
			'dependency' => array(
				'element' => 'style',
				'value'   => $slider_styles,
			),
		),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Auto Play', 'mitech' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'mitech' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
			'std'         => 5000,
			'dependency'  => array(
				'element' => 'style',
				'value'   => $slider_styles,
			),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Navigation', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'nav',
			'value'      => Mitech_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => $slider_styles,
			),
		),
		Mitech_VC::extra_id_field( array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Slider Button ID', 'mitech' ),
			'param_name' => 'slider_button_id',
			'dependency' => array(
				'element' => 'nav',
				'value'   => array(
					'custom',
				),
			),
		) ),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Pagination', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => Mitech_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => $slider_styles,
			),
		),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Gutter', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_gutter',
			'min'         => 0,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => 30,
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => $slider_styles,
			),
		),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Items Display', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => '',
				'sm' => 2,
				'xs' => 1,
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'carousel-02',
				),
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
