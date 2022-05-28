<?php

class WPBakeryShortCode_TM_Pie_Chart extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;

		$legend_label_tmp       = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['legend_label_color'], $atts['custom_legend_label_color'] );
		$legend_label_hover_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['legend_label_hover_color'], $atts['custom_legend_label_hover_color'] );

		if ( $legend_label_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .chart-legends li { $legend_label_tmp }";
		}

		if ( $legend_label_hover_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .chart-legends li:hover { $legend_label_hover_tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$legend_tab = esc_html__( 'Tooltips and Legends', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Pie Chart', 'mitech' ),
	'base'                      => 'tm_pie_chart',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-pie-chart',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Cutting percentage', 'mitech' ),
			'description' => esc_html__( 'amount of the inner surface to be cut off (0 for pie and 80 for example for a doughnut)', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'cutout',
			'std'         => 0,
			'min'         => 0,
			'max'         => 95,
			'step'        => 1,
			'suffix'      => '%',
		),
		array(
			'heading'     => esc_html__( 'Border Width', 'mitech' ),
			'description' => esc_html__( 'Border width of the arcs in the dataset', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'border_width',
			'std'         => 0,
			'min'         => 0,
			'step'        => 1,
			'suffix'      => 'px',
		),
		array(
			'heading'    => esc_html__( 'Border Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'border_color',
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Data', 'mitech' ),
			'type'       => 'param_group',
			'param_name' => 'datasets',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Title', 'mitech' ),
					'description' => esc_html__( 'Dataset title used in tooltips and legends.', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Value', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'value',
				),
				array(
					'heading'    => esc_html__( 'Color', 'mitech' ),
					'type'       => 'colorpicker',
					'param_name' => 'color',
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'title' => esc_html__( 'Item 01', 'mitech' ),
					'value' => '25',
					'color' => '#75dfaa',
				),
				array(
					'title' => esc_html__( 'Item 02', 'mitech' ),
					'value' => '45',
					'color' => '#6b6cfe',
				),
				array(
					'title' => esc_html__( 'Item 03', 'mitech' ),
					'value' => '30',
					'color' => '#71aefe',
				),
			) ) ),
		),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => $legend_tab,
			'heading'    => esc_html__( 'Enable legends', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'legend',
			'value'      => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
			'std'        => '1',
		),
		array(
			'group'      => $legend_tab,
			'heading'    => esc_html__( 'Legends Position', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'legend_position',
			'value'      => array(
				esc_html__( 'Top', 'mitech' )    => 'top',
				esc_html__( 'Right', 'mitech' )  => 'right',
				esc_html__( 'Bottom', 'mitech' ) => 'bottom',
				esc_html__( 'Left', 'mitech' )   => 'left',
			),
			'std'        => 'bottom',
		),
		array(
			'group'       => $legend_tab,
			'heading'     => esc_html__( 'Click on legends', 'mitech' ),
			'description' => esc_html__( 'Hide dataset on click on legend', 'mitech' ),
			'type'        => 'checkbox',
			'param_name'  => 'legend_onclick',
			'value'       => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
			'std'         => '1',
		),
		array(
			'group'      => $legend_tab,
			'heading'    => esc_html__( 'Label Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'legend_label_color',
			'value'      => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $legend_tab,
			'heading'    => esc_html__( 'Custom Label Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_legend_label_color',
			'dependency' => array(
				'element' => 'legend_label_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $legend_tab,
			'heading'    => esc_html__( 'Label Hover Color', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'legend_label_hover_color',
			'value'      => array(
				esc_html__( 'Default Color', 'mitech' )   => '',
				esc_html__( 'Primary Color', 'mitech' )   => 'primary',
				esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
				esc_html__( 'Custom Color', 'mitech' )    => 'custom',
			),
			'std'        => 'primary',
		),
		array(
			'group'      => $legend_tab,
			'heading'    => esc_html__( 'Custom Label Hover Color', 'mitech' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_legend_label_hover_color',
			'dependency' => array(
				'element' => 'legend_label_hover_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => esc_html__( 'Chart Options', 'mitech' ),
			'heading'    => esc_html__( 'Aspect Ratio', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'aspect_ratio',
			'value'      => array(
				'1:1'  => '1:1',
				'21:9' => '21:9',
				'16:9' => '16:9',
				'4:3'  => '4:3',
				'3:4'  => '3:4',
				'9:16' => '9:16',
				'9:21' => '9:21',
			),
			'std'        => '4:3',
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
