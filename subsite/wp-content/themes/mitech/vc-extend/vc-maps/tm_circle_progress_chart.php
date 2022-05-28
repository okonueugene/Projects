<?php

class WPBakeryShortCode_TM_Circle_Progress_Chart extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;

		if ( $atts['align'] !== '' ) {
			$mitech_shortcode_lg_css .= "$selector { text-align: {$atts['align']}; }";
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

		if ( isset( $atts['number_font_size'] ) ) {
			Mitech_VC::get_responsive_css( array(
				'element' => "$selector .chart-number",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['number_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		$icon_tmp    = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$title_tmp   = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['title_color'], $atts['custom_title_color'] );
		$content_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['content_color'], $atts['custom_content_color'] );

		if ( $icon_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .chart-icon { $icon_tmp }";
		}

		if ( $title_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .title { $title_tmp }";
		}

		if ( $content_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .chart-content { $content_tmp }";
		}

		$primary_color   = Mitech::setting( 'primary_color' );
		$secondary_color = Mitech::setting( 'secondary_color' );

		$inner_circle_css = '';

		switch ( $atts['bar_color'] ) {
			case 'primary':
				$inner_circle_css .= "background: {$primary_color}";
				break;
			case 'secondary':
				$inner_circle_css .= "background: {$secondary_color}";
				break;
			case 'custom':
				$inner_circle_css .= "background: {$atts['custom_bar_color']}";
				break;
			case 'gradient':
				$inner_circle_css .= "background-color: {$atts['bar_gradient_color_2']};";
				$inner_circle_css .= "background-image: linear-gradient(-224deg,{$atts['bar_gradient_color_1']} 0,{$atts['bar_gradient_color_2']} 100%);";
				break;
		}

		if ( $atts['style'] === '02' ) {
			$mitech_shortcode_lg_css .= "$selector .inner-circle { $inner_circle_css }";
		}

		$mitech_shortcode_lg_css .= "$selector .circle-design { $inner_circle_css }";
	}
}

$content_group = esc_html__( 'Content', 'mitech' );
$style_group   = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Circle Progress Chart', 'mitech' ),
	'base'                      => 'tm_circle_progress_chart',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-pie-chart',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'mitech' ) => '01',
				esc_html__( 'Style 02', 'mitech' ) => '02',
			),
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Number', 'mitech' ),
			'description' => esc_html__( 'Controls the number you would like to display in pie chart.', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'min'         => 1,
			'max'         => 100,
			'std'         => 75,
		),
		array(
			'heading'     => esc_html__( 'Circle Size', 'mitech' ),
			'description' => esc_html__( 'Controls the size of the pie chart circle. Default: 220', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'size',
			'suffix'      => 'px',
			'std'         => 160,
		),
		array(
			'heading'     => esc_html__( 'Measuring unit', 'mitech' ),
			'description' => esc_html__( 'Controls the unit of chart.', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'unit',
			'std'         => '%',
		),
		array(
			'heading'     => esc_html__( 'Reverse?', 'mitech' ),
			'description' => esc_html__( 'Reverse animation and arc draw', 'mitech' ),
			'type'        => 'checkbox',
			'param_name'  => 'reverse',
			'value'       => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
		),
	), Mitech_VC::get_alignment_fields(),
		array(
			Mitech_VC::extra_class_field(),
			array(
				'group'      => $content_group,
				'heading'    => esc_html__( 'Inner Content', 'mitech' ),
				'type'       => 'dropdown',
				'param_name' => 'inner_content',
				'value'      => array(
					esc_html__( 'Default', 'mitech' )     => '',
					esc_html__( 'Custom Text', 'mitech' ) => 'custom_text',
					esc_html__( 'Icon', 'mitech' )        => 'icon',
				),
				'std'        => '',
			),
			array(
				'group'      => $content_group,
				'heading'    => esc_html__( 'Inner Content Text', 'mitech' ),
				'type'       => 'textfield',
				'param_name' => 'inner_content_text',
				'dependency' => array( 'element' => 'inner_content', 'value' => 'custom_text' ),
			),
		), Mitech_VC::icon_libraries( array(
			'group'      => $content_group,
			'allow_none' => true,
		) ), array(
			array(
				'group'      => $content_group,
				'heading'    => esc_html__( 'Title', 'mitech' ),
				'type'       => 'textfield',
				'param_name' => 'title',
			),
			array(
				'group'      => $content_group,
				'heading'    => esc_html__( 'Content', 'mitech' ),
				'type'       => 'textarea',
				'param_name' => 'content',
			),
			array(
				'group'      => $style_group,
				'heading'    => esc_html__( 'Line Cap', 'mitech' ),
				'type'       => 'dropdown',
				'param_name' => 'line_cap',
				'value'      => array(
					esc_html__( 'Butt', 'mitech' )   => 'butt',
					esc_html__( 'Round', 'mitech' )  => 'round',
					esc_html__( 'Square', 'mitech' ) => 'square',
				),
				'std'        => 'round',
			),
			array(
				'group'       => $style_group,
				'heading'     => esc_html__( 'Line Width', 'mitech' ),
				'description' => esc_html__( 'Controls the line width of chart.', 'mitech' ),
				'type'        => 'number',
				'param_name'  => 'line_width',
				'suffix'      => 'px',
				'min'         => 1,
				'max'         => 50,
				'std'         => 4,
			),
			array(
				'group'            => $style_group,
				'heading'          => esc_html__( 'Bar Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'bar_color',
				'value'            => array(
					esc_html__( 'Default Color', 'mitech' )   => '',
					esc_html__( 'Gradient Color', 'mitech' )  => 'gradient',
					esc_html__( 'Primary Color', 'mitech' )   => 'primary',
					esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
					esc_html__( 'Custom Color', 'mitech' )    => 'custom',
				),
				'std'              => '',
				'edit_field_class' => 'vc_col-sm-6 col-break',
			),
			array(
				'group'            => $style_group,
				'heading'          => esc_html__( 'Custom Bar Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_bar_color',
				'dependency'       => array( 'element' => 'bar_color', 'value' => array( 'custom' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $style_group,
				'heading'          => esc_html__( 'Bar Gradient Color 1', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'bar_gradient_color_1',
				'dependency'       => array( 'element' => 'bar_color', 'value' => array( 'gradient' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $style_group,
				'heading'          => esc_html__( 'Bar Gradient Color 2', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'bar_gradient_color_2',
				'dependency'       => array( 'element' => 'bar_color', 'value' => array( 'gradient' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $style_group,
				'heading'          => esc_html__( 'Track Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'track_color',
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
				'group'            => $style_group,
				'heading'          => esc_html__( 'Custom Track Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_track_color',
				'dependency'       => array( 'element' => 'track_color', 'value' => array( 'custom' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $style_group,
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
				'group'            => $style_group,
				'heading'          => esc_html__( 'Custom Icon Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_icon_color',
				'dependency'       => array( 'element' => 'icon_color', 'value' => array( 'custom' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $style_group,
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
				'group'            => $style_group,
				'heading'          => esc_html__( 'Custom Title Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_title_color',
				'dependency'       => array( 'element' => 'title_color', 'value' => array( 'custom' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $style_group,
				'heading'          => esc_html__( 'Content Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'content_color',
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
				'group'            => $style_group,
				'heading'          => esc_html__( 'Custom Content Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_content_color',
				'dependency'       => array( 'element' => 'content_color', 'value' => array( 'custom' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'       => $style_group,
				'heading'     => esc_html__( 'Number Font Size', 'mitech' ),
				'type'        => 'number_responsive',
				'param_name'  => 'number_font_size',
				'min'         => 8,
				'suffix'      => 'px',
				'media_query' => array(
					'lg' => '',
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
			),
		) ),
) );
