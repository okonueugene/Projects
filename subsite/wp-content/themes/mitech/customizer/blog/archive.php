<?php
$section  = 'blog_archive';
$priority = 1;
$prefix   = 'blog_archive_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_style',
	'label'       => esc_html__( 'Blog Style', 'mitech' ),
	'description' => esc_html__( 'Select blog style that display for archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'list',
	'choices'     => array(
		'list'             => esc_attr__( 'Large Image List', 'mitech' ),
		'list-small-image' => esc_attr__( 'Small Image List', 'mitech' ),
	),
) );
