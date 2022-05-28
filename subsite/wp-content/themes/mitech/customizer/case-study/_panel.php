<?php
$panel    = 'case_study';
$priority = 1;

Mitech_Kirki::add_section( 'archive_case_study', array(
	'title'    => esc_html__( 'Archive', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'single_case_study', array(
	'title'    => esc_html__( 'Single', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
