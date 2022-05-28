<?php
$panel    = 'footer';
$priority = 1;

Mitech_Kirki::add_section( 'footer', array(
	'title'    => esc_html__( 'General', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'footer_simple', array(
	'title'    => esc_html__( 'Footer Simple', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
