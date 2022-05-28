<?php
$panel    = 'maintenance';
$priority = 1;

Mitech_Kirki::add_section( 'general', array(
	'title'    => esc_html__( 'General', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'maintenance', array(
	'title'    => esc_html__( 'Maintenance', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
