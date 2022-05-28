<?php
$section  = 'color_';
$priority = 1;
$prefix   = 'color_';

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'primary_color',
	'label'     => esc_html__( 'Primary Color', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => Mitech::PRIMARY_COLOR,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'secondary_color',
	'label'     => esc_html__( 'Secondary Color', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => Mitech::SECONDARY_COLOR,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'third_color',
	'label'     => esc_html__( 'Third Color', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => Mitech::THIRD_COLOR,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'body_color',
	'label'       => esc_html__( 'Text Color', 'mitech' ),
	'description' => esc_html__( 'Controls the default color of all text.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Mitech::TEXT_COLOR,
	'output'      => array(
		array(
			'element'  => 'body, .gmap-marker-wrap',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'link_color',
	'label'       => esc_html__( 'Link Color', 'mitech' ),
	'description' => esc_html__( 'Controls the default color of all links.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'default' => esc_attr__( 'Default', 'mitech' ),
		'hover'   => esc_attr__( 'Hover', 'mitech' ),
	),
	'default'     => array(
		'default' => '#696969',
		'hover'   => Mitech::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'default',
			'element'  => 'a, .widget_recent_entries li a:after',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => 'a:hover, a:focus,
			.tm-maps .gmap-info-template .gmap-marker-content a:hover,
			.widget_recent_entries li a:before',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'heading_color',
	'label'       => esc_html__( 'Heading Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of heading.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Mitech::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => 'h1,h2,h3,h4,h5,h6,caption,th,
			.heading-color,
			.comment-list .comment-actions a,
			.vc_progress_bar .vc_single_bar_title,
			.vc_chart.vc_chart .vc_chart-legend li,
			.tm-countdown .number,
			.tm-counter.style-03 .number-wrap,
			.tm-drop-cap.style-01 .drop-cap,
			.tm-drop-cap.style-02,
			.tm-table caption,
            .tm-demo-options-toolbar a
			',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button Color', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'button_style',
	'label'    => esc_html__( 'Button Style', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'solid',
	'choices'  => array(
		'solid'    => esc_html__( 'Solid', 'mitech' ),
		'gradient' => esc_html__( 'Gradient', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => 'button_color',
	'label'           => esc_html__( 'Button Color', 'mitech' ),
	'description'     => esc_html__( 'Controls the color of buttons.', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
		'border'     => esc_attr__( 'Border', 'mitech' ),
	),
	'default'         => array(
		'color'      => '#ffffff',
		'background' => Mitech::PRIMARY_COLOR,
		'border'     => Mitech::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => Mitech_Helper::get_button_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Mitech_Helper::get_button_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Mitech_Helper::get_button_css_selector(),
			'property' => 'background-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'button_style',
			'operator' => '==',
			'value'    => 'solid',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => 'button_hover_color',
	'label'           => esc_html__( 'Button Hover Color', 'mitech' ),
	'description'     => esc_html__( 'Controls the color of buttons when hover.', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
		'border'     => esc_attr__( 'Border', 'mitech' ),
	),
	'default'         => array(
		'color'      => '#ffffff',
		'background' => Mitech::PRIMARY_COLOR,
		'border'     => Mitech::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => Mitech_Helper::get_button_hover_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Mitech_Helper::get_button_hover_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Mitech_Helper::get_button_hover_css_selector(),
			'property' => 'background-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'button_style',
			'operator' => '==',
			'value'    => 'solid',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => 'button_gradient_color',
	'label'           => esc_html__( 'Button Gradient Color', 'mitech' ),
	'description'     => esc_html__( 'Controls the gradient color of buttons', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color_1'    => esc_attr__( 'Color 1', 'mitech' ),
		'color_2'    => esc_attr__( 'Color 2', 'mitech' ),
		'text_color' => esc_attr__( 'Text Color', 'mitech' ),
	),
	'default'         => array(
		'color_1'    => '#5E61E7',
		'color_2'    => '#9C7AF2',
		'text_color' => '#fff',
	),
	'active_callback' => array(
		array(
			'setting'  => 'button_style',
			'operator' => '==',
			'value'    => 'gradient',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Form Color', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'form_input_color',
	'label'       => esc_html__( 'Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of form inputs.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
		'border'     => esc_attr__( 'Border', 'mitech' ),
	),
	'default'     => array(
		'color'      => '#7e7e7e',
		'background' => '#f5f5f5',
		'border'     => '#f5f5f5',
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => Mitech_Helper::get_form_input_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Mitech_Helper::get_form_input_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Mitech_Helper::get_form_input_css_selector(),
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'form_input_focus_color',
	'label'       => esc_html__( 'Focus Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of form inputs when focus.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
		'border'     => esc_attr__( 'Border', 'mitech' ),
	),
	'default'     => array(
		'color'      => Mitech::PRIMARY_COLOR,
		'background' => '#f5f5f5',
		'border'     => Mitech::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => Mitech_Helper::get_form_input_focus_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Mitech_Helper::get_form_input_focus_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Mitech_Helper::get_form_input_focus_css_selector(),
			'property' => 'background-color',
		),
	),
) );
