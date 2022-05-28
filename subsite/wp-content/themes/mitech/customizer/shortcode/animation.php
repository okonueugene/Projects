<?php
$section  = 'shortcode_animation';
$priority = 1;
$prefix   = 'shortcode_animation_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Css Animation', 'mitech' ),
	'description' => esc_html__( 'Controls the css animations on mobile & tablet.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'desktop',
	'choices'     => array(
		'none'    => esc_html__( 'None', 'mitech' ),
		'mobile'  => esc_html__( 'Only Mobile', 'mitech' ),
		'desktop' => esc_html__( 'Only Desktop', 'mitech' ),
		'both'    => esc_html__( 'All Devices', 'mitech' ),
	),
) );
