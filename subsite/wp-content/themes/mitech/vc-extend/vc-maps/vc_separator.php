<?php

vc_add_params( 'vc_separator', array(
	array(
		'heading'     => esc_html__( 'Position', 'mitech' ),
		'description' => esc_html__( 'Make the separator position absolute with column', 'mitech' ),
		'type'        => 'dropdown',
		'param_name'  => 'position',
		'value'       => array(
			esc_html__( 'None', 'mitech' )   => '',
			esc_html__( 'Top', 'mitech' )    => 'top',
			esc_html__( 'Bottom', 'mitech' ) => 'bottom',
		),
		'std'         => '',
	),
) );
