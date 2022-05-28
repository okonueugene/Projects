<?php
vc_map_update( 'vc_progress_bar', array(
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-processbar',
) );

vc_remove_param( 'vc_progress_bar', 'bgcolor' );
vc_remove_param( 'vc_progress_bar', 'custombgcolor' );
vc_remove_param( 'vc_progress_bar', 'customtxtcolor' );
vc_remove_param( 'vc_progress_bar', 'values' );
vc_remove_param( 'vc_progress_bar', 'css' );
vc_remove_param( 'vc_progress_bar', 'title' );

$weight = 100;

vc_add_params( 'vc_progress_bar', array_merge( array(
	array(
		'heading'    => esc_html__( 'Style', 'mitech' ),
		'type'       => 'dropdown',
		'param_name' => 'style',
		'value'      => array(
			esc_html__( '01', 'mitech' ) => '01',
			esc_html__( '02', 'mitech' ) => '02',
			esc_html__( '03', 'mitech' ) => '03',
			esc_html__( '04', 'mitech' ) => '04',
		),
		'std'        => '01',
		'weight'     => $weight--,
	),
	array(
		'heading'     => esc_html__( 'Bar height', 'mitech' ),
		'description' => esc_html__( 'Controls the height of bar. Leave blank to use default by style.', 'mitech' ),
		'type'        => 'number',
		'param_name'  => 'bar_height',
		'std'         => '',
		'min'         => 1,
		'max'         => 50,
		'step'        => 1,
		'suffix'      => 'px',
		'weight'      => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Background Color', 'mitech' ),
		'type'       => 'dropdown',
		'param_name' => 'background_color',
		'value'      => array(
			esc_html__( 'Default Color', 'mitech' )   => '',
			esc_html__( 'Primary Color', 'mitech' )   => 'primary',
			esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
			esc_html__( 'Custom Color', 'mitech' )    => 'custom',
		),
		'std'        => '',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Background Color', 'mitech' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_background_color',
		'dependency' => array(
			'element' => 'background_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#222',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Track Color', 'mitech' ),
		'type'       => 'dropdown',
		'param_name' => 'track_color',
		'value'      => array(
			esc_html__( 'Default Color', 'mitech' )   => '',
			esc_html__( 'Primary Color', 'mitech' )   => 'primary',
			esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
			esc_html__( 'Custom Color', 'mitech' )    => 'custom',
		),
		'std'        => '',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Track Color', 'mitech' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_track_color',
		'dependency' => array(
			'element' => 'track_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#ededed',
		'weight'     => $weight--,
	),
	array(
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
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Text Color', 'mitech' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_text_color',
		'dependency' => array(
			'element' => 'text_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#333',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Units Color', 'mitech' ),
		'type'       => 'dropdown',
		'param_name' => 'units_color',
		'value'      => array(
			esc_html__( 'Default Color', 'mitech' )   => '',
			esc_html__( 'Primary Color', 'mitech' )   => 'primary',
			esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
			esc_html__( 'Custom Color', 'mitech' )    => 'custom',
		),
		'std'        => '',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Units Color', 'mitech' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_units_color',
		'dependency' => array(
			'element' => 'units_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#333',
		'weight'     => $weight--,
	),
	array(
		'group'       => esc_html__( 'Items', 'mitech' ),
		'type'        => 'param_group',
		'heading'     => esc_html__( 'Values', 'mitech' ),
		'param_name'  => 'values',
		'description' => esc_html__( 'Enter values for graph - value, title and color.', 'mitech' ),
		'value'       => rawurlencode( wp_json_encode( array(
			array(
				'label' => esc_html__( 'Development', 'mitech' ),
				'value' => '90',
			),
			array(
				'label' => esc_html__( 'Design', 'mitech' ),
				'value' => '80',
			),
			array(
				'label' => esc_html__( 'Marketing', 'mitech' ),
				'value' => '70',
			),
		) ) ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Label', 'mitech' ),
				'param_name'  => 'label',
				'description' => esc_html__( 'Enter text used as title of bar.', 'mitech' ),
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Value', 'mitech' ),
				'param_name'  => 'value',
				'description' => esc_html__( 'Enter value of bar.', 'mitech' ),
				'admin_label' => true,
			),
			array(
				'heading'    => esc_html__( 'Background Color', 'mitech' ),
				'type'       => 'dropdown',
				'param_name' => 'background_color',
				'value'      => array(
					esc_html__( 'Default', 'mitech' )         => '',
					esc_html__( 'Primary Color', 'mitech' )   => 'primary',
					esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
					esc_html__( 'Gradient Color', 'mitech' )  => 'gradient',
					esc_html__( 'Custom Color', 'mitech' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Background Color', 'mitech' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_background_color',
				'dependency' => array(
					'element' => 'background_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#222',
			),
			array(
				'heading'    => esc_html__( 'Gradient Color 1', 'mitech' ),
				'type'       => 'colorpicker',
				'param_name' => 'background_gradient_color_1',
				'dependency' => array(
					'element' => 'background_color',
					'value'   => 'gradient',
				),
				'std'        => '#222',
			),
			array(
				'heading'    => esc_html__( 'Gradient Color 2', 'mitech' ),
				'type'       => 'colorpicker',
				'param_name' => 'background_gradient_color_2',
				'dependency' => array(
					'element' => 'background_color',
					'value'   => 'gradient',
				),
				'std'        => '#222',
			),
			array(
				'heading'    => esc_html__( 'Track Color', 'mitech' ),
				'type'       => 'dropdown',
				'param_name' => 'track_color',
				'value'      => array(
					esc_html__( 'Default', 'mitech' )         => '',
					esc_html__( 'Primary Color', 'mitech' )   => 'primary',
					esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
					esc_html__( 'Custom Color', 'mitech' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Track Color', 'mitech' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_track_color',
				'dependency' => array(
					'element' => 'track_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#ededed',
			),
			array(
				'heading'    => esc_html__( 'Text Color', 'mitech' ),
				'type'       => 'dropdown',
				'param_name' => 'text_color',
				'value'      => array(
					esc_html__( 'Default', 'mitech' )         => '',
					esc_html__( 'Primary Color', 'mitech' )   => 'primary',
					esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
					esc_html__( 'Custom Color', 'mitech' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Text Color', 'mitech' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_text_color',
				'dependency' => array(
					'element' => 'text_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#333',
			),
		),
	),

), Mitech_VC::get_vc_spacing_tab() ) );
