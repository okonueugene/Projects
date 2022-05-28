<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin installation and activation for WordPress themes
 */
if ( ! class_exists( 'Mitech_Register_Plugins' ) ) {
	class Mitech_Register_Plugins {

		public function __construct() {
			add_filter( 'insight_core_tgm_plugins', array( $this, 'register_required_plugins' ) );
		}

		public function register_required_plugins( $plugins ) {
			/*
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$new_plugins = array(
				array(
					'name'     => esc_html__( 'Insight Core', 'mitech' ),
					'slug'     => 'insight-core',
					'source'   => 'https://api.thememove.com/download/insight-core-2.2.2-ryEahu2ocK.zip',
					'version'  => '2.2.2',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'Mitech Extension', 'mitech' ),
					'slug'     => 'mitech-extension',
					'source'   => 'https://api.thememove.com/download/mitech-extension-1.0.1-VoNRFch2C8.zip',
					'version'  => '1.0.1',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'WPBakery Page Builder', 'mitech' ),
					'slug'     => 'js_composer',
					'source'   => 'https://api.thememove.com/download/js_composer-6.7.0-KEAEPahlOv.zip',
					'version'  => '6.7.0',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'WPBakery Page Builder (Visual Composer) Clipboard', 'mitech' ),
					'slug'    => 'vc_clipboard',
					'source'  => 'https://api.thememove.com/download/vc_clipboard-4.5.8-6x4EjSaacf.zip',
					'version' => '4.5.8',
				),
				array(
					'name' => esc_html__( 'Contact Form 7', 'mitech' ),
					'slug' => 'contact-form-7',
				),
				array(
					'name' => esc_html__( 'MailChimp for WordPress', 'mitech' ),
					'slug' => 'mailchimp-for-wp',
				),
				array(
					'name' => esc_html__( 'Image Hotspot by DevVN', 'mitech' ),
					'slug' => 'devvn-image-hotspot',
				),
				array(
					'name' => esc_html__( 'WP-PostViews', 'mitech' ),
					'slug' => 'wp-postviews',
				),
				array(
					'name'     => esc_html__( 'Revolution Slider', 'mitech' ),
					'slug'     => 'revslider',
					'source'   => 'https://api.thememove.com/download/revslider-6.5.6-TNs1NeqSt4.zip',
					'version'  => '6.5.6',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'Instagram Feed', 'mitech' ),
					'slug'    => 'elfsight-instagram-feed-cc',
					'source'  => 'https://api.thememove.com/download/elfsight-instagram-feed-cc-4.0.2-dYYYZeP8Zo.zip',
					'version' => '4.0.2',
				),
				array(
					'name' => esc_html__( 'WooCommerce', 'mitech' ),
					'slug' => 'woocommerce',
				),
				array(
					'name'     => esc_html__( 'WooCommerce Smart Quick View', 'mitech' ),
					'slug'     => 'woo-smart-quick-view',
					'required' => false,
				),
				array(
					'name' => esc_html__( 'WPC Smart Compare for WooCommerce', 'mitech' ),
					'slug' => 'woo-smart-compare',
				),
				array(
					'name' => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'mitech' ),
					'slug' => 'woo-smart-wishlist',
				),
			);

			$plugins = array_merge( $plugins, $new_plugins );

			return $plugins;
		}

	}

	new Mitech_Register_Plugins();
}
