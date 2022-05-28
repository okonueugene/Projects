<?php
defined( 'ABSPATH' ) || exit;

/**
 * Custom template tags for this theme.
 */
class Mitech_Templates {

	public static function pre_loader() {
		if ( Mitech::setting( 'pre_loader_enable' ) !== '1' ) {
			return;
		}

		$style = Mitech::setting( 'pre_loader_style' );

		if ( $style === 'random' ) {
			$style = array_rand( Mitech_Helper::$preloader_style );
		}
		?>

		<div id="page-preloader" class="page-loading clearfix">
			<div class="loader-section section-left"></div>
			<div class="loader-section section-right"></div>
			<div class="page-load-inner">
				<div class="preloader-wrap">
					<div class="wrap-2">
						<div class="inner">
							<?php get_template_part( 'components/preloader/style', $style ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	public static function top_bar() {
		$type = Mitech_Global::instance()->get_top_bar_type();

		if ( $type !== 'none' ) {
			get_template_part( 'components/top-bars/top-bar', $type );
		}
	}

	public static function top_bar_button( $type = '01' ) {
		$button_text        = Mitech::setting( "top_bar_style_{$type}_button_text" );
		$button_link        = Mitech::setting( "top_bar_style_{$type}_button_link" );
		$button_link_target = Mitech::setting( "top_bar_style_{$type}_button_link_target" );
		$button_classes     = 'top-bar-button';
		?>
		<?php if ( $button_link !== '' && $button_text !== '' ) : ?>
			<a class="<?php echo esc_attr( $button_classes ); ?>"
			   href="<?php echo esc_url( $button_link ); ?>"
				<?php if ( $button_link_target === '1' ) : ?>
					target="_blank"
				<?php endif; ?>
			>
				<?php echo esc_html( $button_text ); ?>
			</a>
		<?php endif;
	}

	public static function top_bar_info() {
		$type = Mitech_Global::instance()->get_top_bar_type();
		$info = Mitech::setting( "top_bar_style_{$type}_info" );

		if ( ! empty( $info ) ) {
			?>
			<ul class="top-bar-info">
				<?php
				foreach ( $info as $item ) {
					$url  = isset( $item['url'] ) ? $item['url'] : '';
					$icon = isset( $item['icon_class'] ) ? $item['icon_class'] : '';
					$text = isset( $item['text'] ) ? $item['text'] : '';
					?>
					<li class="info-item">
						<?php if ( $url !== '' ) : ?>
						<a href="<?php echo esc_url( $url ); ?>" class="info-link">
							<?php endif; ?>

							<?php if ( $icon !== '' ) : ?>
								<i class="info-icon <?php echo esc_attr( $icon ); ?>"></i>
							<?php endif; ?>

							<?php echo '<span class="info-text">' . $text . '</span>'; ?>

							<?php if ( $url !== '' ) : ?>
						</a>
					<?php endif; ?>
					</li>
				<?php } ?>
			</ul>
			<?php
		}
	}

	public static function top_bar_language_switcher() {
		$type   = Mitech_Global::instance()->get_top_bar_type();
		$enable = Mitech::setting( "top_bar_style_{$type}_language_switcher_enable" );

		do_action( 'mitech_before_add_language_selector_header', $type, $enable );

		if ( $enable !== '1' || ! defined( 'ICL_SITEPRESS_VERSION' ) ) {
			return;
		}
		?>
		<div id="switcher-language-wrapper" class="switcher-language-wrapper">
			<?php do_action( 'wpml_add_language_selector' ); ?>
		</div>
		<?php
	}

	public static function top_bar_social_networks() {
		$type   = Mitech_Global::instance()->get_top_bar_type();
		$enable = Mitech::setting( "top_bar_style_{$type}_social_networks_enable" );

		if ( $enable !== '1' ) {
			return;
		}
		?>
		<div class="top-bar-social-network">
			<?php Mitech_Templates::social_icons( array(
				'display'        => 'icon',
				'tooltip_enable' => false,
			) ); ?>
		</div>
		<?php
	}

	public static function social_icons( $args = array() ) {
		$defaults    = array(
			'link_classes'     => '',
			'display'          => 'icon',
			'tooltip_enable'   => true,
			'tooltip_position' => 'top',
			'tooltip_skin'     => '',
		);
		$args        = wp_parse_args( $args, $defaults );
		$social_link = Mitech::setting( 'social_link' );

		if ( ! empty( $social_link ) ) {
			$social_link_target = Mitech::setting( 'social_link_target' );

			$args['link_classes'] .= ' social-link';
			if ( $args['tooltip_enable'] ) {
				$args['link_classes'] .= ' hint--bounce';
				$args['link_classes'] .= " hint--{$args['tooltip_position']}";

				if ( $args['tooltip_skin'] !== '' ) {
					$args['link_classes'] .= " hint--{$args['tooltip_skin']}";
				}
			}

			foreach ( $social_link as $key => $row_values ) {
				?>
				<a class="<?php echo esc_attr( $args['link_classes'] ); ?>"
					<?php if ( $args['tooltip_enable'] ) : ?>
						aria-label="<?php echo esc_attr( $row_values['tooltip'] ); ?>"
					<?php endif; ?>
                   href="<?php echo esc_url( $row_values['link_url'] ); ?>"
                   data-hover="<?php echo esc_attr( $row_values['tooltip'] ); ?>"
					<?php if ( $social_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>
					<?php if ( in_array( $args['display'], array( 'icon', 'icon_text' ), true ) ) : ?>
						<i class="social-icon <?php echo esc_attr( $row_values['icon_class'] ); ?>"></i>
					<?php endif; ?>
					<?php if ( in_array( $args['display'], array( 'text', 'icon_text' ), true ) ) : ?>
						<span class="social-text"><?php echo esc_html( $row_values['tooltip'] ); ?></span>
					<?php endif; ?>
				</a>
				<?php
			}
		}
	}

	public static function top_bar_user_link() {
		$type   = Mitech_Global::instance()->get_top_bar_type();
		$enable = Mitech::setting( "top_bar_style_{$type}_user_link_enable" );

		if ( $enable !== '1' ) {
			return;
		}

		// Default WP login.
		$login_url = wp_login_url();

		// Use Woocommerce login page.
		if ( Mitech_Woo::instance()->is_activated() ) {
			$login_url = wc_get_page_permalink( 'myaccount' );
		}
		?>
		<?php if ( ! is_user_logged_in() ) { ?>
			<div class="top-bar-user logged-out">
				<a href="<?php echo esc_url( $login_url ); ?>"
				   title="<?php esc_attr_e( 'Login / Register', 'mitech' ); ?>">
					<?php esc_html_e( 'Login / Register', 'mitech' ); ?>
				</a>
			</div>
		<?php } else {
			$current_user = wp_get_current_user();
			$user_name    = $current_user->display_name;
			$user_link    = get_edit_user_link( $current_user->ID );
			$avatar_url   = get_avatar_url( $current_user->ID ); ?>
			<?php if ( Mitech_Woo::instance()->is_activated() ) : ?>
				<div class="top-bar-user logged-in">
					<div class="user-show">
						<a class="avatar" href="<?php echo esc_url( $user_link ); ?>">
							<img src="<?php echo esc_url( $avatar_url ); ?>"
							     title="<?php echo esc_attr( $user_name ); ?>"
							     alt="<?php echo esc_attr( $user_name ); ?>">
						</a>
					</div>
					​
					<div class="logout">
						<a href="<?php echo wp_logout_url( home_url() ); ?>">
							<span><?php esc_html_e( 'Log out', 'mitech' ); ?></span>
						</a>
					</div>
				</div>
			<?php endif; ?>
		<?php } ?>

		<?php
	}

	public static function header() {
		$type = Mitech_Global::instance()->get_header_type();

		if ( $type === 'none' ) {
			return;
		}

		get_template_part( 'components/headers/header', $type );
	}

	public static function header_info_slider( $args = array() ) {
		$header_type = Mitech_Global::instance()->get_header_type();

		$info = Mitech::setting( "header_style_{$header_type}_info" );
		if ( empty( $info ) ) {
			return;
		}

		$defaults = array(
			'lg_items' => 3,
			'gutter'   => 30,
		);
		$args     = wp_parse_args( $args, $defaults );
		?>
		<div class="header-info">
			<div class="mitech-swiper tm-swiper equal-height"
			     data-lg-items="<?php echo esc_attr( $args['lg_items'] ); ?>"
			     data-md-items="2"
			     data-sm-items="1"
			     data-lg-gutter="<?php echo esc_attr( $args['gutter'] ); ?>"
			     data-loop="1"
			     data-autoplay="4000"
			>
				<div class="swiper-inner">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php foreach ( $info as $item ) { ?>
								<div class="swiper-slide">
									<div class="info-item">
										<?php if ( isset( $item['icon_class'] ) && $item['icon_class'] !== '' ) : ?>
											<div class="info-icon">
												<span class="<?php echo esc_attr( $item['icon_class'] ); ?>"></span>
											</div>
										<?php endif; ?>

										<div class="info-content">
											<?php if ( isset( $item['title'] ) && $item['title'] !== '' ) : ?>
												<?php echo '<h6 class="info-title">' . $item['title'] . '</h6>'; ?>
											<?php endif; ?>

											<?php if ( isset( $item['sub_title'] ) && $item['sub_title'] !== '' ) : ?>
												<?php echo '<div class="info-sub-title">' . $item['sub_title'] . '</div>'; ?>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public static function header_search_button() {
		$enable = Mitech_Global::instance()->get_popup_search();
		if ( $enable !== true ) {
			return;
		}
		?>
		<div class="popup-search-wrap">
			<a href="javascript:void(0)" id="btn-open-popup-search" class="btn-open-popup-search"><i
					class="far fa-search"></i></a>
		</div>
		<?php
	}

	public static function header_search_form() {
		$header_type = Mitech_Global::instance()->get_header_type();

		$enabled = Mitech::setting( "header_style_{$header_type}_search_form_enable" );

		if ( '1' === $enabled ) {
			?>
			<div class="header-search-form">
				<?php get_search_form(); ?>
			</div>
			<?php
		}
	}

	public static function header_button( $args = array() ) {
		$header_type = Mitech_Global::instance()->get_header_type();

		$button_style        = Mitech::setting( "header_style_{$header_type}_button_style" );
		$button_text         = Mitech::setting( "header_style_{$header_type}_button_text" );
		$button_link         = Mitech::setting( "header_style_{$header_type}_button_link" );
		$button_link_target  = Mitech::setting( "header_style_{$header_type}_button_link_target" );
		$button_classes      = 'tm-button';
		$sticky_button_style = Mitech::setting( "header_sticky_button_style" );

		$icon_class = Mitech::setting( "header_style_{$header_type}_button_icon" );
		$icon_align = 'right';

		if ( $icon_class !== '' ) {
			$button_classes .= ' has-icon icon-right';
		}

		$defaults = array(
			'extra_class' => '',
			'style'       => '',
			'size'        => 'nm',
		);

		$args = wp_parse_args( $args, $defaults );

		if ( $args['extra_class'] !== '' ) {
			$button_classes .= " {$args['extra_class']}";
		}

		$header_button_classes = $button_classes . " tm-button-{$args['size']} header-button";
		$sticky_button_classes = $button_classes . ' tm-button-sm header-sticky-button';

		$header_button_classes .= " style-{$button_style}";
		$sticky_button_classes .= " style-{$sticky_button_style}";
		?>
		<?php if ( $button_link !== '' && $button_text !== '' ) : ?>
			<div class="header-buttons">
				<a class="<?php echo esc_attr( $header_button_classes ); ?>"
				   href="<?php echo esc_url( $button_link ); ?>"
					<?php if ( $button_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>
					<?php if ( $args['style'] === 'text-arrow' ) : ?>
						<div class="the-arrow -left">
							<span class="shaft"></span>
						</div>
					<?php endif; ?>

					<span class="button-text" data-text="<?php echo esc_attr( $button_text ); ?>">
						<?php echo esc_html( $button_text ); ?>
					</span>

					<?php if ( $icon_class !== '' && $icon_align === 'right' ) { ?>
						<span class="button-icon">
							<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
						</span>
					<?php } ?>

					<?php if ( $args['style'] === 'text-arrow' ) : ?>
						<div class="the-arrow -right">
							<span class="shaft"></span>
						</div>
					<?php endif; ?>
				</a>
				<a class="<?php echo esc_attr( $sticky_button_classes ); ?>"
				   href="<?php echo esc_url( $button_link ); ?>"
					<?php if ( $button_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>

					<?php if ( $args['style'] === 'text-arrow' ) : ?>
						<div class="the-arrow -left">
							<span class="shaft"></span>
						</div>
					<?php endif; ?>

					<span class="button-text" data-text="<?php echo esc_attr( $button_text ); ?>">
						<?php echo esc_html( $button_text ); ?>
					</span>

					<?php if ( $icon_class !== '' && $icon_align === 'right' ) { ?>
						<span class="button-icon">
							<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
						</span>
					<?php } ?>

					<?php if ( $args['style'] === 'text-arrow' ) : ?>
						<div class="the-arrow -right">
							<span class="shaft"></span>
						</div>
					<?php endif; ?>
				</a>
			</div>
		<?php endif;
	}

	public static function header_open_mobile_menu_button() {
		?>
		<div id="page-open-mobile-menu" class="page-open-mobile-menu">
			<div class="inner">
				<div class="icon"><i></i></div>
			</div>
		</div>
		<?php
	}

	public static function header_open_off_sidebar() {
		$enable = Mitech_Global::instance()->get_off_sidebar();

		if ( ! $enable ) {
			return;
		}
		?>
		<div id="page-open-off-sidebar" class="page-open-off-sidebar">
			<div class="inner">
				<div class="icon"><i></i></div>
			</div>
		</div>
		<?php
	}

	public static function header_more_tools_button() {
		?>
		<div id="header-right-more" class="header-right-more">
			<div class="inner">
				<div class="icon"><i class="far fa-ellipsis-h-alt"></i></div>
			</div>
		</div>
		<?php
	}

	public static function header_open_canvas_menu_button( $args = array() ) {
		$defaults = array(
			'menu_title' => false,
			'class'      => '',
		);
		$args     = wp_parse_args( $args, $defaults );

		$classes = 'page-open-main-menu';

		if ( $args['class'] !== '' ) {
			$classes .= " {$args['class']}";
		}

		?>
		<div id="page-open-main-menu" class="<?php echo esc_attr( $classes ); ?>">
			<?php if ( $args['menu_title'] ) : ?>
				<h6 class="page-open-main-menu-title"><?php esc_html_e( 'Menu', 'mitech' ); ?></h6>
			<?php endif; ?>
			<div><i></i></div>
		</div>
		<?php
	}

	public static function header_social_networks( $args = array() ) {
		$defaults = array(
			'style' => 'rounded',
		);

		$args = wp_parse_args( $args, $defaults );

		$header_type = Mitech_Global::instance()->get_header_type();

		$social_enable = Mitech::setting( "header_style_{$header_type}_social_networks_enable" );
		$el_classes    = "header-social-networks style-{$args['style']}";
		?>
		<?php if ( $social_enable === '1' ) : ?>
			<div class="<?php echo esc_attr( $el_classes ); ?>">
				<div class="inner">
					<?php

					$defaults = array(
						'tooltip_position' => 'bottom-left',
					);

					$args = wp_parse_args( $args, $defaults );

					self::social_icons( $args );
					?>
				</div>
			</div>
		<?php endif; ?>
		<?php
	}

	public static function header_text() {
		$type = Mitech_Global::instance()->get_header_type();

		$text = Mitech::setting( "header_style_{$type}_text" );
		?>
		<?php if ( $text !== '' ) : ?>
			<div class="header-text">
				<?php echo wp_kses( $text, 'mitech-default' ); ?>
			</div>
		<?php endif; ?>
		<?php
	}

	public static function header_language_switcher() {
		$header_type = Mitech_Global::instance()->get_header_type();
		$enabled     = Mitech::setting( "header_style_{$header_type}_language_switcher_enable" );

		do_action( 'mitech_before_add_language_selector_header', $header_type, $enabled );

		if ( $enabled !== '1' || ! defined( 'ICL_SITEPRESS_VERSION' ) ) {
			return;
		}
		?>
		<div id="switcher-language-wrapper" class="switcher-language-wrapper">
			<?php do_action( 'wpml_add_language_selector' ); ?>
		</div>
		<?php
	}

	public static function header_wishlist_button( $args = array() ) {
		$default = [
			'style' => 'normal',
		];

		$args = wp_parse_args( $args, $default );

		$link_classes = 'header-icon header-wishlist-link';

		$link_classes .= ' style-' . $args['style'];

		$header_type     = Mitech_Global::instance()->get_header_type();
		$wishlist_enable = Mitech::setting( "header_style_{$header_type}_wishlist_enable" );
		if ( '1' === $wishlist_enable && class_exists( 'WPCleverWoosw' ) ) {
			$wishlist_url = WPCleverWoosw::get_url();
			?>
			<div class="header-wishlist">
				<a href="<?php echo esc_url( $wishlist_url ) ?>"
				   class="<?php echo esc_attr( $link_classes ); ?>">
					<i class="far fa-heart"></i>
				</a>
			</div>
			<?php
		}
	}

	public static function slider( $template_position ) {
		$slider          = Mitech_Global::instance()->get_slider_alias();
		$slider_position = Mitech_Global::instance()->get_slider_position();

		if ( ! function_exists( 'rev_slider_shortcode' ) || $slider === '' || $slider_position !== $template_position ) {
			return;
		}

		?>
		<div id="page-slider" class="page-slider">
			<?php echo do_shortcode( '[rev_slider ' . $slider . ']' ); ?>
		</div>
		<?php
	}

	public static function title_bar() {
		$type = Mitech_Global::instance()->get_title_bar_type();

		if ( $type === 'none' ) {
			return;
		}

		get_template_part( 'components/title-bars/title-bar', $type );
	}

	public static function get_title_bar_title() {
		$title = Mitech_Helper::get_post_meta( 'page_title_bar_custom_heading', '' );

		if ( $title === '' ) {
			if ( Mitech_Case_Study::instance()->is_archive() ) {
				$title = Mitech::setting( 'title_bar_archive_case_study_title' );
			} elseif ( is_post_type_archive() ) {
				if ( function_exists( 'is_shop' ) && is_shop() ) {
					$title = esc_html__( 'Shop', 'mitech' );
				} else {
					$title = sprintf( esc_html__( 'Archives: %s', 'mitech' ), post_type_archive_title( '', false ) );
				}
			} elseif ( is_home() ) {
				$title = Mitech::setting( 'title_bar_home_title' ) . single_tag_title( '', false );
			} elseif ( is_tag() ) {
				$title = Mitech::setting( 'title_bar_archive_tag_title' ) . single_tag_title( '', false );
			} elseif ( is_author() ) {
				$title = Mitech::setting( 'title_bar_archive_author_title' ) . '<span class="vcard">' . get_the_author() . '</span>';
			} elseif ( is_year() ) {
				$title = Mitech::setting( 'title_bar_archive_year_title' ) . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'mitech' ) );
			} elseif ( is_month() ) {
				$title = Mitech::setting( 'title_bar_archive_month_title' ) . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'mitech' ) );
			} elseif ( is_day() ) {
				$title = Mitech::setting( 'title_bar_archive_day_title' ) . get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'mitech' ) );
			} elseif ( is_search() ) {
				$title = Mitech::setting( 'title_bar_search_title' ) . '"' . get_search_query() . '"';
			} elseif ( is_category() || is_tax() ) {
				$title = Mitech::setting( 'title_bar_archive_category_title' ) . single_cat_title( '', false );
			} elseif ( is_singular( 'post' ) ) {
				$title = Mitech::setting( 'title_bar_single_blog_title' );
				if ( $title === '' ) {
					$title = get_the_title();
				}
			} elseif ( is_singular( 'case_study' ) ) {
				$title = Mitech::setting( 'title_bar_single_case_study_title' );
				if ( $title === '' ) {
					$title = get_the_title();
				}
			} elseif ( is_singular( 'product' ) ) {
				$title = Mitech::setting( 'title_bar_single_product_title' );
				if ( $title === '' ) {
					$title = get_the_title();
				}
			} else {
				$title = get_the_title();
			}
		}

		?>
		<div class="page-title-bar-heading">
			<h1 class="heading">
				<?php echo wp_kses( $title, array(
					'span' => array(
						'class' => array(),
					),
				) ); ?>
			</h1>
		</div>
		<?php
	}

	public static function page_links() {
		wp_link_pages( array(
			'before'           => '<div class="page-links">',
			'after'            => '</div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'nextpagelink'     => esc_html__( 'Next', 'mitech' ),
			'previouspagelink' => esc_html__( 'Prev', 'mitech' ),
		) );
	}

	public static function post_nav_next_link() {
		next_post_link(
			'%link',
			'<div class="nav-desc">' . esc_html__( 'Next', 'mitech' ) . '</div>
			<div class="nav-post-title">%title</div>
			<span class="nav-icon fa fa-arrow-right"></span>'
		);
	}

	public static function comment_navigation( $args = array() ) {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			$defaults = array(
				'container_id'    => '',
				'container_class' => 'navigation comment-navigation',
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<nav id="<?php echo esc_attr( $args['container_id'] ); ?>"
			     class="<?php echo esc_attr( $args['container_class'] ); ?>">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'mitech' ); ?></h2>

				<div class="comment-nav-links">
					<?php paginate_comments_links( array(
						'prev_text' => esc_html__( 'Prev', 'mitech' ),
						'next_text' => esc_html__( 'Next', 'mitech' ),
						'type'      => 'list',
					) ); ?>
				</div>
			</nav>
			<?php
		}
		?>
		<?php
	}

