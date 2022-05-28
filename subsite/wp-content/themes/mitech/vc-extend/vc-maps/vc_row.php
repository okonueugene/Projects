<?php
vc_remove_param( 'vc_row', 'css' );
vc_remove_param( 'vc_row', 'gap' );
vc_remove_param( 'vc_row', 'parallax' );
vc_remove_param( 'vc_row', 'parallax_image' );
vc_remove_param( 'vc_row', 'parallax_speed_bg' );
vc_remove_param( 'vc_row', 'full_height' );
vc_remove_param( 'vc_row', 'columns_placement' );

vc_add_params( 'vc_row', array_merge(
	array(
		array(
			'heading'    => esc_html__( 'Height', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'height',
			'value'      => array(
				esc_html__( 'Auto', 'mitech' )                   => '',
				esc_html__( 'Full Height', 'mitech' )            => 'full',
				esc_html__( 'Full Height Calculated', 'mitech' ) => 'full-calc',
			),
			'std'        => '',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Columns position', 'mitech' ),
			'param_name'  => 'columns_placement',
			'value'       => array(
				esc_attr__( 'Middle', 'mitech' )  => 'middle',
				esc_attr__( 'Top', 'mitech' )     => 'top',
				esc_attr__( 'Bottom', 'mitech' )  => 'bottom',
				esc_attr__( 'Stretch', 'mitech' ) => 'stretch',
			),
			'description' => __( 'Select columns position within row.', 'mitech' ),
			'dependency'  => array(
				'element'   => 'height',
				'not_empty' => true,
			),
		),
		array(
			'heading'     => esc_html__( 'Layer Index', 'mitech' ),
			'description' => esc_html__( 'When content in row or row has negative margin then this controls layer ( z-index ) of row', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'layer_index',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
		),
		array(
			'heading'     => esc_html__( 'Gutter', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'gutter',
			'min'         => 0,
			'max'         => 100,
			'step'        => 2,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'    => esc_html__( 'Column Separator', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'column_separator',
			'value'      => array(
				esc_html__( 'None', 'mitech' )     => '',
				esc_html__( 'Style 01', 'mitech' ) => '01',

			),
			'std'        => '',
		),
	),
	Mitech_VC::get_vc_spacing_tab(),
	Mitech_VC::instance()->get_vc_container_styling_tab(),
	Mitech_VC::instance()->get_vc_container_effect_tab(),
	Mitech_VC::instance()->get_vc_container_separator_tab(),
	Mitech_VC::instance()->get_vc_container_one_page_tab(),
	Mitech_VC::instance()->get_vc_container_scrolling_effect_tab(),
	Mitech_VC::get_custom_style_tab()
) );
