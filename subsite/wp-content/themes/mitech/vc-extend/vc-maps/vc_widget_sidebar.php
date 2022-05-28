<?php

vc_add_params( 'vc_widget_sidebar', array(
	array(
		'heading'    => esc_html__( 'Sidebar Position', 'mitech' ),
		'type'       => 'dropdown',
		'param_name' => 'sidebar_position',
		'value'      => array(
			esc_html__( 'Left', 'mitech' )  => 'left',
			esc_html__( 'Right', 'mitech' ) => 'right',
		),
		'std'        => 'right',
	),
) );