	public static function comment_template( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
			<div class="comment-content">
				<div class="meta">
					<?php
					printf( '<h6 class="fn">%s</h6>', get_comment_author_link() );
					?>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-messages"><?php esc_html_e( 'Your comment is awaiting moderation.', 'mitech' ) ?></em>
					<br/>
				<?php endif; ?>
				<div class="comment-text"><?php comment_text(); ?></div>

				<div class="comment-actions">
					<div class="comment-datetime">
						<?php echo get_comment_date() . ' ' . esc_html__( 'at', 'mitech' ) . ' ' . get_comment_time(); ?>
					</div>

					<?php comment_reply_link( array_merge( $args, array(
						'depth'      => $depth,
						'max_depth'  => $args['max_depth'],
						'reply_text' => esc_html__( 'Reply', 'mitech' ),
						'before'     => '|',
					) ) ); ?>
					<?php edit_comment_link( esc_html__( 'Edit', 'mitech' ), '|' ); ?>
				</div>
			</div>
		</div>
		<?php
	}

	public static function comment_form() {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = '';
		if ( $req ) {
			$aria_req = " aria-required='true'";
		}

		$fields = array(
			'author' => '<div class="row"><div class="col-sm-6 comment-form-author"><input id="author" placeholder="' . esc_attr__( 'Your Name *', 'mitech' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . '/></div>',
			'email'  => '<div class="col-sm-6 comment-form-email"><input id="email" placeholder="' . esc_attr__( 'Your Email *', 'mitech' ) . '" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . '/></div></div>',
		);

		$comment_field = '<div class="row"><div class="col-md-12 comment-form-comment"><textarea id="comment" placeholder="' . esc_attr__( 'Your Comment', 'mitech' ) . '" name="comment" aria-required="true"></textarea></div></div>';

		$comments_args = array(
			'label_submit'        => esc_html__( 'Submit', 'mitech' ),
			'title_reply'         => esc_html__( 'Leave your thought here', 'mitech' ),
			'comment_notes_after' => '',
			'fields'              => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'       => $comment_field,
		);
		comment_form( $comments_args );
	}

	public static function post_author() {
		?>
		<div class="entry-author">
			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'email' ), '100' ); ?>

