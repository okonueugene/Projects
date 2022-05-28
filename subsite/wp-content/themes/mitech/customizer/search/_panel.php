<?php
$panel    = 'search';
$priority = 1;

Mitech_Kirki::add_section( 'search_page', array(
	'title'    => esc_html__( 'Search Page', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Mitech_Kirki::add_section( 'search_popup', array(
	'title'    => esc_html__( 'Search Popup', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
