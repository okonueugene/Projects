<?php

class WPBakeryShortCode_TM_Widget_Title extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;

		$title_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['title_color'], $atts['custom_title_color'] );
		if ( $title_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .widget-title { $title_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Widget Title', 'mitech' ),
	'base'                      => 'tm_widget_title',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-typography',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'    => esc_html__( 'Style', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'style',
			'value'      => array(
				esc_html__( '01', 'mitech' ) => '01',
				esc_html__( '02', 'mitech' ) => '02',
			),
			'std'        => '01',
		),
		array(
			'heading'     => esc_html__( 'Widget title', 'mitech' ),
			'description' => esc_html__( 'What text use as a widget title.', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'widget_title',
			'admin_label' => true,
			'std'         => '',
		),
		Mitech_VC::extra_class_field(),
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
	), Mitech_VC::get_vc_spacing_tab() ),
) );
