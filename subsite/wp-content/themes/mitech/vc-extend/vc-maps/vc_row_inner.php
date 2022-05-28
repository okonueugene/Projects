<?php
vc_remove_param( 'vc_row_inner', 'css' );
vc_remove_param( 'vc_row_inner', 'gap' );

vc_add_params( 'vc_row_inner', array_merge(
	array(
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
			'heading'     => esc_html__( 'Width', 'mitech' ),
			'description' => esc_html__( 'Input the width for this row.', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'max_width',
		),
		array(
			'heading'    => esc_html__( 'Inner row Alignment Large Device', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'content_alignment',
			'value'      => array(
				esc_html__( 'Left', 'mitech' )   => 'left',
				esc_html__( 'Center', 'mitech' ) => 'center',
				esc_html__( 'Right', 'mitech' )  => 'right',
			),
			'std'        => 'left',
		),
		array(
			'heading'    => esc_html__( 'Inner row Alignment Medium Device', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'md_content_alignment',
			'value'      => array(
				esc_html__( 'Inherit from larger device', 'mitech' ) => '',
				esc_html__( 'Left', 'mitech' )                       => 'left',
				esc_html__( 'Center', 'mitech' )                     => 'center',
				esc_html__( 'Right', 'mitech' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Inner row Alignment Small Device', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'sm_content_alignment',
			'value'      => array(
				esc_html__( 'Inherit from larger device', 'mitech' ) => '',
				esc_html__( 'Left', 'mitech' )                       => 'left',
				esc_html__( 'Center', 'mitech' )                     => 'center',
				esc_html__( 'Right', 'mitech' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Inner row Alignment Extra Small Device', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'xs_content_alignment',
			'value'      => array(
				esc_html__( 'Inherit from larger device', 'mitech' ) => '',
				esc_html__( 'Left', 'mitech' )                       => 'left',
				esc_html__( 'Center', 'mitech' )                     => 'center',
				esc_html__( 'Right', 'mitech' )                      => 'right',
			),
			'std'        => '',
		),
	),
	Mitech_VC::get_vc_spacing_tab(),
	Mitech_VC::instance()->get_vc_container_styling_tab(),
	Mitech_VC::instance()->get_vc_container_effect_tab(),
	Mitech_VC::get_custom_style_tab()
) );
