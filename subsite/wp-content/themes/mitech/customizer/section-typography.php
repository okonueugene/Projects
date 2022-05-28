<?php
$section  = 'typography';
$priority = 1;
$prefix   = 'typography_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="desc"><strong class="insight-label insight-label-info">' . esc_html__( 'IMPORTANT NOTE: ', 'mitech' ) . '</strong>' . esc_html__( 'This section contains general typography options. Additional typography options for specific areas can be found within other sections. Example: For breadcrumb typography options go to the breadcrumb section.', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'kirki_typography',
	'settings'  => 'secondary_font',
	'label'     => esc_html__( 'Secondary Font family', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => array(
		'font-family' => Mitech::SECONDARY_FONT,
	),
	'choices'   => array(
		'variant' => array(
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
		),
	),
	'output'    => array(
		array(
			'element' => '.secondary-font',
		),
	),
) );

/*--------------------------------------------------------------
# Body Typography
--------------------------------------------------------------*/
Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Body Typography', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'body',
	'label'       => esc_html__( 'Font family', 'mitech' ),
	'description' => esc_html__( 'These settings control the typography for all body text.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Mitech::PRIMARY_FONT,
		'variant'        => '400',
		'font-size'      => '15px',
		'line-height'    => '1.74',
		'letter-spacing' => '0em',
	),
	'choices'     => array(
		'variant' => array(
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'700',
			'700italic',
		),
	),
	'output'      => array(
		array(
			'element' => 'body, .gmap-marker-wrap',
		),
	),
) );

/*--------------------------------------------------------------
# Heading typography
--------------------------------------------------------------*/
Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading Typography', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'heading',
	'label'       => esc_html__( 'Font family', 'mitech' ),
	'description' => esc_html__( 'These settings control the typography for all heading text.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Mitech::PRIMARY_FONT,
		'variant'        => '700',
		'line-height'    => '1.42',
		'letter-spacing' => '0em',
	),
	'choices'     => array(
		'variant' => array(
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
		),
	),
	'output'      => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,th,[class*="hint--"]:after',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h1_font_size',
	'label'       => esc_html__( 'Font size', 'mitech' ),
	'description' => esc_html__( 'H1', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 56,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h1',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h2_font_size',
	'description' => esc_html__( 'H2', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 48,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h2',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h3_font_size',
	'description' => esc_html__( 'H3', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 36,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h3',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h4_font_size',
	'description' => esc_html__( 'H4', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 24,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h4',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h5_font_size',
	'description' => esc_html__( 'H5', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 18,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h5',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h6_font_size',
	'description' => esc_html__( 'H6', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h6',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'strong_font_weight',
	'label'       => esc_html__( 'Font Weight', 'mitech' ),
	'description' => esc_html__( 'Controls font weight of &lt;strong&gt;, &lt;b&gt; tags', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '700',
	'transport'   => 'auto',
	'choices'     => array(
		'400' => esc_html__( '400 - Regular', 'mitech' ),
		'500' => esc_html__( '500 - Medium', 'mitech' ),
		'600' => esc_html__( '600 - Semi Bold', 'mitech' ),
		'700' => esc_html__( '700 - Bold', 'mitech' ),
		'800' => esc_html__( '800 - Extra Bold', 'mitech' ),
		'900' => esc_html__( '900 - Ultra Bold (Black)', 'mitech' ),
	),
	'output'      => array(
		array(
			'element'  => 'b, strong',
			'property' => 'font-weight',
		),
	),
) );

/*--------------------------------------------------------------
# Button
--------------------------------------------------------------*/
Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Buttons', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => 'button_typography',
	'label'       => esc_html__( 'Font family', 'mitech' ),
	'description' => esc_html__( 'These settings control the typography for buttons.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => 'inherit',
		'variant'        => '600',
		'letter-spacing' => '0em',
		'font-size'      => '14px',
		'text-transform' => '',
	),
	'choices'     => array(
		'variant' => array(
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'700',
			'700italic',
		),
	),
	'output'      => array(
		array(
			'element' => Mitech_Helper::get_button_css_selector(),
		),
		array(
			'element' => '.rev-btn',
		),
	),
) );

/*--------------------------------------------------------------
# Form
--------------------------------------------------------------*/
Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Form Inputs', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => 'form_typography',
	'label'       => esc_html__( 'Font family', 'mitech' ),
	'description' => esc_html__( 'These settings control the typography for form inputs.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => 'regular',
		'letter-spacing' => '0em',
		'font-size'      => '15px',
	),
	'choices'     => array(
		'variant' => array(
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'700',
			'700italic',
		),
	),
	'output'      => array(
		array(
			'element' => Mitech_Helper::get_form_input_css_selector(),
		),
	),
) );
