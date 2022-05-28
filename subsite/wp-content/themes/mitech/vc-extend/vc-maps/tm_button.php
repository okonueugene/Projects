<?php

class WPBakeryShortCode_TM_Button extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;

		$wrapper_tmp     = '';
		$button_tmp      = $button_hover_tmp = '';
		$button_icon_tmp = $button_hover_icon_tmp = '';

		if ( $atts['align'] !== '' ) {
			$wrapper_tmp .= "text-align: {$atts['align']};";
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

		if ( $atts['rounded'] !== '' ) {
			$button_tmp .= Mitech_Helper::get_css_prefix( 'border-radius', $atts['rounded'] );
		}

		if ( $atts['box_shadow'] !== '' ) {
			$button_tmp .= Mitech_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
		}

		if ( $atts['size'] === 'custom' ) {
			if ( $atts['width'] !== '' ) {
				$button_tmp .= "min-width: {$atts['width']}px;";
			}

			if ( $atts['advanced_border_width'] === '1' ) {

				if ( $atts['border_top_width'] !== '' ) {
					$button_tmp .= "border-top-width: {$atts['border_top_width']}px;";
				}

				if ( $atts['border_bottom_width'] !== '' ) {
					$button_tmp .= "border-bottom-width: {$atts['border_bottom_width']}px;";
				}

				if ( $atts['border_left_width'] !== '' ) {
					$button_tmp .= "border-left-width: {$atts['border_left_width']}px;";
				}

				if ( $atts['border_right_width'] !== '' ) {
					$button_tmp .= "border-right-width: {$atts['border_right_width']}px;";
				}

			} else {
				if ( $atts['border_width'] !== '' ) {
					$button_tmp .= "border-width: {$atts['border_width']}px;";
				}
			}

			if ( $atts['height'] !== '' ) {
				$button_tmp   .= "min-height: {$atts['height']}px;";
				$_line_height = $atts['height'];
				if ( $atts['border_width'] !== '' ) {
					$_line_height = $_line_height - ( $atts['border_width'] * 2 );
				}

				$button_tmp .= "line-height: {$_line_height}px;";
			}
		}

		if ( isset( $atts['icon_font_size'] ) ) {
			Mitech_VC::get_responsive_css( array(
				'element' => "$selector .button-icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['icon_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( isset( $atts['text_font_size'] ) ) {
			Mitech_VC::get_responsive_css( array(
				'element' => "$selector .button-text",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['text_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( $atts['color'] === 'custom' ) {
			$button_tmp            .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['font_color'], $atts['custom_font_color'] );
			$button_tmp            .= Mitech_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['button_border_color'], $atts['custom_button_border_color'] );
			$button_tmp            .= Mitech_Helper::get_shortcode_css_color_inherit( 'background', $atts['button_bg_color'], $atts['custom_button_bg_color'], $atts['button_bg_gradient'] );
			$button_hover_tmp      .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['font_color_hover'], $atts['custom_font_color_hover'] );
			$button_hover_tmp      .= Mitech_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['button_border_color_hover'], $atts['custom_button_border_color_hover'] );
			$button_hover_tmp      .= Mitech_Helper::get_shortcode_css_color_inherit( 'background', $atts['button_bg_color_hover'], $atts['custom_button_bg_color_hover'], $atts['button_bg_gradient_hover'] );
			$button_icon_tmp       .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['button_icon_color'], $atts['custom_button_icon_color'] );
			$button_hover_icon_tmp .= Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['button_icon_color_hover'], $atts['custom_button_icon_color_hover'] );
		}

		if ( $wrapper_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector { $wrapper_tmp }";
		}

		if ( $button_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .tm-button{ $button_tmp }";
		}

		if ( $button_hover_tmp !== '' ) {
			if ( $atts['style'] === 'text' ) {
				$mitech_shortcode_lg_css .= "$selector .tm-button:hover span { $button_hover_tmp }";
			} else {
				$mitech_shortcode_lg_css .= "$selector .tm-button:hover { $button_hover_tmp }";
			}
		}

		if ( $button_icon_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .tm-button .button-icon { $button_icon_tmp }";
		}

		if ( $button_hover_icon_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .tm-button:hover .button-icon { $button_hover_icon_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'     => esc_html__( 'Button', 'mitech' ),
	'base'     => 'tm_button',
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-button',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Flat', 'mitech' )       => 'flat',
				esc_html__( 'Solid', 'mitech' )      => 'solid',
				esc_html__( 'Text', 'mitech' )       => 'text',
				esc_html__( 'Image', 'mitech' )      => 'image',
				esc_html__( 'Image Text', 'mitech' ) => 'image-text',
			),
			'std'         => 'flat',
		),
		array(
			'heading'    => esc_html__( 'Image', 'mitech' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
			'dependency' => array( 'element' => 'style', 'value' => array( 'image', 'image-text' ) ),
		),
		array(
			'heading'     => esc_html__( 'Size', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'size',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Large', 'mitech' )       => 'lg',
				esc_html__( 'Normal', 'mitech' )      => 'nm',
				esc_html__( 'Small', 'mitech' )       => 'sm',
				esc_html__( 'Extra Small', 'mitech' ) => 'xs',
				esc_html__( 'Custom', 'mitech' )      => 'custom',
			),
			'std'         => 'nm',
		),
		array(
			'heading'     => esc_html__( 'Width', 'mitech' ),
			'description' => esc_html__( 'Controls the width of button.', 'mitech' ),
			'type'        => 'number',
			'suffix'      => 'px',
			'param_name'  => 'width',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'     => esc_html__( 'Height', 'mitech' ),
			'description' => esc_html__( 'Controls the height of button.', 'mitech' ),
			'type'        => 'number',
			'suffix'      => 'px',
			'param_name'  => 'height',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'    => esc_html__( 'Advanced Border Width?', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'advanced_border_width',
			'value'      => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
			'dependency' => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'    => esc_html__( 'Border Width', 'mitech' ),
			'type'       => 'number',
			'suffix'     => 'px',
			'param_name' => 'border_width',
			'dependency' => array( 'element' => 'advanced_border_width', 'value_not_equal_to' => '1' ),
		),
		array(
			'heading'          => esc_html__( 'Border Top Width', 'mitech' ),
			'type'             => 'number',
			'suffix'           => 'px',
			'param_name'       => 'border_top_width',
			'dependency'       => array( 'element' => 'advanced_border_width', 'value' => '1' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'          => esc_html__( 'Border Bottom Width', 'mitech' ),
			'type'             => 'number',
			'suffix'           => 'px',
			'param_name'       => 'border_bottom_width',
			'dependency'       => array( 'element' => 'advanced_border_width', 'value' => '1' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'          => esc_html__( 'Border Right Width', 'mitech' ),
			'type'             => 'number',
			'suffix'           => 'px',
			'param_name'       => 'border_right_width',
			'dependency'       => array( 'element' => 'advanced_border_width', 'value' => '1' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'          => esc_html__( 'Border Left Width', 'mitech' ),
			'type'             => 'number',
			'suffix'           => 'px',
			'param_name'       => 'border_left_width',
			'dependency'       => array( 'element' => 'advanced_border_width', 'value' => '1' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'     => esc_html__( 'Force Full Width', 'mitech' ),
			'description' => esc_html__( 'Make button full wide.', 'mitech' ),
			'type'        => 'checkbox',
			'param_name'  => 'full_wide',
			'value'       => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Button', 'mitech' ),
			'type'       => 'vc_link',
			'param_name' => 'button',
			'value'      => esc_html__( 'Button', 'mitech' ),
		),
		array(
			'group'      => esc_html__( 'Icon', 'mitech' ),
			'heading'    => esc_html__( 'Icon Align', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_align',
			'value'      => array(
				esc_html__( 'Left', 'mitech' )  => 'left',
				esc_html__( 'Right', 'mitech' ) => 'right',
			),
			'std'        => 'right',
		),
		array(
			'heading'     => esc_html__( 'Button Action', 'mitech' ),
			'description' => esc_html__( 'To make smooth scroll action work then input button url like this: #about-us-section. )', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'action',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'mitech' )                    => '',
				esc_html__( 'Smooth scroll to a section', 'mitech' ) => 'smooth_scroll',
				esc_html__( 'Open link as popup video', 'mitech' )   => 'popup_video',

			),
			'std'         => '',
		),
		array(
			'heading'     => esc_html__( 'Hover Animation', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'hover_animation',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Icon Move', 'mitech' ) => 'icon-move',
			),
			'std'         => '',
		),
	), Mitech_VC::get_alignment_fields(), array(
		Mitech_VC::get_animation_field(),
		Mitech_VC::extra_class_field(),
		Mitech_VC::extra_id_field(),
	), Mitech_VC::icon_libraries( array(
		'allow_none' => true,
	) ), array(
		array(
			'group'       => $styling_tab,
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Skin', 'mitech' ),
			'param_name'  => 'color',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'mitech' ) => '',
				esc_html__( 'Custom', 'mitech' )  => 'custom',
			),
			'std'         => '',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background color', 'mitech' ),
			'param_name'       => 'button_bg_color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )     => '',
				esc_html__( 'Primary', 'mitech' )     => 'primary',
				esc_html__( 'Secondary', 'mitech' )   => 'secondary',
				esc_html__( 'Gradient', 'mitech' )    => 'gradient',
				esc_html__( 'Transparent', 'mitech' ) => 'transparent',
				esc_html__( 'Custom', 'mitech' )      => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom background color', 'mitech' ),
			'param_name'       => 'custom_button_bg_color',
			'dependency'       => array(
				'element' => 'button_bg_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Gradient', 'mitech' ),
			'type'       => 'gradient',
			'param_name' => 'button_bg_gradient',
			'dependency' => array(
				'element' => 'button_bg_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text color', 'mitech' ),
			'param_name'       => 'font_color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom text color', 'mitech' ),
			'param_name'       => 'custom_font_color',
			'dependency'       => array(
				'element' => 'font_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Border color', 'mitech' ),
			'param_name'       => 'button_border_color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )     => '',
				esc_html__( 'Primary', 'mitech' )     => 'primary',
				esc_html__( 'Secondary', 'mitech' )   => 'secondary',
				esc_html__( 'Transparent', 'mitech' ) => 'transparent',
				esc_html__( 'Custom', 'mitech' )      => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Border color', 'mitech' ),
			'param_name'       => 'custom_button_border_color',
			'dependency'       => array(
				'element' => 'button_border_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Icon color', 'mitech' ),
			'param_name'       => 'button_icon_color',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Icon color', 'mitech' ),
			'param_name'       => 'custom_button_icon_color',
			'dependency'       => array(
				'element' => 'button_icon_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background color (on hover)', 'mitech' ),
			'param_name'       => 'button_bg_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )     => '',
				esc_html__( 'Primary', 'mitech' )     => 'primary',
				esc_html__( 'Secondary', 'mitech' )   => 'secondary',
				esc_html__( 'Gradient', 'mitech' )    => 'gradient',
				esc_html__( 'Transparent', 'mitech' ) => 'transparent',
				esc_html__( 'Custom', 'mitech' )      => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom background color (on hover)', 'mitech' ),
			'param_name'       => 'custom_button_bg_color_hover',
			'dependency'       => array(
				'element' => 'button_bg_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Gradient (on hover)', 'mitech' ),
			'type'       => 'gradient',
			'param_name' => 'button_bg_gradient_hover',
			'dependency' => array(
				'element' => 'button_bg_color_hover',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text color (on hover)', 'mitech' ),
			'param_name'       => 'font_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Text color (on hover)', 'mitech' ),
			'param_name'       => 'custom_font_color_hover',
			'dependency'       => array(
				'element' => 'font_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Border color (on hover)', 'mitech' ),
			'param_name'       => 'button_border_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )     => '',
				esc_html__( 'Primary', 'mitech' )     => 'primary',
				esc_html__( 'Secondary', 'mitech' )   => 'secondary',
				esc_html__( 'Transparent', 'mitech' ) => 'transparent',
				esc_html__( 'Custom', 'mitech' )      => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Border color (on hover)', 'mitech' ),
			'param_name'       => 'custom_button_border_color_hover',
			'dependency'       => array(
				'element' => 'button_border_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Icon color (on hover)', 'mitech' ),
			'param_name'       => 'button_icon_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'mitech' )   => '',
				esc_html__( 'Primary', 'mitech' )   => 'primary',
				esc_html__( 'Secondary', 'mitech' ) => 'secondary',
				esc_html__( 'Custom', 'mitech' )    => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Icon color (on hover)', 'mitech' ),
			'param_name'       => 'custom_button_icon_color_hover',
			'dependency'       => array(
				'element' => 'button_icon_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Rounded', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'rounded',
			'description' => esc_html__( 'Input a valid radius. For e.g: "10px". Leave blank to use default.', 'mitech' ),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Box Shadow', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'box_shadow',
			'description' => esc_html__( 'Input a valid box shadow. For e.g: "0 0 20px rgba(0, 0, 0, 0.15)". Leave blank to use default.', 'mitech' ),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Icon Font Size', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'icon_font_size',
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
			'heading'     => esc_html__( 'Text Font Size', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'text_font_size',
			'min'         => 8,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
