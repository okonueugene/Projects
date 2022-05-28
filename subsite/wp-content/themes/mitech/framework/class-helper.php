<?php
defined( 'ABSPATH' ) || exit;

/**
 * Helper functions
 */
if ( ! class_exists( 'Mitech_Helper' ) ) {
	class Mitech_Helper {

		static $preloader_style = array();

		function __construct() {
			self::$preloader_style = array(
				'rotating-plane'  => esc_attr__( 'Rotating Plane', 'mitech' ),
				'double-bounce'   => esc_attr__( 'Double Bounce', 'mitech' ),
				'three-bounce'    => esc_attr__( 'Three Bounce', 'mitech' ),
				'wave'            => esc_attr__( 'Wave', 'mitech' ),
				'wandering-cubes' => esc_attr__( 'Wandering Cubes', 'mitech' ),
				'pulse'           => esc_attr__( 'Pulse', 'mitech' ),
				'chasing-dots'    => esc_attr__( 'Chasing dots', 'mitech' ),
				'circle'          => esc_attr__( 'Circle', 'mitech' ),
				'cube-grid'       => esc_attr__( 'Cube Grid', 'mitech' ),
				'fading-circle'   => esc_attr__( 'Fading Circle', 'mitech' ),
				'folding-cube'    => esc_attr__( 'Folding Cube', 'mitech' ),
				'gif-image'       => esc_attr__( 'Gif Image', 'mitech' ),
			);
		}

		public static function e( $var = '' ) {
			echo "{$var}";
		}

		public static function get_preloader_list() {
			$list = self::$preloader_style + array( 'random' => esc_attr__( 'Random', 'mitech' ) );

			return $list;
		}

		public static function get_post_meta( $name, $default = false ) {
			global $mitech_page_options;

			if ( $mitech_page_options != false && isset( $mitech_page_options[ $name ] ) ) {
				return $mitech_page_options[ $name ];
			}

			return $default;
		}

		public static function get_the_post_meta( $options, $name, $default = false ) {
			if ( $options != false && isset( $options[ $name ] ) ) {
				return $options[ $name ];
			}

			return $default;
		}

		/**
		 * @return array
		 */
		public static function get_list_revslider() {
			global $wpdb;
			$revsliders = array(
				'' => esc_attr__( 'Select a slider', 'mitech' ),
			);

			if ( function_exists( 'rev_slider_shortcode' ) ) {

				$table_name = $wpdb->prefix . 'revslider_sliders';
				$query      = $wpdb->prepare( "SELECT * FROM $table_name WHERE type != %s ORDER BY title ASC", 'template' );
				$results    = $wpdb->get_results( $query );
				if ( ! empty( $results ) ) {
					foreach ( $results as $result ) {
						$revsliders[ $result->alias ] = $result->title;
					}
				}
			}

			return $revsliders;
		}

		/**
		 * @param bool $default_option
		 *
		 * @return array
		 */
		public static function get_registered_sidebars( $default_option = false, $empty_option = true ) {
			global $wp_registered_sidebars;
			$sidebars = array();
			if ( $empty_option === true ) {
				$sidebars['none'] = esc_html__( 'No Sidebar', 'mitech' );
			}
			if ( $default_option === true ) {
				$sidebars['default'] = esc_html__( 'Default', 'mitech' );
			}
			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebars[ $sidebar['id'] ] = $sidebar['name'];
			}

			return $sidebars;
		}

		/**
		 * Get list sidebar positions
		 *
		 * @return array
		 */
		public static function get_list_sidebar_positions( $default = false ) {
			$positions = array(
				'left'  => esc_html__( 'Left', 'mitech' ),
				'right' => esc_html__( 'Right', 'mitech' ),
			);


			if ( $default === true ) {
				$positions['default'] = esc_html__( 'Default', 'mitech' );
			}

			return $positions;
		}

		/**
		 * Get content of file
		 *
		 * @param string $path
		 *
		 * @return mixed
		 */
		static function get_file_contents( $path = '' ) {
			$content = '';
			if ( $path !== '' ) {
				global $wp_filesystem;

				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();

				if ( file_exists( $path ) ) {
					$content = $wp_filesystem->get_contents( $path );
				}
			}

			return $content;
		}

		public static function strposa( $haystack, $needle, $offset = 0 ) {
			if ( ! is_array( $needle ) ) {
				$needle = array( $needle );
			}
			foreach ( $needle as $query ) {
				if ( strpos( $haystack, $query, $offset ) !== false ) {
					return true;
				} // stop on first true result
			}

			return false;
		}

		public static function w3c_iframe( $iframe ) {
			$iframe = str_replace( 'frameborder="0"', '', $iframe );
			$iframe = str_replace( 'frameborder="no"', '', $iframe );
			$iframe = str_replace( 'scrolling="no"', '', $iframe );
			$iframe = str_replace( 'gesture="media"', '', $iframe );
			$iframe = str_replace( 'allow="encrypted-media"', '', $iframe );

			return $iframe;
		}

		public static function get_md_media_query() {
			return '@media (max-width: 1199px)';
		}

		public static function get_sm_media_query() {
			return '@media (max-width: 991px)';
		}

		public static function get_xs_media_query() {
			return '@media (max-width: 767px)';
		}

		public static function get_animation_list( $args = array() ) {
			return array(
				'none'       => esc_html__( 'None', 'mitech' ),
				'fade-in'    => esc_html__( 'Fade In', 'mitech' ),
				'move-up'    => esc_html__( 'Move Up', 'mitech' ),
				'move-down'  => esc_html__( 'Move Down', 'mitech' ),
				'move-left'  => esc_html__( 'Move Left', 'mitech' ),
				'move-right' => esc_html__( 'Move Right', 'mitech' ),
				'scale-up'   => esc_html__( 'Scale Up', 'mitech' ),
				'pop-up'     => esc_html__( 'Pop Up', 'mitech' ),
			);
		}

		public static function get_animation_classes( $animation = 'move-up' ) {
			$classes = '';
			if ( $animation === '' ) {
				$animation = 'move-up';
			}

			if ( $animation !== 'none' ) {
				$classes .= " tm-animation $animation";
			}

			return $classes;
		}

		public static function get_grid_animation_classes( $animation = 'move-up' ) {
			$classes = '';
			if ( $animation === '' ) {
				$animation = 'move-up';
			}

			if ( $animation !== 'none' ) {
				$classes .= " has-animation $animation";
			}

			return $classes;
		}

		public static function get_css_prefix( $property, $value ) {
			$css = '';
			switch ( $property ) {
				case 'border-radius' :
					$css = "-moz-border-radius: {$value};-webkit-border-radius: {$value};border-radius: {$value};";
					break;

				case 'box-shadow' :
					$css = "-moz-box-shadow: {$value};-webkit-box-shadow: {$value};box-shadow: {$value};";
					break;

				case 'order' :
					$css = "-webkit-order: $value; -moz-order: $value; order: $value;";
					break;
			}

			return $css;
		}

		public static function get_shortcode_color_inherit( $color = '', $custom = '' ) {
			$primary_color   = Mitech::setting( 'primary_color' );
			$secondary_color = Mitech::setting( 'secondary_color' );

			switch ( $color ) {
				case 'primary' :
					$_color = $primary_color;
					break;

				case 'secondary' :
					$_color = $secondary_color;
					break;

				case 'custom' :
					$_color = $custom;
					break;

				default:
					$_color = '#111111';
					break;
			}

			return $_color;
		}

		public static function get_shortcode_css_color_inherit( $attr = 'color', $color = '', $custom = '', $gradient = '' ) {
			$primary_color   = Mitech::setting( 'primary_color' );
			$secondary_color = Mitech::setting( 'secondary_color' );

			$gradient = isset( $gradient ) ? $gradient : '';

			$css = '';
			switch ( $color ) {
				case 'primary' :
					$css = "$attr: {$primary_color};";
					break;

				case 'secondary' :
					$css = "$attr: {$secondary_color};";
					break;

				case 'custom' :
					if ( $custom !== '' ) {
						$css = "$attr: {$custom};";
					}

					break;

				case 'transparent' :
					$css = "$attr: transparent;";
					break;

				case 'gradient' :
					$css = $gradient;

					if ( $attr === 'color' ) {
						$css .= 'color:transparent;-webkit-background-clip: text;background-clip: text;';
					}

					break;
			}

			return $css;
		}

		public static function get_vc_icon_template( $args = array() ) {
			$defaults = array(
				'type'         => '',
				'icon'         => '',
				'class'        => '',
				'parent_hover' => '.tm-box-icon',
			);

			$args = wp_parse_args( $args, $defaults );

			vc_icon_element_fonts_enqueue( $args['type'] );

			switch ( $args['type'] ) {
				case 'linea_svg':
					$_svg = MITECH_THEME_URI . "/assets/svg/linea/{$args['icon']}.svg";
					?>
					<div class="icon">
						<div class="tm-svg"
						     data-svg="<?php echo esc_url( $_svg ); ?>"
							<?php if ( isset( $args['svg_animate'] ) ): ?>
								data-type="<?php echo esc_attr( $args['svg_animate'] ); ?>"
							<?php endif; ?>
							<?php if ( $args['parent_hover'] !== '' ) : ?>
								data-hover="<?php echo esc_attr( $args['parent_hover'] ); ?>"
							<?php endif; ?>
						></div>
					</div>
					<?php
					break;
				default:
					?>
					<div class="icon">
						<span class="<?php echo esc_attr( $args['icon'] ); ?>"></span>
					</div>
					<?php
					break;
			}
		}

		public static function get_top_bar_list( $default_option = false ) {

			$results = array(
				'none' => esc_html__( 'Hide', 'mitech' ),
				'01'   => esc_html__( 'Top Bar 01', 'mitech' ),
				'02'   => esc_html__( 'Top Bar 02', 'mitech' ),
				'03'   => esc_html__( 'Top Bar 03', 'mitech' ),
				'04'   => esc_html__( 'Top Bar 04', 'mitech' ),
			);

			if ( $default_option === true ) {
				$results = array( '' => esc_html__( 'Default', 'mitech' ) ) + $results;
			}

			return $results;
		}

		public static function get_header_list( $default_option = false, $default_text = '' ) {

			$headers = array(
				'none' => esc_html__( 'Hide', 'mitech' ),
				'01'   => esc_html__( '01 - Standard - Dark', 'mitech' ),
				'02'   => esc_html__( '02 - Standard 02 - Dark', 'mitech' ),
				'03'   => esc_html__( '03 - Standard - Overlay - Light', 'mitech' ),
				'04'   => esc_attr__( '04 - Below Nav - Dark', 'mitech' ),
				'05'   => esc_attr__( '05 - Below Filled Nav - Dark', 'mitech' ),
				'06'   => esc_attr__( '06 - Minimal - Simple - Overlay - Dark', 'mitech' ),
				'07'   => esc_html__( '07 - Standard - Fluid - Overlay - Light', 'mitech' ),
				'08'   => esc_html__( '08 - Standard 03 - Dark', 'mitech' ),
				'09'   => esc_html__( '09 - Standard - Overlay - Dark', 'mitech' ),
			);

			if ( $default_option === true ) {
				if ( $default_text === '' ) {
					$default_text = esc_html__( 'Default', 'mitech' );
				}

				$headers = array( '' => $default_text ) + $headers;
			}

			return $headers;
		}

		public static function get_title_bar_list( $default_option = false, $default_text = '' ) {

			$options = array(
				'none' => esc_html__( 'Hide', 'mitech' ),
				'01'   => esc_html__( 'Style 01', 'mitech' ),
			);

			if ( $default_option === true ) {
				if ( $default_text === '' ) {
					$default_text = esc_html__( 'Default', 'mitech' );
				}

				$options = array( '' => $default_text ) + $options;
			}

			return $options;
		}

		public static function get_sample_countdown_date() {
			$date = date( 'm/d/Y H:i:s', strtotime( '+1 month', strtotime( date( 'm/d/Y H:i:s' ) ) ) );

			return $date;
		}

		/**
		 * process aspect ratio fields
		 */
		public static function process_chart_aspect_ratio( $ar = '4:3', $width = 500 ) {
			$AR = explode( ':', $ar );

			$rat1 = $AR[0];
			$rat2 = $AR[1];

			$height = ( $width / $rat1 ) * $rat2;

			return $height;
		}

		public static function get_body_font() {
			$font = Mitech::setting( 'typography_body' );

			if ( isset( $font['font-family'] ) ) {
				return "{$font['font-family']} Helvetica, Arial, sans-serif";
			}

			return 'Helvetica, Arial, sans-serif';
		}

		/**
		 * Check search page has results
		 *
		 * @return boolean true if has any results
		 */
		public static function is_search_has_results() {
			if ( is_search() ) {
				global $wp_query;
				$result = ( 0 != $wp_query->found_posts ) ? true : false;

				return $result;
			}

			return 0 != $GLOBALS['wp_query']->found_posts;
		}

		public static function get_button_css_selector() {
			return '
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.tm-button.style-flat,
				.tm-button.style-solid,
				.button,
				.wishlist-btn.style-01 a,
				.compare-btn.style-01 a
				';
		}

		public static function get_button_hover_css_selector() {
			return '
				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				.tm-button.style-flat:hover,
				.tm-button.style-solid:hover,
				.button:hover,
				.button:focus,
				.wishlist-btn.style-01 a:hover,
				.compare-btn.style-01 a:hover
				';
		}

		public static function get_form_input_css_selector() {
			return "
			input[type='text'],
			input[type='email'],
			input[type='url'],
			input[type='password'],
			input[type='search'],
			input[type='number'],
			input[type='tel'],
			select,
			textarea
		";
		}

		public static function get_form_input_focus_css_selector() {
			return "
			input[type='text']:focus,
			input[type='email']:focus,
			input[type='url']:focus,
			input[type='password']:focus,
			input[type='search']:focus,
			input[type='number']:focus,
			input[type='tel']:focus,
			textarea:focus, select:focus,
			select:focus,
			textarea:focus
		";
		}

		public static function get_mailchimp_form_id() {
			$form_id = '';

			if ( function_exists( 'mc4wp_get_forms' ) ) {
				$mc_forms = mc4wp_get_forms();
				if ( count( $mc_forms ) > 0 ) {
					$form_id = $mc_forms[0]->ID;
				}
			}

			return $form_id;
		}

		public static function get_tooltip_skin_list() {
			return array(
				''          => esc_html__( 'Black', 'mitech' ),
				'white'     => esc_html__( 'White', 'mitech' ),
				'primary'   => esc_html__( 'Primary Color', 'mitech' ),
				'secondary' => esc_html__( 'Secondary Color', 'mitech' ),
			);
		}

		public static function get_grid_filter_classes( $atts ) {
			$classes = '';

			if ( $atts['filter_wrap'] === '1' ) {
				$classes .= ' filter-wrap';
			}

			if ( $atts['filter_style'] !== '' ) {
				$classes .= " filter-style-{$atts['filter_style']}";
			}

			return $classes;
		}
	}

	new Mitech_Helper();
}
