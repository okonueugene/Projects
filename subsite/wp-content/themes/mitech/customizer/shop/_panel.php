<?php
$panel    = 'shop';
$priority = 1;

Mitech_Kirki::add_section( 'shop_general', array(
	'title'    => esc_html__( 'General', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'shop_archive', array(
	'title'    => esc_html__( 'Shop Archive', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'shop_single', array(
	'title'    => esc_html__( 'Shop Single', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'shopping_cart', array(
	'title'    => esc_html__( 'Shopping Cart', 'mitech' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
