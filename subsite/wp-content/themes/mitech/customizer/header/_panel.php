<?php
$panel    = 'header';
$priority = 1;

Mitech_Kirki::add_section( 'header', array(
	'title'       => esc_html__( 'General', 'mitech' ),
	'description' => '<div class="desc">
			<strong class="insight-label insight-label-info">' . esc_html__( 'IMPORTANT NOTE: ', 'mitech' ) . '</strong>
			<p>' . esc_html__( 'These settings can be overridden by settings from Page Options Box in separator page.', 'mitech' ) . '</p>
			<p><img src="' . esc_url( MITECH_THEME_IMAGE_URI . '/customize/header-settings.jpg' ) . '" alt="' . esc_attr__( 'header-settings', 'mitech' ) . '"/></p>
			<strong class="insight-label insight-label-info">' . esc_html__( 'Powerful header control: ', 'mitech' ) . '</strong>
			<p>' . esc_html__( 'You can use different header style for different post type.', 'mitech' ) . '</p>
		</div>',
	'panel'       => $panel,
	'priority'    => $priority++,
) );

Mitech_Kirki::add_section( 'header_sticky', array(
	'title'    => esc_html__( 'Header Sticky', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'header_more_options', array(
	'title'    => esc_html__( 'Header More Options', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'header_style_01', array(
	'title'    => esc_html__( 'Header Style 01', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'header_style_02', array(
	'title'    => esc_html__( 'Header Style 02', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'header_style_03', array(
	'title'    => esc_html__( 'Header Style 03', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'header_style_04', array(
	'title'    => esc_html__( 'Header Style 04', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'header_style_05', array(
	'title'    => esc_html__( 'Header Style 05', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'header_style_06', array(
	'title'    => esc_html__( 'Header Style 06', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'header_style_07', array(
	'title'    => esc_html__( 'Header Style 07', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'header_style_08', array(
	'title'    => esc_html__( 'Header Style 08', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'header_style_09', array(
	'title'    => esc_html__( 'Header Style 09', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
