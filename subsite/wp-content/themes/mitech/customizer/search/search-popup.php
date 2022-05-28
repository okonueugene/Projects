<?php
$section  = 'search_popup';
$priority = 1;
$prefix   = 'search_popup_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'close_button_color',
	'label'       => esc_html__( 'Close Button Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of close button.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'default' => esc_attr__( 'Default Color', 'mitech' ),
		'hover'   => esc_attr__( 'Hover Color', 'mitech' ),
	),
	'output'      => array(
		array(
			'choice'   => 'default',
			'element'  => '.page-close-search',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.page-close-search',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'color-alpha',
	'settings'        => $prefix . 'bg_color',
	'label'           => esc_html__( 'Color', 'mitech' ),
	'description'     => esc_html__( 'Controls the background color of the search popup content.', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'default'         => '#fff',
	'output'          => array(
		array(
			'element'  => '.page-search-popup',
			'property' => 'background',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'text_color',
	'label'       => esc_html__( 'Text Color', 'mitech' ),
	'description' => esc_html__( 'Controls the text color search field.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Mitech::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
			.page-search-popup .search-form,
			.page-search-popup .search-field:focus
			',
			'property' => 'color',
		),
		array(
			'element'  => '.page-search-popup .search-field:-webkit-autofill',
			'property' => '-webkit-text-fill-color',
			'suffix'   => '!important',
		),
	),
) );
