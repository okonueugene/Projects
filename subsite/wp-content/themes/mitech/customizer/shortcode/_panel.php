<?php
$panel    = 'shortcode';
$priority = 1;

Mitech_Kirki::add_section( 'shortcode_animation', array(
	'title'    => esc_html__( 'CSS Animation', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
