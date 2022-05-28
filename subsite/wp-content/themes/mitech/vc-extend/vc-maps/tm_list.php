<?php

class WPBakeryShortCode_TM_List extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;

		$mitech_shortcode_lg_css .= "$selector{ text-align: {$atts['align']} }";

		if ( $atts['md_align'] !== '' ) {
			$mitech_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$mitech_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$mitech_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		$marker_tmp        = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['marker_color'], $atts['custom_marker_color'] );
		$marker_tmp        .= Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['marker_background_color'], $atts['custom_marker_background_color'] );
		$heading_tmp       = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['title_color'], $atts['custom_title_color'] );
		$heading_hover_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['title_hover_color'], $atts['custom_title_hover_color'] );
		$text_tmp          = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['desc_color'], $atts['custom_desc_color'] );
		$separator_tmp     = Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['separator_color'], $atts['custom_separator_color'] );

		if ( $marker_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .marker { $marker_tmp }";
		}

		if ( $heading_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .title { $heading_tmp }";
		}

		if ( $heading_hover_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .link:hover, $selector .link:hover .title{ $heading_hover_tmp }";
		}

		if ( $text_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .desc { $text_tmp }";
		}

		if ( $atts['list_style'] === 'separator' && $separator_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .list-item + .list-item:before { $separator_tmp }";
		}

		if ( isset( $atts['columns'] ) && $atts['columns'] !== '' ) {
			$arr = explode( ';', $atts['columns'] );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );

				switch ( $tmp[0] ) {
					case 'sm' :
						$mitech_shortcode_sm_css .= "$selector { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
						break;
					case 'md' :
						$mitech_shortcode_md_css .= "$selector { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
						break;
					case 'xs' :
						$mitech_shortcode_xs_css .= "$selector { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
						break;
					case 'lg' :
						$mitech_shortcode_lg_css .= "$selector { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
						break;
				}
			}
		}

		Mitech_VC::get_responsive_css( array(
			'element' => "$selector .title",
			'atts'    => array(
				'font-size' => array(
					'media_str' => $atts['heading_font_size'],
					'unit'      => 'px',
				),
			),
		) );

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'List', 'mitech' ),
	'base'                      => 'tm_list',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Widget title', 'mitech' ),
			'description' => esc_html__( 'What text use as a widget title.', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'widget_title',
		),
		array(
			'heading'     => esc_html__( 'List Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'list_style',
			'value'       => array(
				esc_html__( 'Normal List', 'mitech' )                  => 'normal',
				esc_html__( 'Separator List', 'mitech' )               => 'separator',
				esc_html__( 'Circle List', 'mitech' )                  => 'circle',
				esc_html__( 'Check List', 'mitech' )                   => 'check',
				esc_html__( 'Check List 02', 'mitech' )                => 'check-02',
				esc_html__( 'Icon List', 'mitech' )                    => 'icon',
				esc_html__( '(Automatic) Numbered List 01', 'mitech' ) => 'auto-numbered-01',
				esc_html__( '(Automatic) Numbered List 02', 'mitech' ) => 'auto-numbered-02',
				esc_html__( '(Manual) Numbered List 01', 'mitech' )    => 'manual-numbered-01',
			),
			'admin_label' => true,
			'std'         => 'normal',
		),
		array(
			'heading'    => esc_html__( 'List Direction', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'direction',
			'value'      => array(
				esc_html__( 'Vertical List', 'mitech' )   => 'vertical',
				esc_html__( 'Horizontal List', 'mitech' ) => 'horizontal',
			),
			'std'        => 'vertical',
		),
		array(
			'heading'     => esc_html__( 'Columns', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 1,
				'md' => '',
				'sm' => '',
				'xs' => 1,
			),
			'dependency'  => array(
				'element' => 'direction',
				'value'   => 'vertical',
			),
		),
	),
		Mitech_VC::get_alignment_fields(),
		Mitech_VC::icon_libraries( array(
			'allow_none' => true,
			'group'      => '',
			'dependency' => array(
				'element' => 'list_style',
				'value'   => array(
					'icon',
				),
			),
		) ), array(
			Mitech_VC::get_animation_field(),
			Mitech_VC::extra_class_field(),
			array(
				'group'      => esc_html__( 'Items', 'mitech' ),
				'heading'    => esc_html__( 'Items', 'mitech' ),
				'type'       => 'param_group',
				'param_name' => 'items',
				'params'     => array(
					array(
						'heading'     => esc_html__( 'Number', 'mitech' ),
						'type'        => 'textfield',
						'param_name'  => 'item_number',
						'admin_label' => true,
						'description' => esc_html__( 'Only work with List Type: (Manual) Numbered list.', 'mitech' ),
					),
					array(
						'heading'     => esc_html__( 'Title', 'mitech' ),
						'type'        => 'textfield',
						'param_name'  => 'item_title',
						'admin_label' => true,
					),
					array(
						'heading'    => esc_html__( 'Link', 'mitech' ),
						'type'       => 'vc_link',
						'param_name' => 'link',
					),
					array(
						'heading'    => esc_html__( 'Description', 'mitech' ),
						'type'       => 'textarea',
						'param_name' => 'item_desc',
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'mitech' ),
						'param_name' => 'icon',
						'settings'   => array(
							'emptyIcon'    => true,
							'type'         => 'fontawesome5',
							'iconsPerPage' => 300,
						),
					),
				),
			),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Marker Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'marker_color',
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
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Custom Marker Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_marker_color',
				'dependency'       => array(
					'element' => 'marker_color',
					'value'   => array( 'custom' ),
				),
				'std'              => '#fff',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Marker Background Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'marker_background_color',
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
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Custom Marker Background Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_marker_background_color',
				'dependency'       => array(
					'element' => 'marker_background_color',
					'value'   => array( 'custom' ),
				),
				'std'              => '#fff',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Title Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'title_color',
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
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Custom Title Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_title_color',
				'dependency'       => array(
					'element' => 'title_color',
					'value'   => array( 'custom' ),
				),
				'std'              => '#fff',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Title Hover Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'title_hover_color',
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
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Custom Title Hover Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_title_hover_color',
				'dependency'       => array(
					'element' => 'title_hover_color',
					'value'   => array( 'custom' ),
				),
				'std'              => '#fff',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Description Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'desc_color',
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
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Custom Description Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_desc_color',
				'dependency'       => array(
					'element' => 'desc_color',
					'value'   => array( 'custom' ),
				),
				'std'              => '#fff',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Separator Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'separator_color',
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
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Custom Separator Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_separator_color',
				'dependency'       => array(
					'element' => 'separator_color',
					'value'   => array( 'custom' ),
				),
				'std'              => '#fff',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'       => $styling_tab,
				'heading'     => esc_html__( 'Heading Font Size', 'mitech' ),
				'type'        => 'number_responsive',
				'param_name'  => 'heading_font_size',
				'min'         => 8,
				'suffix'      => 'px',
				'media_query' => array(
					'lg' => '',
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
			),
		), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );
