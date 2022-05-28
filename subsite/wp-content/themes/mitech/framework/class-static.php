<?php
defined( 'ABSPATH' ) || exit;

class Mitech {

	const PRIMARY_FONT    = 'CerebriSans';
	const SECONDARY_FONT  = '';
	const PRIMARY_COLOR   = '#086ad8';
	const SECONDARY_COLOR = '#d2a98e';
	const THIRD_COLOR     = '#002FA6';
	const HEADING_COLOR   = '#333333';
	const TEXT_COLOR      = '#696969';

	public static function is_tablet() {
		if ( ! class_exists( 'Mobile_Detect' ) ) {
			return false;
		}

		return Mobile_Detect::instance()->isTablet();
	}

	public static function is_mobile() {
		if ( ! class_exists( 'Mobile_Detect' ) ) {
			return false;
		}

		if ( self::is_tablet() ) {
			return false;
		}

		return Mobile_Detect::instance()->isMobile();
	}

	public static function is_handheld() {
		return ( self::is_mobile() || self::is_tablet() );
	}

	public static function is_desktop() {
		return ! self::is_handheld();
	}

	/**
	 * Get settings for Kirki
	 *
	 * @param string $option_name
	 * @param string $default
	 *
	 * @return mixed
	 */
	public static function setting( $option_name = '', $default = '' ) {
		$value = Mitech_Kirki::get_option( 'theme', $option_name );

		$value = $value === null ? $default : $value;

		return $value;
	}

	/**
	 * Primary Menu
	 */
	public static function menu_primary( $args = array() ) {
		$defaults = array(
			'theme_location' => 'primary',
			'container'      => 'ul',
			'menu_class'     => 'menu__container sm sm-simple',
		);
		$args     = wp_parse_args( $args, $defaults );

		if ( has_nav_menu( 'primary' ) && class_exists( 'Mitech_Walker_Nav_Menu' ) ) {
			$args['walker'] = new Mitech_Walker_Nav_Menu;
		}

		$menu = Mitech_Helper::get_post_meta( 'menu_display', '' );

		if ( $menu !== '' ) {
			$args['menu'] = $menu;
		}

		wp_nav_menu( $args );
	}

	/**
	 * Off Canvas Menu
	 */
	public static function off_canvas_menu_primary() {
		self::menu_primary( array(
			'menu_class' => 'menu__container',
			'menu_id'    => 'off-canvas-menu-primary',
		) );
	}

	/**
	 * Mobile Menu
	 */
	public static function menu_mobile_primary() {
		self::menu_primary( array(
			'menu_class' => 'menu__container',
			'menu_id'    => 'mobile-menu-primary',
		) );
	}

	/**
	 * Logo
	 */
	public static function branding_logo() {
		$custom_logo_url = Mitech_Helper::get_post_meta( 'custom_logo', '' );
		$logo_light      = Mitech::setting( 'logo_light' );
		$logo_dark       = Mitech::setting( 'logo_dark' );
		$logo_width      = Mitech::setting( 'logo_width' );
		$sticky_logo     = Mitech::setting( 'header_sticky_logo' );
		$header_type     = Mitech_Global::instance()->get_header_type();
		$header_logo     = Mitech::setting( "header_style_{$header_type}_logo" );
		$has_both_logo   = false;
		$alt             = get_bloginfo( 'name', 'display' );

		if ( isset( $logo_dark['id'] ) ) {
			$dark_logo = Mitech_Image::get_attachment_by_id( array(
				'id'        => $logo_dark['id'],
				'size'      => "{$logo_width}x9999",
				'crop'      => false,
				'class'     => 'dark-logo',
				'alt'       => $alt,
				'lazy_load' => false,
			) );
		} else {
			$logo_dark_url = $logo_dark['url'];
			$dark_logo     = '<img src="' . esc_url( $logo_dark_url ) . '" alt="' . esc_attr( $alt ) . '" class="dark-logo">';
		}

		if ( isset( $logo_light['id'] ) ) {
			$light_logo = Mitech_Image::get_attachment_by_id( array(
				'id'        => $logo_light['id'],
				'size'      => "{$logo_width}x9999",
				'crop'      => false,
				'class'     => 'light-logo',
				'alt'       => $alt,
				'lazy_load' => false,
			) );
		} else {
			$logo_light_url = $logo_light['url'];
			$light_logo     = '<img src="' . esc_url( $logo_light_url ) . '" alt="' . esc_attr( $alt ) . '" class="light-logo">';
		}

		if ( is_page_template( 'templates/one-page-scroll.php' ) ) {
			$has_both_logo = true;
		}
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if ( $custom_logo_url !== '' ) { ?>
				<img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>"
				     class="custom-logo">
				<?php if ( $sticky_logo === 'light' ): ?>
					<?php Mitech_Helper::e( $light_logo ); ?>
				<?php else: ?>
					<?php Mitech_Helper::e( $dark_logo ); ?>
				<?php endif; ?>
			<?php } else { ?>
				<?php if ( $has_both_logo === false && $header_logo === $sticky_logo ) : ?>
					<?php if ( $header_logo === 'dark' ): ?>
						<?php Mitech_Helper::e( $dark_logo ); ?>
					<?php else: ?>
						<?php Mitech_Helper::e( $light_logo ); ?>
					<?php endif; ?>
				<?php else: ?>
					<?php Mitech_Helper::e( $light_logo ); ?>
					<?php Mitech_Helper::e( $dark_logo ); ?>
				<?php endif; ?>
			<?php } ?>
		</a>
		<?php
	}

	/**
	 * Adds custom attributes to the body tag.
	 */
	public static function body_attributes() {
		$attrs = apply_filters( 'mitech_body_attributes', array() );

		$attrs_string = '';
		if ( ! empty( $attrs ) ) {
			foreach ( $attrs as $attr => $value ) {
				$attrs_string .= " {$attr}=" . '"' . esc_attr( $value ) . '"';
			}
		}

		echo '' . $attrs_string;
	}

	/**
	 * Adds custom classes to the header.
	 *
	 * @param string $class extra class
	 */
	public static function top_bar_class( $class = '' ) {
		$classes = array( 'page-top-bar' );

		$type = Mitech_Global::instance()->get_top_bar_type();

		$classes[] = "top-bar-{$type}";

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'mitech_top_bar_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the header.
	 */
	public static function header_class( $class = '' ) {
		$classes = array( 'page-header' );

		$header_type = Mitech_Global::instance()->get_header_type();

		$classes[] = "header-{$header_type}";

		$_overlay_enable = Mitech::setting( "header_style_{$header_type}_overlay" );

		if ( $_overlay_enable === '1' ) {
			$classes[] = 'header-layout-fixed';
		}

		$_logo     = Mitech::setting( "header_style_{$header_type}_logo" );
		$classes[] = "{$_logo}-logo-version";

		$_sticky_logo = Mitech::setting( "header_sticky_logo" );
		$classes[]    = " header-sticky-$_sticky_logo-logo";

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'mitech_header_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the header.
	 */
	public static function title_bar_class( $class = '' ) {
		$classes = array( 'page-title-bar' );

		$type = Mitech_Global::instance()->get_title_bar_type();

		$classes[] = "page-title-bar-{$type}";

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'mitech_title_bar_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the branding.
	 */
	public static function branding_class( $class = '' ) {
		$classes = array( 'branding' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'mitech_branding_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the navigation.
	 */
	public static function navigation_class( $class = '' ) {
		$classes = array( 'navigation page-navigation' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'mitech_navigation_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the footer.
	 */
	public static function footer_class( $class = '' ) {
		$classes = array( 'page-footer' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'mitech_footer_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}
}
