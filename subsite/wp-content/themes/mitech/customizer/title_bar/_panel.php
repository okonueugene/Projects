<?php
$panel    = 'title_bar';
$priority = 1;

Mitech_Kirki::add_section( 'title_bar', array(
	'title'    => esc_html__( 'General', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'title_bar_01', array(
	'title'    => esc_html__( 'Style 01', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
