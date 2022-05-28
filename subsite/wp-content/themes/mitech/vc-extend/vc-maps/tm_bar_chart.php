<?php

class WPBakeryShortCode_TM_Bar_Chart extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$legend_tab = esc_html__( 'Tooltips and Legends', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Bar Chart', 'mitech' ),
	'base'                      => 'tm_bar_chart',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-processbar',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'X axis labels', 'mitech' ),
			'description' => esc_html__( 'List of labels for X axis (separate labels with ";").', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'labels',
			'std'         => 'Jul; Aug; Sep; Oct; Nov; Dec',
		),
		array(
			'heading'    => esc_html__( 'Direction type', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'type',
			'value'      => array(
				esc_html__( 'Vertical', 'mitech' )   => 'bar',
				esc_html__( 'Horizontal', 'mitech' ) => 'horizontalBar',
			),
			'std'        => 'bar',
		),
		array(
			'heading'     => esc_html__( 'Border Width', 'mitech' ),
			'description' => esc_html__( 'Border width of the bars', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'border_width',
			'std'         => 0,
			'min'         => 0,
			'step'        => 1,
			'suffix'      => 'px',
		),
		array(
			'heading'    => esc_html__( 'Datasets', 'mitech' ),
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
					'heading'     => esc_html__( 'Values', 'mitech' ),
					'description' => esc_html__( 'text format for the tooltip (available placeholders: {d} dataset title, {x} X axis label, {y} Y axis value)', 'mitech' ),
					'type'        => 'textfield',
					'param_name'  => 'values',
				),
				array(
					'heading'    => esc_html__( 'Dataset Color', 'mitech' ),
					'type'       => 'colorpicker',
					'param_name' => 'color',
				),
				array(
					'heading'     => esc_html__( 'Fill Color', 'mitech' ),
					'description' => esc_html__( 'Leave blank to use color from dataset.', 'mitech' ),
					'type'        => 'colorpicker',
					'param_name'  => 'fill_color',
				),
				array(
					'heading'     => esc_html__( 'Border Color', 'mitech' ),
					'description' => esc_html__( 'Leave blank to use color from dataset.', 'mitech' ),
					'type'        => 'colorpicker',
					'param_name'  => 'border_color',
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'title'  => esc_html__( 'Item 01', 'mitech' ),
					'values' => '15; 10; 22; 19; 23; 17',
					'color'  => 'rgba(105, 59, 255, 1)',

				),
				array(
					'title'  => esc_html__( 'Item 02', 'mitech' ),
					'values' => '34; 38; 35; 33; 37; 40',
					'color'  => 'rgba(0, 110, 253, 1)',
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
			'heading'    => esc_html__( 'Legends Style', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'legend_style',
			'value'      => array(
				esc_html__( 'Normal', 'mitech' )          => 'normal',
				esc_html__( 'Use Point Style', 'mitech' ) => 'point',
			),
			'std'        => 'normal',
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
