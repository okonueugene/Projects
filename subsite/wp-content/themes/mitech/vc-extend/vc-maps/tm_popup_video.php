<?php

class WPBakeryShortCode_TM_Popup_Video extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;

		$wrapper_tmp = '';

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

		if ( $wrapper_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector { $wrapper_tmp }";
		}

		$button_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['button_color'], $atts['custom_button_color'] );
		if ( $button_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .video-play { $button_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$posters = array(
	'poster-01',
	'poster-02',
);

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Popup Video', 'mitech' ),
	'base'                      => 'tm_popup_video',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-video',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Poster Style 01', 'mitech' ) => 'poster-01',
				esc_html__( 'Poster Style 02', 'mitech' ) => 'poster-02',
				esc_html__( 'Button Style 01', 'mitech' ) => 'button',
				esc_html__( 'Button Style 02', 'mitech' ) => 'button-02',
				esc_html__( 'Button Style 03', 'mitech' ) => 'button-03',
				esc_html__( 'Button Style 04', 'mitech' ) => 'button-04',
				esc_html__( 'Button Style 05', 'mitech' ) => 'button-05',
			),
			'std'         => 'poster-01',
		),
		array(
			'heading'     => esc_html__( 'Video Url', 'mitech' ),
			'description' => esc_html__( 'Input Youtube video url or Vimeo video url. For e.g: "https://www.youtube.com/watch?v=vqZuSUtczbU"', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'video',
		),
		array(
			'heading'    => esc_html__( 'Video Text', 'mitech' ),
			'type'       => 'textarea',
			'param_name' => 'video_text',
		),
		array(
			'heading'    => esc_html__( 'Poster Image', 'mitech' ),
			'type'       => 'attach_image',
			'param_name' => 'poster',
			'dependency' => array(
				'element' => 'style',
				'value'   => $posters,
			),
		),
		array(
			'heading'     => esc_html__( 'Poster Image Size', 'mitech' ),
			'description' => esc_html__( 'Controls the size of poster image.', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'image_size',
			'value'       => array(
				esc_html__( '570x420', 'mitech' ) => '570x420',
				esc_html__( '770x500', 'mitech' ) => '770x500',
				esc_html__( 'Full', 'mitech' )    => 'full',
				esc_html__( 'Custom', 'mitech' )  => 'custom',
			),
			'std'         => '570x420',
			'dependency'  => array(
				'element' => 'style',
				'value'   => $posters,
			),
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
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'heading'    => esc_html__( 'Poster - Full Wide', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'poster_full_wide',
			'value'      => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
			'std'        => '1',
			'dependency' => array(
				'element' => 'style',
				'value'   => $posters,
			),
		),
	), Mitech_VC::get_alignment_fields(), array(
		Mitech_VC::extra_class_field(),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Video Button Color', 'mitech' ),
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
			'heading'    => esc_html__( 'Custom Video Button Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_button_color',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );
