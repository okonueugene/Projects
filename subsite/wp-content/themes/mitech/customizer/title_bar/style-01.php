<?php
$section  = 'title_bar_01';
$priority = 1;
$prefix   = 'title_bar_01_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'background_type',
	'label'    => esc_html__( 'Background Type', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'normal',
	'choices'  => array(
		'normal'   => esc_html__( 'Normal', 'mitech' ),
		'gradient' => esc_html__( 'Gradient', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'background',
	'settings'        => $prefix . 'background',
	'label'           => esc_html__( 'Background', 'mitech' ),
	'description'     => esc_html__( 'Controls the background of title bar.', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array(
		'background-color'      => '#f6f2ed',
		'background-image'      => MITECH_THEME_IMAGE_URI . '/title-bar-01-bg.jpg',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'          => array(
		array(
			'element' => '.page-title-bar-01 .page-title-bar-inner',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'background_type',
			'operator' => '==',
			'value'    => 'normal',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'background_gradient',
	'label'           => esc_html__( 'Background Gradient', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color_1' => esc_attr__( 'Color 1', 'mitech' ),
		'color_2' => esc_attr__( 'Color 2', 'mitech' ),
	),
	'default'         => array(
		'color_1' => '#fff',
		'color_2' => '#eceefa',
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'background_type',
			'operator' => '==',
			'value'    => 'gradient',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_overlay_color',
	'label'       => esc_html__( 'Background Overlay Color', 'mitech' ),
	'description' => esc_html__( 'Controls the background overlay color of title bar.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-overlay',
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'border_width',
	'label'     => esc_html__( 'Border Bottom Width', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Color', 'mitech' ),
	'description' => esc_html__( 'Controls the border bottom color of the page title bar.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'border-bottom-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 136,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 131,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'heading_typography',
	'label'       => esc_html__( 'Font Family', 'mitech' ),
	'description' => esc_html__( 'Controls the font family for the page title heading.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '700',
		'font-size'      => '64px',
		'line-height'    => '1.13',
		'letter-spacing' => '',
		'text-transform' => '',
		'color'          => '#002fa6',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-01 .heading',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sub Title', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'sub_title_typography',
	'label'       => esc_html__( 'Font Family', 'mitech' ),
	'description' => esc_html__( 'Controls the font family for the page title Sub Title.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '400',
		'font-size'      => '18px',
		'line-height'    => '1.13',
		'letter-spacing' => '',
		'text-transform' => '',
		'color'          => '#696969',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-01 .sub-title',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Breadcrumb', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'breadcrumb_typography',
	'label'       => esc_html__( 'Typography', 'mitech' ),
	'description' => esc_html__( 'Controls the typography for the breadcrumb text.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '500',
		'line-height'    => '1.67',
		'letter-spacing' => '',
		'text-transform' => '',
		'font-size'      => '24px',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-01 .insight_core_breadcrumb li, .page-title-bar-01 .insight_core_breadcrumb li a',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_text_color',
	'label'       => esc_html__( 'Text Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of text on breadcrumb.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Mitech::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb li',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_link_color',
	'label'       => esc_html__( 'Link Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of links on breadcrumb.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Mitech::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb a',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color when hover of links on breadcrumb.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Mitech::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb a:hover',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_separator_color',
	'label'       => esc_html__( 'Separator Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of separator on breadcrumb.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => Mitech::HEADING_COLOR,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb li + li:before',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Responsive Options', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Medium Device', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 198,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Mitech_Helper::get_md_media_query(),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 166,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Mitech_Helper::get_md_media_query(),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 54,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Mitech_Helper::get_md_media_query(),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Small Device', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 160,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Mitech_Helper::get_sm_media_query(),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 150,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Mitech_Helper::get_sm_media_query(),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 44,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Mitech_Helper::get_sm_media_query(),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Extra Small Device', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 121,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Mitech_Helper::get_xs_media_query(),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 110,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Mitech_Helper::get_xs_media_query(),
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 34,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Mitech_Helper::get_xs_media_query(),
		),
	),
) );
