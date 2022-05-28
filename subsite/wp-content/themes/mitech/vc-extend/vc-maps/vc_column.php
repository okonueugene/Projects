<?php
vc_remove_param( 'vc_column', 'css' );

vc_add_params( 'vc_column', array_merge(
	array(
		array(
			'heading'     => esc_html__( 'Layer Index', 'mitech' ),
			'description' => esc_html__( 'Controls z-index of this column', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'layer_index',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
		),
		array(
			'heading'     => esc_html__( 'Column Order', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'order',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'     => esc_html__( 'Width', 'mitech' ),
			'description' => esc_html__( 'Controls the width of the column on large device. For e.g: 570px.', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'max_width',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Content position', 'mitech' ),
			'param_name' => 'content_position',
			'value'      => array(
				esc_attr__( 'Default', 'mitech' ) => '',
				esc_attr__( 'Middle', 'mitech' )  => 'middle',
				esc_attr__( 'Top', 'mitech' )     => 'top',
				esc_attr__( 'Bottom', 'mitech' )  => 'bottom',
				esc_attr__( 'Stretch', 'mitech' ) => 'stretch',
			),
			'std'        => '',
		),
	),
	Mitech_VC::get_alignment_fields(),
	Mitech_VC::get_vc_spacing_tab(),
	Mitech_VC::instance()->get_vc_container_styling_tab()
) );
