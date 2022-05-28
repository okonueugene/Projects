<?php
$section  = 'single_case_study';
$priority = 1;
$prefix   = 'single_case_study_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_case_study_sticky_detail_enable',
	'label'       => esc_html__( 'Sticky Detail Column', 'mitech' ),
	'description' => esc_html__( 'Turn on to enable sticky of detail column.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_case_study_style',
	'label'       => esc_html__( 'Single Case Study Style', 'mitech' ),
	'description' => esc_html__( 'Select style of all single case study post pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => array(
		'blank'            => esc_html__( 'Blank (Build with Visual Composer)', 'mitech' ),
		'image_list'       => esc_html__( 'Image List', 'mitech' ),
		'image_slider'     => esc_html__( 'Image Slider', 'mitech' ),
		'image_grid'       => esc_html__( 'Image Grid', 'mitech' ),
		'big_image_slider' => esc_html__( 'Big Image Slider', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_case_study_video_enable',
	'label'       => esc_html__( 'Video', 'mitech' ),
	'description' => esc_html__( 'Controls the video visibility on case study post pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => array(
		'none'  => esc_html__( 'Hide', 'mitech' ),
		'above' => esc_html__( 'Show Above Feature Image', 'mitech' ),
		'below' => esc_html__( 'Show Below Feature Image', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_case_study_feature_caption',
	'label'       => esc_html__( 'Image Caption', 'mitech' ),
	'description' => esc_html__( 'Turn on to display comments on single case study posts.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_case_study_comment_enable',
	'label'       => esc_html__( 'Comments', 'mitech' ),
	'description' => esc_html__( 'Turn on to display comments on single case study posts.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_case_study_categories_enable',
	'label'       => esc_html__( 'Categories', 'mitech' ),
	'description' => esc_html__( 'Turn on to display categories on single case study posts.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_case_study_tags_enable',
	'label'       => esc_html__( 'Tags', 'mitech' ),
	'description' => esc_html__( 'Turn on to display tags on single case study posts.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_case_study_share_enable',
	'label'       => esc_html__( 'Share', 'mitech' ),
	'description' => esc_html__( 'Turn on to display Share list on single case study posts.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_case_study_related_enable',
	'label'       => esc_html__( 'Related Case Study', 'mitech' ),
	'description' => esc_html__( 'Turn on this option to display related case study section.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'text',
	'settings'        => 'case_study_related_title',
	'label'           => esc_html__( 'Related Title Section', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => esc_html__( 'Related Projects', 'mitech' ),
	'active_callback' => array(
		array(
			'setting'  => 'single_case_study_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'multicheck',
	'settings'        => 'case_study_related_by',
	'label'           => esc_attr__( 'Related By', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array( 'case_study_category' ),
	'choices'         => array(
		'case_study_category' => esc_html__( 'Case Study Category', 'mitech' ),
		'case_study_tags'     => esc_html__( 'Case Study Tags', 'mitech' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_case_study_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'case_study_related_number',
	'label'           => esc_html__( 'Number related case study', 'mitech' ),
	'description'     => esc_html__( 'Controls the number of related case study', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 5,
	'choices'         => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_case_study_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_case_study_pagination_enable',
	'label'       => esc_html__( 'Previous/Next Pagination', 'mitech' ),
	'description' => esc_html__( 'Turn on to display the previous/next case study pagination on single case study posts.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'single_case_study_pagination_return_link',
	'label'       => esc_html__( 'Return button url', 'mitech' ),
	'description' => esc_html__( 'Controls the url when you click on pagination center button. Leave blank to disable the button.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => home_url( '/case_study' ),
) );