					<?php
					$email_address = get_the_author_meta( 'email_address' );
					$facebook      = get_the_author_meta( 'facebook' );
					$twitter       = get_the_author_meta( 'twitter' );
					$instagram     = get_the_author_meta( 'instagram' );
					$linkedin      = get_the_author_meta( 'linkedin' );
					$pinterest     = get_the_author_meta( 'pinterest' );

					$link_classes = 'hint--bounce hint--top hint--primary';
					?>
					<?php if ( $facebook || $twitter || $instagram || $linkedin || $email_address ) : ?>
						<div class="author-social-networks">
							<div class="inner">
								<?php if ( $twitter ) : ?>
									<a class="<?php echo esc_attr( $link_classes ); ?>"
									   aria-label="<?php esc_attr_e( 'Twitter', 'mitech' ); ?>"
									   href="<?php echo esc_url( $twitter ); ?>" target="_blank">
										<i class="fab fa-twitter"></i>
									</a>
								<?php endif; ?>

								<?php if ( $facebook ) : ?>
									<a class="<?php echo esc_attr( $link_classes ); ?>"
									   aria-label="<?php esc_attr_e( 'Facebook', 'mitech' ); ?>"
									   href="<?php echo esc_url( $facebook ); ?>" target="_blank">
										<i class="fab fa-facebook-f"></i>
									</a>
								<?php endif; ?>

