<?php
$panel    = 'top_bar';
$priority = 1;

Mitech_Kirki::add_section( 'top_bar', array(
	'title'    => esc_html__( 'General', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'top_bar_style_01', array(
	'title'    => esc_html__( 'Top Bar Style 01', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'top_bar_style_02', array(
	'title'    => esc_html__( 'Top Bar Style 02', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'top_bar_style_03', array(
	'title'    => esc_html__( 'Top Bar Style 03', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'top_bar_style_04', array(
	'title'    => esc_html__( 'Top Bar Style 04', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
