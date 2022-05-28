<?php
$section  = 'notices';
$priority = 1;
$prefix   = 'notice_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Cookie Notice', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'notice_cookie_enable',
	'label'       => esc_html__( 'Cookie Notice', 'mitech' ),
	'description' => esc_html__( 'The notice about cookie auto show when a user visits the site.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'notice_cookie_messages',
	'label'       => esc_html__( 'Messages', 'mitech' ),
	'description' => esc_html__( 'Enter the messages that displays for cookie notice.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => 'notice_cookie_button_text',
	'label'    => esc_html__( 'Button Text', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Ok, got it!', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Newsletter Popup', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'newsletter_popup_enable',
	'label'       => esc_html__( 'Newsletter Popup', 'mitech' ),
	'description' => esc_html__( 'Show newsletter popup that help you get more newsletter subscribers.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => 'newsletter_popup_heading',
	'label'    => esc_html__( 'Heading', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Newsletter', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => 'newsletter_popup_description',
	'label'    => esc_html__( 'Description', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( '* Be the first to learn about our latest trends and get exclusive offers.', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'newsletter_popup_image',
	'label'    => esc_html__( 'Image', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => MITECH_THEME_IMAGE_URI . '/newsletter-popup-image.png',
) );
