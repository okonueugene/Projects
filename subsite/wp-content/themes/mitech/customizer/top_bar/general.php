<?php
$section  = 'top_bar';
$priority = 1;
$prefix   = 'top_bar_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'global_top_bar',
	'label'    => esc_html__( 'Default Top Bar', 'mitech' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '01',
	'choices'  => Mitech_Helper::get_top_bar_list(),
) );