								<?php if ( $instagram ) : ?>
									<a class="<?php echo esc_attr( $link_classes ); ?>"
									   aria-label="<?php esc_attr_e( 'Instagram', 'mitech' ); ?>"
									   href="<?php echo esc_url( $instagram ); ?>" target="_blank">
										<i class="fab fa-instagram"></i>
									</a>
								<?php endif; ?>

								<?php if ( $linkedin ) : ?>
									<a class="<?php echo esc_attr( $link_classes ); ?>"
									   aria-label="<?php esc_attr_e( 'Linkedin', 'mitech' ) ?>"
									   href="<?php echo esc_url( $linkedin ); ?>" target="_blank">
										<i class="fab fa-linkedin"></i>
									</a>
								<?php endif; ?>

								<?php if ( $pinterest ) : ?>
									<a class="<?php echo esc_attr( $link_classes ); ?>"
									   aria-label="<?php esc_attr_e( 'Pinterest', 'mitech' ); ?>"
									   href="<?php echo esc_url( $pinterest ); ?>" target="_blank">
										<i class="fab fa-pinterest"></i>
									</a>
								<?php endif; ?>

								<?php if ( $email_address ) : ?>
									<a class="<?php echo esc_attr( $link_classes ); ?>"
									   aria-label="<?php esc_attr_e( 'Email', 'mitech' ); ?>"
									   href="mailto:<?php echo esc_url( $email_address ); ?>" target="_blank">
										<i class="fa fa-envelope"></i>
									</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="author-description">
					<h5 class="author-name"><?php the_author(); ?></h5>

