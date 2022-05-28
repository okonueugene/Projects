<?php

class WPBakeryShortCode_TM_Social_Networks extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;

		$tmp = $link_css = $link_hover_css = $icon_css = $icon_hover_css = $text_css = $text_hover_css = '';
		extract( $atts );

		$icon_css       .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$icon_hover_css .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_hover_color'], $atts['custom_icon_hover_color'] );
		$text_css       .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );
		$text_hover_css .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_hover_color'], $atts['custom_text_hover_color'] );
		$link_css       .= Mitech_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['border_color'], $atts['custom_border_color'] );
		$link_hover_css .= Mitech_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['border_hover_color'], $atts['custom_border_hover_color'] );
		$link_css       .= Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'] );
		$link_hover_css .= Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_hover_color'], $atts['custom_background_hover_color'] );

		if ( $atts['align'] !== '' ) {
			$tmp .= "text-align: {$atts['align']};";
		}

		if ( $atts['md_align'] !== '' ) {
			$mitech_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$mitech_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$mitech_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		if ( $tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector { $tmp }";
		}

		if ( $icon_css !== '' ) {
			if ( in_array( $atts['style'], array(
				'icon-title',
			) ) ) {
				$mitech_shortcode_lg_css .= "$selector .link-icon { $icon_css }";
			} else {
				$mitech_shortcode_lg_css .= "$selector .link { $icon_css }";
			}
		}

		if ( $icon_hover_css !== '' ) {
			if ( in_array( $atts['style'], array(
				'icon-title',
			) ) ) {
				$mitech_shortcode_lg_css .= "$selector .item:hover .link-icon { $icon_hover_css }";

			} else {
				$mitech_shortcode_lg_css .= "$selector .item:hover .link { $icon_hover_css }";
			}
		}

		if ( $text_css !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .link-text { $text_css }";
		}

		if ( $text_hover_css !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .item:hover .link-text { $text_hover_css }";
		}

		if ( $link_css !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .link { $link_css }";
		}

		if ( $link_hover_css !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .item:hover .link { $link_hover_css }";
		}

		if ( $atts['style'] === 'title' ) {
			$_text_css         = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );
			$_border_css       = Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['border_color'], $atts['custom_border_color'] );
			$_border_hover_css = Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['border_hover_color'], $atts['custom_border_hover_color'] );

			if ( $_text_css !== '' ) {
				$mitech_shortcode_lg_css .= "$selector .link:before { $_text_css }";
			}

			if ( $_border_css !== '' ) {
				$mitech_shortcode_lg_css .= "$selector .link-text:before { $_border_css }";
			}

			if ( $_border_hover_css !== '' ) {
				$mitech_shortcode_lg_css .= "$selector .link-text:after { $_border_hover_css }";
			}
		}
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Social Networks', 'mitech' ),
	'base'                      => 'tm_social_networks',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-social-networks',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Icons', 'mitech' )              => 'icons',
				esc_html__( 'Large Icons', 'mitech' )        => 'large-icons',
				esc_html__( 'Extra Large Icons', 'mitech' )  => 'extra-large-icons',
				esc_html__( 'Flat Rounded Icon', 'mitech' )  => 'flat-rounded-icon',
				esc_html__( 'Solid Rounded Icon', 'mitech' ) => 'solid-rounded-icon',
				esc_html__( 'Title', 'mitech' )              => 'title',
				esc_html__( 'Icon + Title', 'mitech' )       => 'icon-title',
			),
			'std'         => 'icons',
		),
		array(
			'heading'     => esc_html__( 'Layout', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'layout',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Inline', 'mitech' )    => 'inline',
				esc_html__( 'List', 'mitech' )      => 'list',
				esc_html__( '2 Columns', 'mitech' ) => 'two-columns',
			),
			'std'         => 'inline',
		),
	), Mitech_VC::get_alignment_fields(), array(
		array(
			'heading'    => esc_html__( 'Show tooltip as item title.', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'tooltip_enable',
			'value'      => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
		),
		array(
			'heading'    => esc_html__( 'Tooltip Skin', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'tooltip_skin',
			'value'      => Mitech_VC::get_tooltip_skin_list(),
			'std'        => '',
			'dependency' => array(
				'element' => 'tooltip_enable',
				'value'   => '1',
			),
		),
		array(
			'heading'    => esc_html__( 'Tooltip Position', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'tooltip_position',
			'value'      => array(
				esc_html__( 'Top', 'mitech' )    => 'top',
				esc_html__( 'Right', 'mitech' )  => 'right',
				esc_html__( 'Bottom', 'mitech' ) => 'bottom',
				esc_html__( 'Left', 'mitech' )   => 'left',
			),
			'std'        => 'top',
			'dependency' => array(
				'element' => 'tooltip_enable',
				'value'   => '1',
			),
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'       => esc_html__( 'Items', 'mitech' ),
			'heading'     => esc_html__( 'Use social network links in Customize?', 'mitech' ),
			'description' => '<a href="' . admin_url( '/customize.php?autofocus[section]=socials' ) . '" target="_blank">' . esc_html__( 'Edit social network links', 'mitech' ) . '</a>',
			'type'        => 'checkbox',
			'param_name'  => 'use_global',
			'value'       => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
			'std'         => '1',
		),
		array(
			'group'      => esc_html__( 'Items', 'mitech' ),
			'heading'    => esc_html__( 'Custom Links', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Title', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Link', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'link',
				),
				array(
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'mitech' ),
					'param_name'  => 'icon_fontawesome5',
					'value'       => 'fab fa-facebook',
					'settings'    => array(
						'emptyIcon'    => true,
						'type'         => 'fontawesome5',
						'iconsPerPage' => 400,
					),
					'description' => esc_html__( 'Select icon from library.', 'mitech' ),
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'title'             => esc_html__( 'Facebook', 'mitech' ),
					'link'              => '#',
					'icon_fontawesome5' => 'fab fa-facebook',
				),
				array(
					'title'             => esc_html__( 'Twitter', 'mitech' ),
					'link'              => '#',
					'icon_fontawesome5' => 'fab fa-twitter',
				),
				array(
					'title'             => esc_html__( 'Instagram', 'mitech' ),
					'link'              => '#',
					'icon_fontawesome5' => 'fab fa-instagram',
				),
				array(
					'title'             => esc_html__( 'Dribbble', 'mitech' ),
					'link'              => '#',
					'icon_fontawesome5' => 'fab fa-dribbble',
				),
				array(
					'title'             => esc_html__( 'Pinterest', 'mitech' ),
					'link'              => '#',
					'icon_fontawesome5' => 'fab fa-pinterest',
				),
			) ) ),
			'dependency' => array(
				'element'            => 'use_global',
				'value_not_equal_to' => '1',
			),
		),
		array(
			'group'      => esc_html__( 'Items', 'mitech' ),
			'heading'    => esc_html__( 'Open links in a new tab.', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'target',
			'value'      => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
			'std'        => '1',
			'dependency' => array(
				'element'            => 'use_global',
				'value_not_equal_to' => '1',
			),
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Icon Color', 'mitech' ),
			'type'             => 'dropdown',
			'param_name'       => 'icon_color',
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
			'heading'          => esc_html__( 'Custom Icon Color', 'mitech' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_icon_color',
			'dependency'       => array(
				'element' => 'icon_color',
				'value'   => 'custom',
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Icon Hover Color', 'mitech' ),
			'type'             => 'dropdown',
			'param_name'       => 'icon_hover_color',
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
			'heading'          => esc_html__( 'Custom Icon Hover Color', 'mitech' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_icon_hover_color',
			'dependency'       => array(
				'element' => 'icon_hover_color',
				'value'   => 'custom',
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Text Color', 'mitech' ),
			'type'             => 'dropdown',
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Text Color', 'mitech' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Text Hover Color', 'mitech' ),
			'type'             => 'dropdown',
			'param_name'       => 'text_hover_color',
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
			'heading'          => esc_html__( 'Custom Text Hover Color', 'mitech' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_text_hover_color',
			'dependency'       => array(
				'element' => 'text_hover_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Border Color', 'mitech' ),
			'type'             => 'dropdown',
			'param_name'       => 'border_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )     => '',
				esc_html__( 'Primary Color', 'mitech' )     => 'primary',
				esc_html__( 'Secondary Color', 'mitech' )   => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )      => 'custom',
				esc_html__( 'Transparent Color', 'mitech' ) => 'transparent',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Border Color', 'mitech' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_border_color',
			'dependency'       => array(
				'element' => 'border_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Border Hover Color', 'mitech' ),
			'type'             => 'dropdown',
			'param_name'       => 'border_hover_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )     => '',
				esc_html__( 'Primary Color', 'mitech' )     => 'primary',
				esc_html__( 'Secondary Color', 'mitech' )   => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )      => 'custom',
				esc_html__( 'Transparent Color', 'mitech' ) => 'transparent',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Border Hover Color', 'mitech' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_border_hover_color',
			'dependency'       => array(
				'element' => 'border_hover_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Background Color', 'mitech' ),
			'type'             => 'dropdown',
			'param_name'       => 'background_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )     => '',
				esc_html__( 'Primary Color', 'mitech' )     => 'primary',
				esc_html__( 'Secondary Color', 'mitech' )   => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )      => 'custom',
				esc_html__( 'Transparent Color', 'mitech' ) => 'transparent',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Background Color', 'mitech' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_background_color',
			'dependency'       => array(
				'element' => 'background_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Background Hover Color', 'mitech' ),
			'type'             => 'dropdown',
			'param_name'       => 'background_hover_color',
			'value'            => array(
				esc_html__( 'Default Color', 'mitech' )     => '',
				esc_html__( 'Primary Color', 'mitech' )     => 'primary',
				esc_html__( 'Secondary Color', 'mitech' )   => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )      => 'custom',
				esc_html__( 'Transparent Color', 'mitech' ) => 'transparent',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Background Hover Color', 'mitech' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_background_hover_color',
			'dependency'       => array(
				'element' => 'background_hover_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
	), Mitech_VC::get_custom_style_tab() ),
) );
