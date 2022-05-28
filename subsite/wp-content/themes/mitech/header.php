<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section
 *
 * @link     https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package  Mitech
 * @since    1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php Mitech_THA::instance()->head_top(); ?>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset', 'display' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url', 'display' ) ); ?>">
	<?php endif; ?>
	<?php Mitech_THA::instance()->head_bottom(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php Mitech::body_attributes(); ?>>

<?php Mitech_Templates::pre_loader(); ?>

<?php Mitech_THA::instance()->body_top(); ?>

<div id="page" class="site">
	<div class="content-wrapper">
		<?php Mitech_Templates::slider( 'above' ); ?>
		<?php Mitech_Templates::top_bar(); ?>
		<?php Mitech_Templates::header(); ?>
		<?php Mitech_Templates::slider( 'below' ); ?>
