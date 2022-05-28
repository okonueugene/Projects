<?php
$panel    = 'blog';
$priority = 1;

Mitech_Kirki::add_section( 'blog_archive', array(
	'title'    => esc_html__( 'Blog Archive', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'blog_single', array(
	'title'    => esc_html__( 'Blog Single Post', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
