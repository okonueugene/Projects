<?php

class WPBakeryShortCode_TM_Box_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;
		$btn_tmp = '';

		$tmp             = Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'], $atts['background_gradient'] );
		$icon_tmp        = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$icon_tmp        .= Mitech_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['icon_color'], $atts['custom_icon_color'] );
		$icon_tmp        .= Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['icon_background_color'], $atts['custom_icon_background_color'] );
		$heading_tmp     = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['heading_color'], $atts['custom_heading_color'] );
		$sub_heading_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['sub_heading_color'], $atts['custom_sub_heading_color'] );
		$text_tmp        = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );

		if ( $atts['background_image'] !== '' ) {
			$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
			if ( $_url !== false ) {
				$tmp .= "background-image: url( $_url );";

				if ( $atts['background_size'] !== 'auto' ) {
					$tmp .= "background-size: {$atts['background_size']};";
				}

				$tmp .= "background-repeat: {$atts['background_repeat']};";
				if ( $atts['background_position'] !== '' ) {
					$tmp .= "background-position: {$atts['background_position']};";
				}
			}
		}

		if ( $tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector{ $tmp }";
		}

		if ( isset( $atts['icon_font_size'] ) ) {
			Mitech_VC::get_responsive_css( array(
				'element' => "$selector .icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['icon_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( $atts['text_width'] !== '' ) {
			$text_tmp .= "max-width: {$atts['text_width']};";
		}

		if ( $icon_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .icon{ $icon_tmp }";
		}

		if ( $heading_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .heading { $heading_tmp }";
		}

		if ( $sub_heading_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .sub-heading { $sub_heading_tmp }";
		}

		if ( $text_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .text{ $text_tmp }";
		}

		if ( $atts['text'] === '' && $atts['heading'] === '' ) {
			$mitech_shortcode_lg_css .= "$selector .image { margin-bottom: 0; }";
		}

		if ( $atts['button_color'] === 'custom' ) {
			$btn_tmp .= "color: {$atts['custom_button_color']}; ";
		}

		if ( $btn_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .tm-button .button-text{ $btn_tmp }";
		}

		$tmp = "text-align: {$atts['align']}; ";
		/*if ( $atts['align'] === 'left' ) {
			$tmp .= 'align-items: flex-start';
		} elseif ( $atts['align'] === 'center' ) {
			$tmp .= 'align-items: center;';
		} elseif ( $atts['align'] === 'right' ) {
			$tmp .= 'align-items: flex-end;';
		}*/

		$mitech_shortcode_lg_css .= "$selector .content-wrap { $tmp }";

		$tmp = '';
		if ( $atts['md_align'] !== '' ) {
			$tmp .= "text-align: {$atts['md_align']};";

			if ( $atts['md_align'] === 'left' ) {
				$tmp .= 'align-items: flex-start';
			} elseif ( $atts['md_align'] === 'center' ) {
				$tmp .= 'align-items: center;';
			} elseif ( $atts['md_align'] === 'right' ) {
				$tmp .= 'align-items: flex-end;';
			}

			$mitech_shortcode_md_css .= "$selector .content-wrap { $tmp }";
		}

		$tmp = '';
		if ( $atts['sm_align'] !== '' ) {
			$tmp .= "text-align: {$atts['sm_align']};";

			if ( $atts['sm_align'] === 'left' ) {
				$tmp .= 'align-items: flex-start';
			} elseif ( $atts['sm_align'] === 'center' ) {
				$tmp .= 'align-items: center;';
			} elseif ( $atts['sm_align'] === 'right' ) {
				$tmp .= 'align-items: flex-end;';
			}

			$mitech_shortcode_sm_css .= "$selector .content-wrap { $tmp }";
		}

		$tmp = '';
		if ( $atts['xs_align'] !== '' ) {
			$tmp .= "text-align: {$atts['xs_align']};";

			if ( $atts['xs_align'] === 'left' ) {
				$tmp .= 'align-items: flex-start';
			} elseif ( $atts['xs_align'] === 'center' ) {
				$tmp .= 'align-items: center;';
			} elseif ( $atts['xs_align'] === 'right' ) {
				$tmp .= 'align-items: flex-end;';
			}

			$mitech_shortcode_xs_css .= "$selector .content-wrap { $tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$content_tab = esc_html__( 'Content', 'mitech' );
$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Box Icon', 'mitech' ),
	'base'                      => 'tm_box_icon',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'description' => esc_html__( 'Select style for box icon.', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Style 01', 'mitech' ) => '01',
				esc_html__( 'Style 02', 'mitech' ) => '02',
				esc_html__( 'Style 03', 'mitech' ) => '03',
				esc_html__( 'Style 04', 'mitech' ) => '04',
				esc_html__( 'Style 05', 'mitech' ) => '05',
				esc_html__( 'Style 06', 'mitech' ) => '06',
			),
			'admin_label' => true,
			'std'         => '01',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Image', 'mitech' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Image hover', 'mitech' ),
			'type'       => 'attach_image',
			'param_name' => 'image_hover',
		),
	), Mitech_VC::get_alignment_fields(), Mitech_VC::icon_libraries( array(
		'group'      => $content_tab,
		'allow_none' => true,
		'allow_svg'  => true,
	) ), array(
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Box Link', 'mitech' ),
			'description' => esc_html__( 'Add a link wrap box icon. This ignore button link option.', 'mitech' ),
			'type'        => 'vc_link',
			'param_name'  => 'box_link',
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Sub Heading', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'sub_heading',
			'admin_label' => true,
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Heading', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'heading',
			'admin_label' => true,
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Text', 'mitech' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Text Width', 'mitech' ),
			'description' => esc_html__( 'Input width of box text. For e.g: 300px', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'text_width',
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Button', 'mitech' ),
			'description' => esc_html__( 'Notice: If Box Link option inputted then this button still showing but the url will ignore.', 'mitech' ),
			'type'        => 'vc_link',
			'param_name'  => 'button',
		),
		Mitech_VC::get_animation_field(),
		Mitech_VC::extra_class_field(),
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
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Heading Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'heading_color',
			'value'      => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Heading Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_heading_color',
			'dependency' => array(
				'element' => 'heading_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#222',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Sub Heading Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'sub_heading_color',
			'value'      => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Sub Heading Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_sub_heading_color',
			'dependency' => array(
				'element' => 'sub_heading_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#222',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Icon Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_color',
			'value'      => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Icon Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_icon_color',
			'dependency' => array(
				'element' => 'icon_color',
				'value'   => 'custom',
			),
			'std'        => '#999',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Icon Background Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_background_color',
			'value'      => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Icon Background Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_icon_background_color',
			'dependency' => array(
				'element' => 'icon_background_color',
				'value'   => 'custom',
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Text Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'text_color',
			'value'      => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Text Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_text_color',
			'dependency' => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#999',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Button Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'button_color',
			'value'      => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Button Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_button_color',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'background_color',
			'value'      => array(
				esc_html__( 'None', 'mitech' )            => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Gradient Color', 'mitech' )  => 'gradient',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'        => '',
		),

		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Background Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_background_color',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Gradient', 'mitech' ),
			'type'       => 'gradient',
			'param_name' => 'background_gradient',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Image', 'mitech' ),
			'type'       => 'attach_image',
			'param_name' => 'background_image',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Repeat', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'background_repeat',
			'value'      => array(
				esc_html__( 'No repeat', 'mitech' )         => 'no-repeat',
				esc_html__( 'Tile', 'mitech' )              => 'repeat',
				esc_html__( 'Tile Horizontally', 'mitech' ) => 'repeat-x',
				esc_html__( 'Tile Vertically', 'mitech' )   => 'repeat-y',
			),
			'std'        => 'no-repeat',
			'dependency' => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Size', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'background_size',
			'value'      => array(
				esc_html__( 'Auto', 'mitech' )    => 'auto',
				esc_html__( 'Cover', 'mitech' )   => 'cover',
				esc_html__( 'Contain', 'mitech' ) => 'contain',
			),
			'std'        => 'cover',
			'dependency' => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Background Position', 'mitech' ),
			'description' => esc_html__( 'For e.g: left center', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'background_position',
			'dependency'  => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Background Overlay', 'mitech' ),
			'description' => esc_html__( 'Choose an overlay background color.', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'overlay_background',
			'value'       => array(
				esc_html__( 'None', 'mitech' )          => '',
				esc_html__( 'Primary Color', 'mitech' ) => 'primary',
				esc_html__( 'Custom Color', 'mitech' )  => 'overlay_custom_background',
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Custom Background Overlay', 'mitech' ),
			'description' => esc_html__( 'Choose an custom background color overlay.', 'mitech' ),
			'type'        => 'colorpicker',
			'param_name'  => 'overlay_custom_background',
			'std'         => '#000000',
			'dependency'  => array(
				'element' => 'overlay_background',
				'value'   => array( 'overlay_custom_background' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Opacity', 'mitech' ),
			'type'       => 'number',
			'param_name' => 'overlay_opacity',
			'value'      => 100,
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'suffix'     => '%',
			'std'        => 80,
			'dependency' => array(
				'element'   => 'overlay_background',
				'not_empty' => true,
			),
		),
	), Mitech_VC::get_vc_spacing_tab() ),

) );
