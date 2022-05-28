<?php
$panel    = 'advanced';
$priority = 1;

Mitech_Kirki::add_section( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Mitech_Kirki::add_section( 'light_gallery', array(
	'title'    => esc_html__( 'Light Gallery', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