					<div class="author-biographical-info">
						<?php the_author_meta( 'description' ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public static function post_sharing( $args = array() ) {
		if ( ! class_exists( 'InsightCore' ) ) {
			return;
		}

		$social_sharing = Mitech::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			?>
			<div id="entry-post-share" class="entry-post-share post-share">
				<div class="share-label">
					<?php esc_html_e( 'Share this post', 'mitech' ); ?>
				</div>
				<div class="share-media">
					<span class="share-icon far fa-share-alt"></span>

					<div class="share-list">
						<?php self::get_sharing_list( $args ); ?>
					</div>
				</div>
			</div>
			<?php
		}
	}

	public static function get_sharing_list( $args = array() ) {
		$defaults       = array(
			'target'           => '_blank',
			'tooltip_enable'   => true,
			'tooltip_skin'     => 'primary',
			'tooltip_position' => 'top',
		);
		$args           = wp_parse_args( $args, $defaults );
		$social_sharing = Mitech::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			$social_sharing_order = Mitech::setting( 'social_sharing_order' );

			$link_classes = '';

			if ( $args['tooltip_enable'] === true ) {
				$link_classes .= "hint--bounce hint--{$args['tooltip_position']} hint--{$args['tooltip_skin']}";
			}

			foreach ( $social_sharing_order as $social ) {
				if ( in_array( $social, $social_sharing, true ) ) {
					if ( $social === 'facebook' ) {
						if ( ! wp_is_mobile() ) {
							$facebook_url = 'https://www.facebook.com/sharer.php?m2w&s=100&p&#91;url&#93;=' . rawurlencode( get_permalink() ) . '&p&#91;images&#93;&#91;0&#93;=' . wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) . '&p&#91;title&#93;=' . rawurlencode( get_the_title() );
						} else {
							$facebook_url = 'https://m.facebook.com/sharer.php?u=' . rawurlencode( get_permalink() );
						}
						?>
						<a class="<?php echo esc_attr( $link_classes . ' facebook' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Facebook', 'mitech' ); ?>"
						   href="<?php echo esc_url( $facebook_url ); ?>">
							<i class="fab fa-facebook-f"></i>
						</a>
						<?php
					} elseif ( $social === 'twitter' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' twitter' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Twitter', 'mitech' ); ?>"
						   href="https://twitter.com/share?text=<?php echo rawurlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ); ?>&url=<?php echo rawurlencode( get_permalink() ); ?>">
							<i class="fab fa-twitter"></i>
						</a>
						<?php
					} elseif ( $social === 'tumblr' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' tumblr' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Tumblr', 'mitech' ); ?>"
						   href="https://www.tumblr.com/share/link?url=<?php echo rawurlencode( get_permalink() ); ?>&amp;name=<?php echo rawurlencode( get_the_title() ); ?>">
							<i class="fab fa-tumblr-square"></i>
						</a>
						<?php

					} elseif ( $social === 'linkedin' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' linkedin' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Linkedin', 'mitech' ); ?>"
						   href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&amp;title=<?php echo rawurlencode( get_the_title() ); ?>">
							<i class="fab fa-linkedin"></i>
						</a>
						<?php
					} elseif ( $social === 'email' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' email' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Email', 'mitech' ); ?>"
						   href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&amp;body=<?php echo rawurlencode( get_permalink() ); ?>">
							<i class="fa fa-envelope"></i>
						</a>
						<?php
					}
				}
			}
		}
	}

	public static function product_sharing( $args = array() ) {
		if ( ! class_exists( 'InsightCore' ) ) {
			return;
		}

		$social_sharing = Mitech::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			?>
			<div class="entry-product-share meta-item">
				<h6><?php esc_html_e( 'Share:', 'mitech' ); ?></h6>
				<div class="meta-content"><?php self::get_sharing_list( $args ); ?></div>
			</div>
			<?php
		}
	}

	public static function excerpt( $args = array() ) {
		$defaults = array(
			'limit' => 55,
			'after' => '&hellip;',
			'type'  => 'word',
		);
		$args     = wp_parse_args( $args, $defaults );

		$excerpt = '';

		if ( $args['type'] === 'word' ) {
			$excerpt = self::string_limit_words( get_the_excerpt(), $args['limit'] );
		} elseif ( $args['type'] === 'character' ) {
			$excerpt = self::string_limit_characters( get_the_excerpt(), $args['limit'] );
		}
		if ( $excerpt !== '' && $excerpt !== '&nbsp;' ) {
			printf( '<p>%s %s</p>', $excerpt, $args['after'] );
		}
	}

	public static function string_limit_words( $string, $word_limit ) {
		$words = explode( ' ', $string, $word_limit + 1 );
		if ( count( $words ) > $word_limit ) {
			array_pop( $words );
		}

		return implode( ' ', $words );
	}

	public static function string_limit_characters( $string, $limit ) {
		$string = substr( $string, 0, $limit );
		$string = substr( $string, 0, strripos( $string, " " ) );

		return $string;
	}

	public static function render_sidebar( $template_position = 'left' ) {
		$sidebar1         = Mitech_Global::instance()->get_sidebar_1();
		$sidebar2         = Mitech_Global::instance()->get_sidebar_2();
		$sidebar_position = Mitech_Global::instance()->get_sidebar_position();

		if ( $sidebar1 !== 'none' ) {
			$classes = 'page-sidebar';
			$classes .= ' page-sidebar-' . $template_position;
			if ( $template_position === 'left' ) {
				if ( $sidebar_position === 'left' && $sidebar1 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar1, true );
				}
				if ( $sidebar_position === 'right' && $sidebar1 !== 'none' && $sidebar2 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar2 );
				}
			} elseif ( $template_position === 'right' ) {
				if ( $sidebar_position === 'right' && $sidebar1 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar1, true );
				}
				if ( $sidebar_position === 'left' && $sidebar1 !== 'none' && $sidebar2 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar2 );
				}
			}
		}
	}

	public static function get_sidebar( $classes, $name, $first_sidebar = false ) {
		$special_sidebar = Mitech_Global::instance()->get_sidebar_special();
		?>
		<div class="<?php echo esc_attr( $classes ); ?>">
			<div class="page-sidebar-inner" itemscope="itemscope">
				<div class="page-sidebar-content">
					<?php dynamic_sidebar( $name ); ?>
				</div>

				<?php if ( $first_sidebar === true && $special_sidebar !== 'none' && is_active_sidebar( $special_sidebar ) ) : ?>
					<div class="page-sidebar-special">
						<?php dynamic_sidebar( $special_sidebar ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * @param $name
	 * Name of dynamic sidebar
	 * Check sidebar is active then dynamic it.
	 */
	public static function generated_sidebar( $name ) {
		if ( is_active_sidebar( $name ) ) {
			dynamic_sidebar( $name );
		}
	}

	public static function image_placeholder( $width, $height ) {
		echo '<img src="https://via.placeholder.com/' . $width . 'x' . $height . '?text=' . esc_attr__( 'No+Image', 'mitech' ) . '" alt="' . esc_attr__( 'Thumbnail', 'mitech' ) . '"/>';
	}

	public static function grid_filters( $post_type = 'post', $filter_enable, $filter_align, $filter_counter, $filter_wrap = '0', $total = 0, $list = '' ) {
		if ( $filter_enable != 1 ) {
			return;
		}

		$filter_classes = array( 'tm-filter-button-group', $filter_align );
		if ( $filter_counter == 1 ) {
			$filter_classes[] = 'show-filter-counter';
		}
		?>

		<div class="<?php echo implode( ' ', $filter_classes ); ?>"
			<?php
			if ( $filter_counter == 1 ) {
				echo 'data-filter-counter="true"';
			}
			?>
		>
			<?php if ( $filter_wrap == '1' ) { ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php } ?>

						<div class="tm-filter-button-group-inner">
							<a href="javascript:void(0);" class="btn-filter current"
							   data-filter="*" data-filter-count="<?php echo esc_attr( $total ); ?>">
								<span class="filter-text"><?php esc_html_e( 'All', 'mitech' ); ?></span>
							</a>
							<?php


							if ( $list === '' ) {
								switch ( $post_type ) {
									case 'case_study' :
										$_categories = get_terms( array(
											'taxonomy'   => 'case_study_category',
											'hide_empty' => true,
										) );
										$_catPrefix  = 'case_study_category';
										break;
									case 'product' :
										$_categories = get_terms( array(
											'taxonomy'   => 'product_cat',
											'hide_empty' => true,
										) );

										$_catPrefix = 'product_cat';
										break;
									default :
										$_categories = get_terms( array(
											'taxonomy'   => 'category',
											'hide_empty' => true,
										) );

										$_catPrefix = 'category';
										break;
								}

								foreach ( $_categories as $term ) {
									printf( '<a href="javascript:void(0);" class="btn-filter" data-filter="%s" data-ajax-filter="%s" data-filter-count="%s"><span class="filter-text">%s</span></a>', esc_attr( ".{$_catPrefix}-{$term->slug}" ), esc_attr( "{$_catPrefix}:{$term->slug}" ), $term->count, $term->name );
								}
							} else {
								$list = explode( ', ', $list );
								foreach ( $list as $item ) {
									$value = explode( ':', $item );

									$term = get_term_by( 'slug', $value[1], $value[0] );

									if ( $term === false ) {
										continue;
									}

									printf( '<a href="javascript:void(0);" class="btn-filter" data-filter=".%s-%s" data-ajax-filter="%s:%s" data-filter-count="%s"><span class="filter-text">%s</span></a>', $value[0], $value[1], $value[0], $value[1], $term->count, $value[1] );
								}
							}
							?>
						</div>

						<?php if ( $filter_wrap == '1' ) { ?>
					</div>
				</div>
			</div>
		<?php } ?>

		</div>
		<?php
	}

	public static function grid_pagination( $mitech_query, $number, $pagination, $pagination_align, $pagination_button_text ) {
		if ( $pagination !== '' && $mitech_query->found_posts > $number ) { ?>
			<div class="tm-grid-pagination <?php echo esc_attr( $pagination ); ?>">
				<div class="pagination-wrapper" style="text-align:<?php echo esc_attr( $pagination_align ); ?>">

					<?php if ( $pagination === 'loadmore_alt' || $pagination === 'loadmore' || $pagination === 'infinite' ) { ?>
						<div class="inner">
							<div class="tm-grid-loader">
								<?php get_template_part( 'components/preloader/style', 'circle' ); ?>
							</div>
						</div>

						<div class="inner">
							<?php if ( $pagination === 'loadmore' ) { ?>
								<a href="#" class="tm-grid-loadmore-btn tm-button style-solid tm-button-nm">
									<span class="button-text"><?php echo esc_html( $pagination_button_text ); ?></span>
								</a>
							<?php } ?>
						</div>
					<?php } elseif ( $pagination === 'pagination' ) { ?>
						<?php Mitech_Templates::paging_nav( $mitech_query ); ?>
					<?php } ?>

				</div>
			</div>
			<div class="tm-grid-messages" style="display: none;">
				<?php esc_html_e( 'All items displayed.', 'mitech' ); ?>
			</div>
			<?php
		}
	}

	public static function paging_nav( $query = false ) {
		global $wp_query, $wp_rewrite;
		if ( $query === false ) {
			$query = $wp_query;
		}

		// Don't print empty markup if there's only one page.
		if ( $query->max_num_pages < 2 ) {
			return;
		}

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$page_num_link = html_entity_decode( get_pagenum_link() );
		$query_args    = array();
		$url_parts     = explode( '?', $page_num_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$page_num_link = esc_url( remove_query_arg( array_keys( $query_args ), $page_num_link ) );
		$page_num_link = trailingslashit( $page_num_link ) . '%_%';

		$format = '';
		if ( $wp_rewrite->using_index_permalinks() && ! strpos( $page_num_link, 'index.php' ) ) {
			$format = 'index.php/';
		}
		if ( $wp_rewrite->using_permalinks() ) {
			$format .= user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' );
		} else {
			$format .= '?paged=%#%';
		}

		// Set up paginated links.

		$args  = array(
			'base'      => $page_num_link,
			'format'    => $format,
			'total'     => $query->max_num_pages,
			'current'   => max( 1, $paged ),
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( 'Prev', 'mitech' ),
			'next_text' => esc_html__( 'Next', 'mitech' ),
			'type'      => 'array',
		);
		$pages = paginate_links( $args );

		if ( is_array( $pages ) ) {
			echo '<ul class="page-pagination">';
			foreach ( $pages as $page ) {
				printf( '<li>%s</li>', $page );
			}
			echo '</ul>';
		}
	}

	/**
	 * Echo rating html template.
	 *
	 * @param int $rating
	 */
	public static function get_rating_template( $rating = 5 ) {
		$rating = floatval( $rating );
		$rating = round( $rating * 2 ) / 2;

		$full_stars = intval( $rating );

		$template = '';

		$template .= str_repeat( '<span class="fa fa-star"></span>', $full_stars );

		$half_star = floatval( $rating ) - $full_stars;

		if ( $half_star != 0 ) {
			$template .= '<span class="fa fa-star-half-alt"></span>';
		}

		$empty_stars = intval( 5 - $rating );
		$template    .= str_repeat( '<span class="far fa-star"></span>', $empty_stars );

		echo '' . $template;
	}

	public static function get_team_member_social_networks_template( $social_networks = array(), $tooltip_enable = '', $tooltip_position = 'top', $tooltip_skin ) {
		$social_networks = (array) vc_param_group_parse_atts( $social_networks );
		if ( count( $social_networks ) <= 0 ) {
			return;
		}

		$hint_classes = '';

		if ( $tooltip_enable === '1' ) {
			$hint_classes .= " hint--bounce hint--{$tooltip_position}";

			if ( $tooltip_skin !== '' ) {
				$hint_classes .= " hint--{$tooltip_skin}";
			}
		}
		?>

		<div class="social-networks">
			<div class="inner">
				<?php
				foreach ( $social_networks as $data ) {
					$link = isset( $data['link'] ) ? $data['link'] : '';

					if ( $link === '' ) {
						continue;
					}

					$icon_classes = '';
					if ( isset( $data['icon_type'] ) && isset( $data["icon_{$data['icon_type']}"] ) && $data["icon_{$data['icon_type']}"] !== '' ) {

						$icon_classes .= esc_attr( $data["icon_{$data['icon_type']}"] );

						vc_icon_element_fonts_enqueue( $data['icon_type'] );
					}

					$title = isset( $data['title'] ) ? $data['title'] : '';

					$social_network_class = '';

					if ( $title !== '' ) {
						$social_network_class .= $hint_classes;
					}
					?>
					<a target="_blank" href="<?php echo esc_url( $data['link'] ); ?>"

						<?php if ( $social_network_class !== '' ) : ?>
							class="<?php echo esc_attr( $social_network_class ); ?>"
						<?php endif;
						?>

						<?php if ( $title !== '' ): ?>
                       aria-label="<?php echo esc_attr( $title ); ?>">
						<?php endif; ?>

						<i class="<?php echo esc_attr( $icon_classes ); ?>"></i>
					</a>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}
