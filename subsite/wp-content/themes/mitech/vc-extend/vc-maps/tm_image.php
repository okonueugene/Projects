<?php

class WPBakeryShortCode_TM_Image extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;
		$tmp = $image_tmp = '';

		$tmp .= "text-align: {$atts['align']}";

		if ( $tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector{ $tmp }";
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
			$image_tmp .= Mitech_Helper::get_css_prefix( 'border-radius', "{$atts['rounded']}px" );
		}

		if ( $atts['box_shadow'] !== '' ) {
			$image_tmp .= Mitech_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
		}

		if ( $atts['full_wide'] === '1' ) {
			$image_tmp .= "width: 100%;";
		} else {
			if ( $atts['max_width'] !== '' ) {
				$image_tmp .= "width: {$atts['max_width']}";
			}
		}

		if ( $image_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector img { $image_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Single Image', 'mitech' ),
	'base'                      => 'tm_image',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-singleimage',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'    => esc_html__( 'Image', 'mitech' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		array(
			'heading'     => esc_html__( 'Image Size', 'mitech' ),
			'description' => esc_html__( 'Controls the size of image.', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'image_size',
			'value'       => array(
				esc_html__( 'Full', 'mitech' )   => 'full',
				esc_html__( 'Custom', 'mitech' ) => 'custom',
			),
			'std'         => 'full',
		),
		array(
			'heading'          => esc_html__( 'Image Width', 'mitech' ),
			'type'             => 'number',
			'param_name'       => 'image_size_width',
			'min'              => 0,
			'max'              => 1920,
			'step'             => 10,
			'suffix'           => 'px',
			'dependency'       => array(
				'element' => 'image_size',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'heading'          => esc_html__( 'Image Height', 'mitech' ),
			'type'             => 'number',
			'param_name'       => 'image_size_height',
			'min'              => 0,
			'max'              => 1920,
			'step'             => 10,
			'suffix'           => 'px',
			'dependency'       => array(
				'element' => 'image_size',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'heading'    => esc_html__( 'On Click Action', 'mitech' ),
			'desc'       => esc_html__( 'Select action for click action.', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'action',
			'value'      => array(
				esc_html__( 'None', 'mitech' )                  => '',
				esc_html__( 'Open Full Image Popup', 'mitech' ) => 'popup',
				esc_html__( 'Open Custom Link', 'mitech' )      => 'custom_link',
				esc_html__( 'Return To Home', 'mitech' )        => 'go_to_home',
			),
			'std'        => '',
		),
		array(
			'heading'     => esc_html__( 'Link', 'mitech' ),
			'description' => esc_html__( 'Add a link to image.', 'mitech' ),
			'type'        => 'vc_link',
			'param_name'  => 'custom_link',
			'dependency'  => array(
				'element' => 'action',
				'value'   => 'custom_link',
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Full wide', 'mitech' ),
			'description' => esc_html__( 'Make image fit wide of container', 'mitech' ),
			'type'        => 'checkbox',
			'param_name'  => 'full_wide',
			'value'       => array( esc_html__( 'Yes', 'mitech' ) => '1' ),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Image Width', 'mitech' ),
			'description' => esc_html__( 'Controls max width of image. For e.g: 200px', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'max_width',
			'dependency'  => array(
				'element'            => 'full_wide',
				'value_not_equal_to' => '1',
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Rounded', 'mitech' ),
			'description' => esc_html__( 'Controls the rounded of image', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'rounded',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Box Shadow', 'mitech' ),
			'description' => esc_html__( 'For e.g: 0 20px 30px #ccc', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'box_shadow',
		),
	), Mitech_VC::get_alignment_fields(), array(
		Mitech_VC::get_animation_field(),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),

) );
