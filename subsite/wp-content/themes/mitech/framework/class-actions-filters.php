<?php
defined( 'ABSPATH' ) || exit;

/**
 * Custom filters that act independently of the theme templates
 */
if ( ! class_exists( 'Mitech_Actions_Filters' ) ) {
	class Mitech_Actions_Filters {

		public function __construct() {
			add_filter( 'wp_kses_allowed_html', array( $this, 'wp_kses_allowed_html' ), 2, 99 );

			/* Move post count inside the link */
			add_filter( 'wp_list_categories', array( $this, 'move_post_count_inside_link_category' ) );
			/* Move post count inside the link */
			add_filter( 'get_archives_link', array( $this, 'move_post_count_inside_link_archive' ) );

			add_filter( 'comment_form_fields', array( $this, 'move_comment_field_to_bottom' ) );

			add_filter( 'embed_oembed_html', array( $this, 'add_wrapper_for_video' ), 10, 3 );
			add_filter( 'video_embed_html', array( $this, 'add_wrapper_for_video' ) ); // Jetpack.

			add_filter( 'excerpt_length', array(
				$this,
				'custom_excerpt_length',
			), 999 ); // Change excerpt length is set to 55 words by default.

			// Adds custom classes to the array of body classes.
			add_filter( 'body_class', array( $this, 'body_classes' ) );

			// Adds custom attributes to body tag.
			add_filter( 'mitech_body_attributes', array( $this, 'add_attributes_to_body' ) );

			if ( ! is_admin() ) {
				add_action( 'pre_get_posts', array( $this, 'alter_search_loop' ), 1 );
				add_filter( 'pre_get_posts', array( $this, 'search_filter' ) );
				add_filter( 'pre_get_posts', array( $this, 'empty_search_filter' ) );
			}

			// Add inline style for shortcode.
			add_action( 'wp_footer', array( $this, 'shortcode_style' ), 99 );

			add_filter( 'insightcore_bmw_nav_args', array( $this, 'add_extra_params_to_insightcore_bmw' ) );
		}

		public function wp_kses_allowed_html( $allowedtags, $context ) {

			$basic_atts = array(
				'id'    => array(),
				'class' => array(),
				'style' => array(),
			);

			switch ( $context ) {
				case 'mitech-img':
					$allowedtags = array(
						'img' => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'src'    => array(),
							'width'  => array(),
							'height' => array(),
							'alt'    => array(),
							'srcset' => array(),
							'sizes'  => array(),
							'data-src'  => array(),
							'data-src-retina'  => array(),
						),
					);
					break;
				case 'mitech-a':
					$allowedtags = array(
						'a' => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
							'title'  => array(),
						),
					);
					break;
				case 'mitech-default' :
					$allowedtags = array(
						'a'      => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
							'title'  => array(),
						),
						'img'    => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'src'    => array(),
							'width'  => array(),
							'height' => array(),
							'alt'    => array(),
							'srcset' => array(),
							'sizes'  => array(),
						),
						'br'     => array(),
						'ul'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
							'type'  => array(),
						),
						'ol'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
							'type'  => array(),
						),
						'li'     => $basic_atts,
						'h1'     => $basic_atts,
						'h2'     => $basic_atts,
						'h3'     => $basic_atts,
						'h4'     => $basic_atts,
						'h5'     => $basic_atts,
						'h6'     => $basic_atts,
						'div'    => $basic_atts,
						'strong' => $basic_atts,
						'b'      => $basic_atts,
						'span'   => $basic_atts,
						'mark'   => $basic_atts,
						'i'      => $basic_atts,
						'del'    => $basic_atts,
						'ins'    => $basic_atts,
					);
					break;
			}

			return $allowedtags;
		}

		function add_extra_params_to_insightcore_bmw( $args ) {
			$args['link_before'] = '<div class="menu-item-wrap"><span class="menu-item-title">';
			$args['link_after']  = '</span></div>';

			return $args;
		}

		function move_post_count_inside_link_category( $links ) {
			// First remove span that added by woocommerce.
			$links = str_replace( '<span class="count">', '', $links );
			$links = str_replace( '</span>', '', $links );

			// Then add span again for both blog & shop.

			$links = str_replace( '</a> ', ' <span class="count">', $links );
			$links = str_replace( ')', '</span></a>', $links );
			$links = str_replace( '<span class="count">(', '<span class="count">', $links );

			return $links;
		}

		function move_post_count_inside_link_archive( $links ) {
			$links = str_replace( '</a>&nbsp;(', ' (', $links );
			$links = str_replace( ')', ')</a>', $links );

			$links = str_replace( '(', ' <span class="count">', $links );
			$links = str_replace( ')', '</span>', $links );

			return $links;
		}


		function change_widget_tag_cloud_args( $args ) {
			/* set the smallest & largest size in px */
			$args['separator'] = ', ';

			return $args;
		}

		function move_comment_field_to_bottom( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			if ( isset( $fields['cookies'] ) ) {
				$cookie_field = $fields['cookies'];
				unset( $fields['cookies'] );
				$fields['cookies'] = $cookie_field;
			}

			return $fields;
		}

		function shortcode_style() {
			global $mitech_shortcode_lg_css_array;
			global $mitech_shortcode_md_css_array;
			global $mitech_shortcode_sm_css_array;
			global $mitech_shortcode_xs_css_array;
			global $mitech_shortcode_lg_css;
			global $mitech_shortcode_md_css;
			global $mitech_shortcode_sm_css;
			global $mitech_shortcode_xs_css;
			$css = '';

			if ( $mitech_shortcode_lg_css && $mitech_shortcode_lg_css !== '' ) {
				$css .= $mitech_shortcode_lg_css;
			}

			if ( ! empty( $mitech_shortcode_lg_css_array ) ) {
				foreach ( $mitech_shortcode_lg_css_array as $selector => $value ) {
					$css .= "$selector { " . implode( '', $value ) . " }";
				}
			}

			if ( $mitech_shortcode_md_css && $mitech_shortcode_md_css !== '' ) {
				$css .= "@media (max-width: 1199px) { $mitech_shortcode_md_css }";
			}

			if ( ! empty( $mitech_shortcode_md_css_array ) ) {
				$css .= "@media (max-width: 1199px) {";
				foreach ( $mitech_shortcode_md_css_array as $selector => $value ) {
					$css .= "$selector { " . implode( '', $value ) . " }";
				}
				$css .= "}";
			}

			if ( $mitech_shortcode_sm_css && $mitech_shortcode_sm_css !== '' ) {
				$css .= "@media (max-width: 992px) { $mitech_shortcode_sm_css }";
			}

			if ( ! empty( $mitech_shortcode_sm_css_array ) ) {
				$css .= "@media (max-width: 992px) {";
				foreach ( $mitech_shortcode_sm_css_array as $selector => $value ) {
					$css .= "$selector { " . implode( '', $value ) . " }";
				}
				$css .= "}";
			}

			if ( $mitech_shortcode_xs_css && $mitech_shortcode_xs_css !== '' ) {
				$css .= "@media (max-width: 767px) { $mitech_shortcode_xs_css }";
			}

			if ( ! empty( $mitech_shortcode_xs_css_array ) ) {
				$css .= "@media (max-width: 767px) {";
				foreach ( $mitech_shortcode_xs_css_array as $selector => $value ) {
					$css .= "$selector { " . implode( '', $value ) . " }";
				}
				$css .= "}";
			}

			if ( $css !== '' ) : ?>
				<?php $css = Mitech_Minify::css( $css ); ?>
				<script>
					var mainStyle = document.getElementById( 'mitech-style-inline-css' );
					if ( mainStyle !== null ) {
						mainStyle.textContent += '<?php echo '' . $css; ?>';
					}
				</script>
			<?php endif;
		}

		/**
		 * @param WP_Query $query Query instance.
		 */
		public function alter_search_loop( $query ) {
			if ( $query->is_main_query() && $query->is_search() ) {
				$number_results = Mitech::setting( 'search_page_number_results' );
				$query->set( 'posts_per_page', $number_results );
			}
		}

		/**
		 * @param WP_Query $query Query instance.
		 *
		 * @return WP_Query $query
		 *
		 * Apply filters to the search query.
		 * Determines if we only want to display posts/pages and changes the query accordingly
		 */
		public function search_filter( $query ) {
			if ( $query->is_main_query() && $query->is_search ) {
				$filter = Mitech::setting( 'search_page_filter' );
				if ( $filter !== 'all' ) {
					$query->set( 'post_type', $filter );
				}
			}

			return $query;
		}

		/**
		 * Make wordpress respect the search template on an empty search
		 */
		public function empty_search_filter( $query ) {
			if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query() ) {
				$query->is_search = true;
				$query->is_home   = false;
			}

			return $query;
		}

		public function custom_excerpt_length() {
			return 999;
		}

		/**
		 * Add responsive container to embeds
		 */
		public function add_wrapper_for_video( $html, $url ) {
			$array = array(
				'youtube.com',
				'wordpress.tv',
				'vimeo.com',
				'dailymotion.com',
				'hulu.com',
			);

			if ( Mitech_Helper::strposa( $url, $array ) ) {
				$html = '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
			}

			return $html;
		}

		public function add_attributes_to_body( $attrs ) {
			$site_width = Mitech_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Mitech::setting( 'site_width' );
			}
			$attrs['data-site-width']    = $site_width;
			$attrs['data-content-width'] = 1200;

			$font = Mitech_Helper::get_body_font();

			$attrs['data-font'] = $font;

			$header_sticky_height               = Mitech::setting( 'header_sticky_height' );
			$attrs['data-header-sticky-height'] = $header_sticky_height;

			return $attrs;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		public function body_classes( $classes ) {
			// Adds a class for mobile device.
			if ( Mitech::is_mobile() ) {
				$classes[] = 'mobile';
			}

			// Adds a class for tablet device.
			if ( Mitech::is_tablet() ) {
				$classes[] = 'tablet';
			}

			// Adds a class for handheld device.
			if ( Mitech::is_handheld() ) {
				$classes[] = 'handheld mobile-menu';
			}

			// Adds a class for desktop device.
			if ( Mitech::is_desktop() ) {
				$classes[] = 'desktop desktop-menu';
			}

			$mobile_menu_effect = Mitech::setting( 'mobile_menu_effect' );
			$classes[]          = "mobile-menu-{$mobile_menu_effect}";

			if ( Mitech_Woo::instance()->is_activated() ) {
				$classes[] = 'woocommerce';

				if ( Mitech_Woo::instance()->is_product_archive() ) {
					$archive_shop_layout = Mitech::setting( 'shop_archive_layout' );

					$classes[] = "archive-shop-{$archive_shop_layout}";
				}
			}

			if ( Mitech_Case_Study::instance()->is_archive() ) {
				$classes[] = 'archive-case_study';
			}

			$css_animation = Mitech::setting( 'shortcode_animation_enable' );

			if ( ( $css_animation === 'both' ) || ( $css_animation === 'desktop' && Mitech::is_desktop() ) || ( $css_animation === 'mobile' && Mitech::is_handheld() ) ) {
				$classes[] = 'page-has-animation';
			}

			$one_page_enable = Mitech_Helper::get_post_meta( 'menu_one_page', '' );
			if ( $one_page_enable === '1' ) {
				$classes[] = 'one-page';
			}

			if ( is_singular( 'case_study' ) ) {
				$style = Mitech_Helper::get_post_meta( 'case_study_layout_style', '' );
				if ( $style === '' ) {
					$style = Mitech::setting( 'single_case_study_style' );
				}
				$classes[] = "single-case_study-style-$style";
			}

			$header_sticky_behaviour = Mitech::setting( 'header_sticky_behaviour' );
			$classes[]               = "header-sticky-$header_sticky_behaviour";

			$site_layout = Mitech_Helper::get_post_meta( 'site_layout', '' );
			if ( $site_layout === '' ) {
				$site_layout = Mitech::setting( 'site_layout' );
			}
			$classes[] = $site_layout;

			$site_class = Mitech_Helper::get_post_meta( 'site_class', '' );
			if ( $site_class !== '' ) {
				$classes[] = $site_class;
			}

			$sidebar_status = Mitech_Global::instance()->get_sidebar_status();

			if ( $sidebar_status === 'one' ) {
				$classes[] = 'page-has-sidebar page-one-sidebar';
			} elseif ( $sidebar_status === 'both' ) {
				$classes[] = 'page-has-sidebar page-both-sidebar';
			} else {
				$classes[] = 'page-has-no-sidebar';
			}

			return $classes;
		}
	}

	new Mitech_Actions_Filters();
}
