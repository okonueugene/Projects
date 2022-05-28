<?php
$section  = 'archive_case_study';
$priority = 1;
$prefix   = 'archive_case_study_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'archive_case_study_category_list',
	'label'    => esc_html__( 'Category List', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_case_study_style',
	'label'       => esc_html__( 'Style', 'mitech' ),
	'description' => esc_html__( 'Select style that display for archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'grid',
	'choices'     => array(
		'grid'    => esc_attr__( 'Grid Classic', 'mitech' ),
		'masonry' => esc_attr__( 'Grid Masonry', 'mitech' ),
		'list'    => esc_attr__( 'Left Image List', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => 'archive_case_study_number_items',
	'label'    => esc_html__( 'Number Items', 'mitech' ),
	'tooltip'  => esc_html__( 'Controls the number items per page. Leave blank to use general setting.', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '9',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'number',
	'settings' => 'archive_case_study_gutter',
	'label'    => esc_html__( 'Gutter', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 30,
	'choices'  => array(
		'min'  => 0,
		'step' => 1,
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => 'archive_case_study_columns',
	'label'    => esc_html__( 'Columns', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'xs:1;sm:2;md:3;lg:3',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'radio-buttonset',
	'settings'        => 'archive_case_study_popup_video_enable',
	'label'           => esc_html__( 'Enable Popup Video?', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => '1',
	'choices'         => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'archive_case_study_style',
			'operator' => 'in',
			'value'    => array(
				'grid',
				'masonry',
			),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'select',
	'settings'        => 'archive_case_study_caption_style',
	'label'           => esc_html__( 'Caption', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => '01',
	'choices'         => array(
		'none' => esc_attr__( 'None', 'mitech' ),
		'01'   => esc_attr__( 'Style 01', 'mitech' ),
		'02'   => esc_attr__( 'Style 02', 'mitech' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'archive_case_study_style',
			'operator' => 'in',
			'value'    => array(
				'grid',
				'masonry',
			),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'select',
	'settings'        => 'archive_case_study_overlay_style',
	'label'           => esc_html__( 'Overlay', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 'none',
	'choices'         => array(
		'none'     => esc_attr__( 'None', 'mitech' ),
		'faded'    => esc_attr__( 'Faded', 'mitech' ),
		'faded-02' => esc_attr__( 'Faded 02', 'mitech' ),
		'parallax' => esc_html__( 'Parallax', 'mitech' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'archive_case_study_style',
			'operator' => 'in',
			'value'    => array(
				'grid',
				'masonry',
			),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'external_url',
	'label'       => esc_html__( 'External Url', 'mitech' ),
	'description' => esc_html__( 'Go to external url instead of go to single case study pages from archive case study pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'No', 'mitech' ),
		'1' => esc_html__( 'Yes', 'mitech' ),
	),
) );
