<?php
defined( 'ABSPATH' ) || exit;

/**
 * Setup for customizer of this theme
 */
if ( ! class_exists( 'Mitech_Customize' ) ) {
	class Mitech_Customize {

		protected static $instance = null;

		protected static $override_settings = array();

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init() {
			// Build URL for customizer.
			add_filter( 'kirki_values_get_value', array( $this, 'kirki_db_get_theme_mod_value' ), 10, 2 );

			add_filter( 'kirki_theme_stylesheet', array( $this, 'change_inline_stylesheet' ), 10, 3 );

			add_filter( 'kirki_load_fontawesome', '__return_false' );

			// Disable Telemetry module.
			add_filter( 'kirki_telemetry', '__return_false' );

			// Remove unused native sections and controls.
			add_action( 'customize_register', array( $this, 'remove_customizer_sections' ) );

			// Add custom font to font select
			add_filter( 'kirki_fonts_standard_fonts', array( $this, 'add_custom_font' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_custom_font_css' ) );

			// Load customizer sections when all widgets init.
			add_action( 'init', array( $this, 'load_customizer' ), 99 );

			add_action( 'customize_controls_init', array(
				$this,
				'customize_preview_css',
			) );

			add_action( 'wp', array( $this, 'init_global_variable' ) );
		}

		function init_global_variable() {
			// Make preset in meta box.
			if ( ! is_customize_preview() ) {
				$presets = apply_filters( 'mitech_page_meta_box_presets', array() );

				if ( ! empty( $presets ) ) {
					foreach ( $presets as $preset ) {
						$page_preset_value = Mitech_Helper::get_post_meta( $preset );
						if ( $page_preset_value !== false ) {
							$_GET[ $preset ] = $page_preset_value;
						}
					}
				}
			}

			// Setup url.
			if ( empty( self::$override_settings ) ) {
				if ( ! empty( $_GET ) ) {

					foreach ( $_GET as $key => $query_value ) {
						if ( class_exists( 'Kirki' ) && ! empty( Kirki::$fields[ $key ] ) ) {

							if ( is_array( Kirki::$fields[ $key ] ) &&
							     ( 'kirki-preset' == Kirki::$fields[ $key ]['type'] || 'kirki-select' == Kirki::$fields[ $key ]['type'] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'][ $query_value ] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'][ $query_value ]['settings'] )
							) {
								$field_choice = Kirki::$fields[ $key ]['args']['choices'];
								foreach ( $field_choice[ $query_value ]['settings'] as $kirki_setting => $kirki_value ) {
									self::$override_settings[ $kirki_setting ] = $kirki_value;
								}
							} else {
								self::$override_settings[ $key ] = $query_value;
							}
						}
					}
				}
			}
		}

		public function change_inline_stylesheet() {
			return 'mitech-style';
		}

		function add_custom_font( $fonts ) {
			$fonts['cerebrisans'] = array(
				'label'    => 'CerebriSans',
				'variants' => array( 300, '300italic', 'regular', 'italic', 700, '700italic' ),
				'stack'    => 'CerebriSans, sans-serif',
			);

			return $fonts;
		}

		function add_custom_font_css() {
			$typo_fields = Mitech_Kirki::get_typography_fields_id();

			if ( ! is_array( $typo_fields ) || empty( $typo_fields ) ) {
				return;
			}

			foreach ( $typo_fields as $field ) {
				$value = Mitech::setting( $field );

				if ( is_array( $value ) && isset( $value['font-family'] ) && $value['font-family'] !== '' ) {
					switch ( $value['font-family'] ) {
						case 'CerebriSans':
							wp_enqueue_style( 'cerebrisans-font', MITECH_THEME_URI . '/assets/fonts/cerebrisans/cerebrisans.css', null, null );
							break;
						default:
							do_action( 'mitech_enqueue_custom_font', $value['font-family'] ); // hook to custom do enqueue fonts
							break;
					}
				}
			}
		}

		/**
		 * Add customize preview css
		 */
		public function customize_preview_css() {
			wp_enqueue_style( 'kirki-custom-css', MITECH_THEME_URI . '/assets/admin/css/customizer.min.css' );
		}

		/**
		 * Load Customizer.
		 */
		public function load_customizer() {
			require_once MITECH_CUSTOMIZER_DIR . '/customizer.php';
		}

		/**
		 * Remove unused native sections and controls
		 *
		 * @since 0.9.3
		 *
		 * @param $wp_customize
		 */
		public function remove_customizer_sections( $wp_customize ) {
			$wp_customize->remove_section( 'nav' );
			$wp_customize->remove_section( 'colors' );
			$wp_customize->remove_section( 'background_image' );
			$wp_customize->remove_section( 'header_image' );

			$wp_customize->get_section( 'title_tagline' )->priority = '100';

			$wp_customize->remove_control( 'blogdescription' );
			$wp_customize->remove_control( 'display_header_text' );
		}

		/**
		 * Build URL for customizer
		 *
		 * @param $value
		 * @param $setting
		 *
		 * @return mixed
		 */
		public function kirki_db_get_theme_mod_value( $value, $setting ) {
			if ( ! is_customize_preview() && ! empty( self::$override_settings ) && isset( self::$override_settings["{$setting}"] ) ) {
				return self::$override_settings["{$setting}"];
			}

			return $value;
		}

		function field_social_networks_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Social Networks', 'mitech' ),
				'description' => '<a href="javascript:wp.customize.section( \'socials\' ).focus();">' . esc_html__( 'Edit social network links', 'mitech' ) . '</a>',
				'default'     => '0',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'mitech' ),
					'1' => esc_html__( 'Show', 'mitech' ),
				),
			);

			$args = wp_parse_args( $args, $defaults );

			Mitech_Kirki::add_field( 'theme', $args );
		}

		function field_social_sharing_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Sharing', 'mitech' ),
				'description' => '<a href="javascript:wp.customize.section( \'social_sharing\' ).focus();">' . esc_html__( 'Edit social sharing list', 'mitech' ) . '</a>',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'mitech' ),
					'1' => esc_html__( 'Show', 'mitech' ),
				),
			);

			$args = wp_parse_args( $args, $defaults );

			Mitech_Kirki::add_field( 'theme', $args );
		}

		function field_language_switcher_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Language Switcher', 'mitech' ),
				'description' => '',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'mitech' ),
					'1' => esc_html__( 'Show', 'mitech' ),
				),
				'default'     => '0',
			);

			$args = wp_parse_args( $args, $defaults );

			Mitech_Kirki::add_field( 'theme', $args );
		}

		function field_wishlist_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Wishlist', 'mitech' ),
				'description' => '',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'mitech' ),
					'1' => esc_html__( 'Show', 'mitech' ),
				),
				'default'     => '0',
			);

			$args = wp_parse_args( $args, $defaults );

			Mitech_Kirki::add_field( 'theme', $args );
		}

		function field_user_link_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'User link', 'mitech' ),
				'description' => '',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'mitech' ),
					'1' => esc_html__( 'Show', 'mitech' ),
				),
				'default'     => '0',
			);

			$args = wp_parse_args( $args, $defaults );

			Mitech_Kirki::add_field( 'theme', $args );
		}
	}

	Mitech_Customize::instance()->init();
}
