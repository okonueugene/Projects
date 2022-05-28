<?php
$section  = 'footer_simple';
$priority = 1;
$prefix   = 'footer_simple_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'text',
	'label'    => esc_html__( 'Copyright Text', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Copyright &copy; 2019. All rights reserved.', 'mitech' ),
) );
