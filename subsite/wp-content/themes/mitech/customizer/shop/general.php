<?php
$section  = 'shop_general';
$priority = 1;
$prefix   = 'shop_general_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'shop_badge_new',
	'label'       => esc_html__( 'New Badge (Days)', 'mitech' ),
	'description' => esc_html__( 'If the product was published within the newness time frame display the new badge.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '30',
	'choices'     => array(
		'0'  => esc_html__( 'None', 'mitech' ),
		'1'  => esc_html__( '1 day', 'mitech' ),
		'2'  => esc_html__( '2 days', 'mitech' ),
		'3'  => esc_html__( '3 days', 'mitech' ),
		'4'  => esc_html__( '4 days', 'mitech' ),
		'5'  => esc_html__( '5 days', 'mitech' ),
		'6'  => esc_html__( '6 days', 'mitech' ),
		'7'  => esc_html__( '7 days', 'mitech' ),
		'8'  => esc_html__( '8 days', 'mitech' ),
		'9'  => esc_html__( '9 days', 'mitech' ),
		'10' => esc_html__( '10 days', 'mitech' ),
		'15' => esc_html__( '15 days', 'mitech' ),
		'20' => esc_html__( '20 days', 'mitech' ),
		'25' => esc_html__( '25 days', 'mitech' ),
		'30' => esc_html__( '30 days', 'mitech' ),
		'60' => esc_html__( '60 days', 'mitech' ),
		'90' => esc_html__( '90 days', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_badge_hot',
	'label'    => esc_html__( 'Hot Badge', 'mitech' ),
	'tooltip'  => esc_html__( 'Show a "hot" label when product set featured.', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_badge_sale',
	'label'    => esc_html__( 'Sale Badge', 'mitech' ),
	'tooltip'  => esc_html__( 'Show a "sale" or "sale percent" label when product on sale.', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Colors', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_new_color',
	'label'     => esc_html__( 'New Badge Color', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#38cb89',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product-badges .new',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product-badges .new',
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_hot_color',
	'label'     => esc_html__( 'Hot Badge Color', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#d3122a',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product-badges .hot',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product-badges .hot',
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_sale_color',
	'label'     => esc_html__( 'Sale Badge Color', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#f6b500',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product-badges .onsale',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product-badges .onsale',
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_price_color',
	'label'     => esc_html__( 'Price Color', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'regular' => esc_attr__( 'Old Price', 'mitech' ),
		'sale'    => esc_attr__( 'Price', 'mitech' ),
	),
	'default'   => array(
		'regular' => '#b6b7d2',
		'sale'    => Mitech::PRIMARY_COLOR,
	),
	'output'    => array(
		array(
			'choice'   => 'regular',
			'element'  => '.price del, .woosw-content-item--price del, .tr-price del',
			'property' => 'color',
		),
		array(
			'choice'   => 'sale',
			'element'  => '.price, .woosw-content-item--price, .tr-price',
			'property' => 'color',
		),
	),
) );
