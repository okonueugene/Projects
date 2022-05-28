<?php
defined( 'ABSPATH' ) || exit;

/**
 * Initial OneClick import for this theme
 */
if ( ! class_exists( 'Mitech_Import' ) ) {
	class Mitech_Import {

		public function __construct() {
			add_filter( 'insight_core_import_demos', array( $this, 'import_demos' ) );
			add_filter( 'insight_core_import_generate_thumb', array( $this, 'import_generate_thumb' ) );
		}

		public function import_demos() {
			return array(
				'main' => array(
					'screenshot' => MITECH_THEME_URI . '/screenshot.jpg',
					'name'       => esc_html__( 'Main', 'mitech' ),
					'url'        => 'https://api.thememove.com/import/mitech/mitech-insightcore01-main-1.5.0.zip',
				),
				'rtl'  => array(
					'screenshot' => MITECH_THEME_URI . '/assets/import/rtl/screenshot.jpg',
					'name'       => esc_html__( 'RTL', 'mitech' ),
					'url'        => 'https://api.thememove.com/import/mitech/mitech-insightcore01-rtl-1.5.0.zip',
				),
			);
		}

		/**
		 * Generate thumbnail while importing
		 */
		function import_generate_thumb() {
			return true;
		}
	}

	new Mitech_Import();
}
