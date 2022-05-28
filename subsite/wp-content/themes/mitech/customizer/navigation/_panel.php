<?php
$panel    = 'navigation';
$priority = 1;

Mitech_Kirki::add_section( 'navigation', array(
	'title'    => esc_html__( 'Desktop Menu', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Mitech_Kirki::add_section( 'navigation_minimal_01', array(
	'title'    => esc_html__( 'Off Canvas Menu', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Mitech_Kirki::add_section( 'navigation_mobile', array(
	'title'    => esc_html__( 'Mobile Menu', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
