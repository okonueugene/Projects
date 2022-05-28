<?php

class WPBakeryShortCode_TM_Line_Chart extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$legend_tab = esc_html__( 'Tooltips and Legends', 'mitech' );

vc_map( array(
	'name'                      => esc_html__( 'Line Chart', 'mitech' ),
	'base'                      => 'tm_line_chart',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-accordion',
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
					'heading'     => esc_html__( 'Area filling', 'mitech' ),
					'description' => esc_html__( 'How to fill the area below the line', 'mitech' ),
					'type'        => 'dropdown',
					'param_name'  => 'fill',
					'value'       => array(
						esc_html__( 'Custom', 'mitech' ) => 'custom',
						esc_html__( 'None', 'mitech' )   => 'none',
					),
					'std'         => 'none',
				),
				array(
					'heading'    => esc_html__( 'Fill Color', 'mitech' ),
					'type'       => 'colorpicker',
					'param_name' => 'fill_color',
					'dependency' => array(
						'element' => 'fill',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'point_style',
					'heading'    => esc_html__( 'Point Style', 'mitech' ),
					'value'      => array(
						esc_html__( 'none', 'mitech' )              => 'none',
						esc_html__( 'circle', 'mitech' )            => 'circle',
						esc_html__( 'triangle', 'mitech' )          => 'triangle',
						esc_html__( 'rectangle', 'mitech' )         => 'rect',
						esc_html__( 'rotated rectangle', 'mitech' ) => 'rectRot',
						esc_html__( 'cross', 'mitech' )             => 'cross',
						esc_html__( 'rotated cross', 'mitech' )     => 'crossRot',
						esc_html__( 'star', 'mitech' )              => 'star',
					),
					'std'        => 'circle',
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'line_type',
					'heading'    => esc_html__( 'Line type', 'mitech' ),
					'value'      => array(
						esc_html__( 'normal', 'mitech' )  => 'normal',
						esc_html__( 'stepped', 'mitech' ) => 'step',
					),
					'std'        => 'normal',
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'line_style',
					'heading'    => esc_html__( 'Line style', 'mitech' ),
					'value'      => array(
						esc_html__( 'solid', 'mitech' )  => 'solid',
						esc_html__( 'dashed', 'mitech' ) => 'dashed',
						esc_html__( 'dotted', 'mitech' ) => 'dotted',
					),
					'std'        => 'solid',
				),
				array(
					'heading'     => esc_html__( 'Thickness', 'mitech' ),
					'description' => esc_html__( 'line and points thickness', 'mitech' ),
					'type'        => 'dropdown',
					'param_name'  => 'thickness',
					'value'       => array(
						esc_html__( 'thin', 'mitech' )    => 'thin',
						esc_html__( 'normal', 'mitech' )  => 'normal',
						esc_html__( 'thick', 'mitech' )   => 'thick',
						esc_html__( 'thicker', 'mitech' ) => 'thicker',
					),
					'std'         => 'normal',
				),
				array(
					'heading'     => esc_html__( 'Line tension', 'mitech' ),
					'description' => esc_html__( 'tension of the line ( 100 for a straight line )', 'mitech' ),
					'type'        => 'number',
					'param_name'  => 'line_tension',
					'std'         => 10,
					'min'         => 0,
					'max'         => 100,
					'step'        => 1,
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'title'        => esc_html__( 'Item 01', 'mitech' ),
					'values'       => '15; 10; 22; 19; 23; 17',
					'color'        => 'rgba(105, 59, 255, 0.55)',
					'fill'         => 'none',
					'thickness'    => 'normal',
					'point_style'  => 'circle',
					'line_style'   => 'solid',
					'line_tension' => 10,

				),
				array(
					'title'        => esc_html__( 'Item 02', 'mitech' ),
					'values'       => '34; 38; 35; 33; 37; 40',
					'color'        => 'rgba(0, 110, 253, 0.56)',
					'fill'         => 'none',
					'thickness'    => 'normal',
					'point_style'  => 'circle',
					'line_style'   => 'solid',
					'line_tension' => 10,
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
