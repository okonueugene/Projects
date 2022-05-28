<?php
$section  = 'footer';
$priority = 1;
$prefix   = 'footer_';

$footers = array();

if ( is_customize_preview() ) {
	$footers = Mitech_Footer::instance()->get_list_footers( true );
}

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'page',
	'label'       => esc_html__( 'Footer', 'mitech' ),
	'description' => esc_html__( 'Select a default footer for all pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'main',
	'choices'     => $footers,
) );
