<?php
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue custom styles.
 */
if ( ! class_exists( 'Mitech_Custom_Css' ) ) {
	class Mitech_Custom_Css {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'extra_css' ) );
		}

		/**
		 * Responsive styles.
		 *
		 * @access public
		 */
		public function extra_css() {
			$extra_style = '';

			$button_style = Mitech::setting( 'button_style' );
			if ( $button_style === 'gradient' ) {
				$button_gradient_color = Mitech::setting( 'button_gradient_color' );

				$button_tmp = "
					border-color: transparent;
					color: {$button_gradient_color['text_color']};
					background-image: linear-gradient(218deg, {$button_gradient_color['color_1']} 0%, {$button_gradient_color['color_2']} 50%, {$button_gradient_color['color_1']} 100%);
					background-size: 200% auto;
					background-position: left center;
				";

				$button_selector       = Mitech_Helper::get_button_css_selector();
				$button_hover_selector = Mitech_Helper::get_button_hover_css_selector();

				$extra_style .= " $button_selector { $button_tmp }";
				$extra_style .= " $button_hover_selector {
					border-color: transparent;
					color: {$button_gradient_color['text_color']};
					background-image: linear-gradient(218deg, {$button_gradient_color['color_1']} 0%, {$button_gradient_color['color_2']} 50%, {$button_gradient_color['color_1']} 100%); 
					background-position: right center; color: {$button_gradient_color['text_color']}; 
				}";
			}

			$custom_logo_width        = Mitech_Helper::get_post_meta( 'custom_logo_width', '' );
			$custom_sticky_logo_width = Mitech_Helper::get_post_meta( 'custom_sticky_logo_width', '' );

			if ( $custom_logo_width !== '' ) {
				$extra_style .= ".branding__logo img { 
                    width: {$custom_logo_width} !important; 
                }";
			}

			if ( $custom_sticky_logo_width !== '' ) {
				$extra_style .= ".headroom--not-top .branding__logo .sticky-logo { 
                    width: {$custom_sticky_logo_width} !important; 
                }";
			}

			$site_width = Mitech_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Mitech::setting( 'site_width' );
			}

			if ( $site_width !== '' ) {
				$extra_style .= "
				.boxed
				{
	                max-width: $site_width;
	            }";
			}

			$site_top_spacing = Mitech_Helper::get_post_meta( 'site_top_spacing', '' );

			if ( $site_top_spacing !== '' ) {
				$extra_style .= "
				.boxed
				{
	                margin-top: {$site_top_spacing};
	            }";
			}

			$site_bottom_spacing = Mitech_Helper::get_post_meta( 'site_bottom_spacing', '' );

			if ( $site_bottom_spacing !== '' ) {
				$extra_style .= "
				.boxed
				{
	                margin-bottom: {$site_bottom_spacing};
	            }";
			}

			$tmp = '';

			$site_background_color = Mitech_Helper::get_post_meta( 'site_background_color', '' );
			if ( $site_background_color !== '' ) {
				$tmp .= "background-color: $site_background_color !important;";
			}

			$site_background_image = Mitech_Helper::get_post_meta( 'site_background_image', '' );
			if ( $site_background_image !== '' ) {
				$site_background_repeat = Mitech_Helper::get_post_meta( 'site_background_repeat', '' );
				$tmp                    .= "background-image: url( $site_background_image ) !important; background-repeat: $site_background_repeat !important;";
			}

			$site_background_position = Mitech_Helper::get_post_meta( 'site_background_position', '' );
			if ( $site_background_position !== '' ) {
				$tmp .= "background-position: $site_background_position !important;";
			}

			$site_background_size = Mitech_Helper::get_post_meta( 'site_background_size', '' );
			if ( $site_background_size !== '' ) {
				$tmp .= "background-size: $site_background_size !important;";
			}

			$site_background_attachment = Mitech_Helper::get_post_meta( 'site_background_attachment', '' );
			if ( $site_background_attachment !== '' ) {
				$tmp .= "background-attachment: $site_background_attachment !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= "body { $tmp; }";
			}

			$tmp = '';

			$content_background_color = Mitech_Helper::get_post_meta( 'content_background_color', '' );
			if ( $content_background_color !== '' ) {
				$tmp .= "background-color: $content_background_color !important;";
			}

			$content_background_image = Mitech_Helper::get_post_meta( 'content_background_image', '' );
			if ( $content_background_image !== '' ) {
				$content_background_repeat = Mitech_Helper::get_post_meta( 'content_background_repeat', '' );
				$tmp                       .= "background-image: url( $content_background_image ) !important; background-repeat: $content_background_repeat !important;";
			}

			$content_background_position = Mitech_Helper::get_post_meta( 'content_background_position', '' );
			if ( $content_background_position !== '' ) {
				$tmp .= "background-position: $content_background_position !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= ".site { $tmp; }";
			}

			$tmp = '';

			$content_padding = Mitech_Helper::get_post_meta( 'content_padding' );

			if ( $content_padding === '0' ) {
				$tmp .= 'padding-top: 0 !important;';
				$tmp .= 'padding-bottom: 0 !important;';
			} elseif ( $content_padding === 'top' ) {
				$tmp .= 'padding-top: 0 !important;';
			} elseif ( $content_padding === 'bottom' ) {
				$tmp .= 'padding-bottom: 0 !important;';
			}

			if ( $tmp !== '' ) {
				$extra_style .= ".page-content { $tmp; }";
			}

			$extra_style .= $this->primary_color_css();
			$extra_style .= $this->secondary_color_css();
			$extra_style .= $this->third_color_css();
			$extra_style .= $this->header_css();
			$extra_style .= $this->sidebar_css();
			$extra_style .= $this->title_bar_css();
			$extra_style .= $this->light_gallery_css();
			$extra_style .= $this->off_canvas_menu_css();
			$extra_style .= $this->mobile_menu_css();

			$extra_style = Mitech_Minify::css( $extra_style );

			wp_add_inline_style( 'mitech-style', html_entity_decode( $extra_style, ENT_QUOTES ) );
		}

		function header_css() {
			$header_type = Mitech_Global::instance()->get_header_type();
			$css         = '';

			$nav_bg_type = Mitech::setting( "header_style_{$header_type}_navigation_background_type" );

			if ( $nav_bg_type === 'gradient' ) {

				$gradient = Mitech::setting( "header_style_{$header_type}_navigation_background_gradient" );
				$_color_1 = $gradient['from'];
				$_color_2 = $gradient['to'];

				$css .= "
				.header-$header_type .header-bottom {
					background: {$_color_1};
                    background: -webkit-linear-gradient(-136deg, {$_color_2} 0%, {$_color_1} 100%);
                    background: linear-gradient(-136deg, {$_color_2} 0%, {$_color_1} 100%);
				}";
			}

			return $css;
		}

		function sidebar_css() {
			$css = '';

			$page_sidebar1  = Mitech_Global::instance()->get_sidebar_1();
			$page_sidebar2  = Mitech_Global::instance()->get_sidebar_2();
			$sidebar_status = Mitech_Global::instance()->get_sidebar_status();

			if ( 'none' !== $page_sidebar1 ) {

				if ( $sidebar_status === 'both' ) {
					$sidebars_breakpoint = Mitech::setting( 'both_sidebar_breakpoint' );
				} else {
					$sidebars_breakpoint = Mitech::setting( 'one_sidebar_breakpoint' );
				}

				$sidebars_below = Mitech::setting( 'sidebars_below_content_mobile' );

				if ( 'none' !== $page_sidebar2 ) {
					$sidebar_width  = Mitech::setting( 'dual_sidebar_width' );
					$sidebar_offset = Mitech::setting( 'dual_sidebar_offset' );
					$content_width  = 100 - $sidebar_width * 2;
				} else {
					$sidebar_width  = Mitech::setting( 'single_sidebar_width' );
					$sidebar_offset = Mitech::setting( 'single_sidebar_offset' );
					$content_width  = 100 - $sidebar_width;
				}

				$css .= "
				@media (min-width: {$sidebars_breakpoint}px) {
					.page-sidebar {
						flex: 0 0 $sidebar_width%;
						max-width: $sidebar_width%;
					}
					.page-main-content {
						flex: 0 0 $content_width%;
						max-width: $content_width%;
					}
				}
				@media (min-width: 1200px) {
					.rtl .page-sidebar-right .page-sidebar-inner,
					.page-sidebar-left .page-sidebar-inner {
						padding-right: $sidebar_offset;
					}
					.rtl .page-sidebar-left .page-sidebar-inner,
					.page-sidebar-right .page-sidebar-inner {
						padding-left: $sidebar_offset;
					}
				}";

				$_max_width_breakpoint = $sidebars_breakpoint - 1;

				if ( $sidebars_below === '1' ) {
					$css .= "
					@media (max-width: {$_max_width_breakpoint}px) {
						.page-sidebar {
							margin-top: 100px;
						}
					
						.page-main-content {
							-webkit-order: -1;
							-moz-order: -1;
							order: -1;
						}
					}";
				}
			}

			return $css;
		}

		function title_bar_css() {
			$css = $title_bar_tmp = $overlay_tmp = '';

			$type    = Mitech_Global::instance()->get_title_bar_type();
			$bg_type = Mitech::setting( "title_bar_{$type}_background_type" );

			if ( $bg_type === 'gradient' ) {
				$gradient_color = Mitech::setting( "title_bar_{$type}_background_gradient" );
				$color1         = $gradient_color['color_1'];
				$color2         = $gradient_color['color_2'];

				$css .= "
					.page-title-bar-inner
					{
						background-color: $color1;
						background-image: linear-gradient(-180deg, {$color1} 0%, {$color2} 100%);
					}
				";
			}

			$bg_color   = Mitech_Helper::get_post_meta( 'page_title_bar_background_color', '' );
			$bg_image   = Mitech_Helper::get_post_meta( 'page_title_bar_background', '' );
			$bg_overlay = Mitech_Helper::get_post_meta( 'page_title_bar_background_overlay', '' );

			if ( $bg_color !== '' ) {
				$title_bar_tmp .= "background-color: {$bg_color}!important;";
			}

			if ( $bg_image !== '' ) {
				$title_bar_tmp .= "background-image: url({$bg_image})!important;";
			}

			if ( $bg_overlay !== '' ) {
				$overlay_tmp .= "background-color: {$bg_overlay}!important;";
			}

			if ( $title_bar_tmp !== '' ) {
				$css .= ".page-title-bar-inner{ {$title_bar_tmp} }";
			}

			if ( $overlay_tmp !== '' ) {
				$css .= ".page-title-bar-overlay{ {$overlay_tmp} }";
			}

			return $css;
		}

		function primary_color_css() {
			$color   = Mitech::setting( 'primary_color' );
			$alpha60 = Mitech_Color::hex2rgba( $color, '0.6' );
			$alpha90 = Mitech_Color::hex2rgba( $color, '0.9' );
			$alpha80 = Mitech_Color::hex2rgba( $color, '0.8' );
			$alpha27 = Mitech_Color::hex2rgba( $color, '0.27' );
			$alpha05 = Mitech_Color::hex2rgba( $color, '0.05' );

			// Color.
			$css = "
				::-moz-selection { color: #fff; background-color: $color }
				::selection { color: #fff; background-color: $color }
                mark,
                .growl-close:hover,
                .newsletter-popup-close:hover,
                .primary-color,
                #powerTip#powerTip,
                .tm-accordion.style-02 .accordion-section.active .accordion-title,
				.tm-accordion.style-02 .accordion-title:hover,
				.tm-button.style-solid:not(:hover),
				.tm-box-icon .btn,
				.tm-box-icon .icon,
				.tm-box-icon.style-03 .heading,
				.tm-box-icon.style-04 .text,
				.tm-box-image .btn,
				.tm-box-image.style-10:hover div.btn,
				.tm-box-large-image.style-03 .btn,
				.tm-box-large-image.style-03:hover .heading,
				.tm-box-large-image.style-04 .btn,
				.tm-blog.style-list-small-image-02 .post-wrapper:hover .post-title,
				.tm-counter .icon,
				.tm-counter .number-wrap,
				.tm-countdown.style-01 .number,
				.tm-circle-progress-chart.style-01 .chart-icon,
				.tm-gradation.style-02 .icon,
				.chart-legends li:hover,
				.tm-drop-cap.style-02 .drop-cap,
				.tm-gradation.style-01 .icon,
				.tm-gradation.style-01 .gradation-btn,
				.tm-gradation.style-01 .item:hover .heading,
				.tm-heading.link-style-01 a,
				.tm-heading.link-style-02 a,
				.tm-heading.link-style-03 a,
				.tm-product-banner-slider .tm-product-banner-btn,
				.tm-twitter.group-style-01 .tweet-info:before,
				.tm-twitter.group-style-01 .tweet-text a:hover,
				.tm-twitter .tweet:before,
				.tm-info-boxes .box-icon,
				.tm-info-boxes .tm-button .button-icon,
				.tm-instagram .instagram-user-name,
				.tm-grid-wrapper.filter-style-01 .btn-filter.current,
				.tm-grid-wrapper.filter-style-01 .btn-filter:hover,
				.tm-blog .post-title a:hover,
				.tm-blog .post-categories a:hover,
				.tm-blog.style-list .sticky .post-sticky,
				.tm-blog.style-grid-metro .format-quote .post-content:before,
				.tm-blog.style-grid-masonry .btn,
				.tm-blog-widget .post-categories a:hover,
				.tm-blog-widget .post-title a:hover,
				.tm-blog-widget.style-simple-list .post-title a:before,
				.tm-mailchimp-form.style-02 .form-submit,
				.tm-pricing .feature-icon,
				.tm-case-study .post-categories,
				.tm-case-study .post-categories a:hover,
				.tm-case-study.style-carousel .btn,
				.tm-case-study.caption-style-02 .btn,
				.tm-case-study .post-title a:hover,
				.tm-popup-map .tm-button-map,
				.tm-icon.style-01 .icon,
				.tm-list .marker,
				.tm-list .link:hover,
				.tm-list.style-auto-numbered-02 .link:hover .marker,
				.tm-list.style-auto-numbered-02 .link:hover .title,
				.tm-list.style-auto-numbered-02 .title:before,
				.tm-mailchimp-form-popup .subscribe-open-popup-link, .mailchimp-form-popup-close:hover,			
				.tm-mailchimp-form-box.style-01 .form-submit,
				.tm-problem-solution .problem:before,
				.tm-problem-solution .solution:before,
				.tm-popup-video.style-button-03 .video-play,
				.tm-social-networks .link:hover,
				.tm-social-networks.style-title .item:hover .link-text,
				.tm-swiper .swiper-nav-button:hover,
				.tm-slider a:hover .heading,
				.tm-timeline.style-01 .year,
				.tm-timeline.style-01 .dots,
				.vc_progress_bar .vc_general.vc_single_bar .vc_bar,
				.woosw-area .woosw-inner .woosw-content .woosw-content-top .woosw-close:hover,
				.woosw-area .woosw-inner .woosw-content .woosw-content-bot .woosw-content-bot-inner .woosw-page a:hover,
				.woosw-continue:hover,
				.skin-primary .wpcf7-text.wpcf7-text, .skin-primary .wpcf7-textarea,
				.tm-menu .menu-price,
				.page-content .tm-custom-menu.style-1 .menu a:hover,
				.case-study-nav-links .inner h6:before,
				.widget_archive li a:hover,
				.widget_categories li a:hover,
				.widget_product_categories li a:hover,
				.woocommerce-widget-layered-nav-list a:hover,
				.single-post .post-meta .meta-icon,
				.single-post .post-meta .sl-icon,
				.entry-post-categories a:hover,
				.entry-post-tags a:hover,
				.entry-post-share a:hover,
				.page-sidebar .widget_pages .current-menu-item > a,
				.page-sidebar .widget_nav_menu .current-menu-item > a,
				.page-sidebar .insight-core-bmw .current-menu-item > a,
				.widget_recent_entries .post-date:before,
				.page-links > span, .page-links > a:hover, .page-links > a:focus,
				.comment-list .comment-actions a:hover,
				.page-sidebar-fixed .widget a:hover,
				.archive-case-study-category-list .cat-item.current a,
				.archive-case-study-category-list .cat-item a:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-01 .vc_tta-tab > a:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-01 .vc_tta-tab.vc_active > a,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-02 .vc_tta-tab > a:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-02 .vc_tta-tab.vc_active > a,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-01 .vc_tta-panel-heading:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-01 .vc_active .vc_tta-panel-heading,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-02 .vc_tta-panel-heading:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-02 .vc_active .vc_tta-panel-heading,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-03 .vc_tta-tab:not(.vc_active) > a:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-03 .vc_tta-panel-heading:hover,
				.tm-box-image.style-11 .content-wrap:hover .heading
				{ 
					color: {$color} 
				}";

			// Color Important.
			$css .= "
                .primary-color-important,
				.primary-color-hover-important:hover
				 {
                      color: {$color}!important;
				 }";

			// Background Color.
			$css .= "
                .primary-background-color,
                .hint--primary:after,
                #powerTip#powerTip,
                .page-scroll-up,
                .widget_calendar #today,
                .top-bar-01 .top-bar-button,
                .tm-box-image.style-01:hover .circle-arrow .middle-arrow,
                .tm-box-image.style-06 .btn:before,
                .tm-box-large-image.style-03 .btn:before,
                .tm-blog.style-grid-masonry .btn:before,
                .tm-case-study.style-carousel .btn:before,
                .tm-case-study.caption-style-02 .btn:before,
                .tm-gradation.style-02 .dot,
                .tm-gradation.style-02 .item:hover .icon,
				.tm-gallery .overlay,
				.tm-grid-wrapper.filter-style-01 .filter-counter,
				.tm-icon.style-02 .icon,
				.tm-countdown.style-03 .number,
				.tm-circle-progress-chart.style-02 .circle-design,
				.tm-circle-progress-chart.style-02 .inner-circle,
				.tm-heading.below-separator .separator:after,
				.tm-heading.thick-separator .separator:after,
				.tm-heading.top-separator .separator:after,
				.tm-heading.modern-number-02 .heading:before,
				.tm-maps.marker-style-signal .animated-dot .middle-dot,
				.tm-maps.marker-style-signal .animated-dot div[class*='signal'],
				.tm-separator.style-modern-dots .dot,
				.tm-text-box.style-03,
				.tm-rotate-box .box,
				.tm-social-networks.style-flat-rounded-icon .link:hover,
				.tm-social-networks.style-solid-rounded-icon .link:hover,
				.tm-popup-video .video-play,
				.tm-pricing .tm-pricing-button:hover,
				.tm-product.style-grid .product-actions,
				body.search .page-main-content .search-form .search-submit,
				.tm-mailchimp-form-box.style-01,
				.tm-services-list.style-02 .service-image .blend-bg,    
				.tm-swiper .swiper-pagination-progressbar .swiper-pagination-progressbar-fill,
				.tm-swiper.nav-style-02 .swiper-nav-button:hover,
				.tm-swiper.nav-style-02 .swiper-nav-button:before,
				.vc_progress_bar .vc_general.vc_single_bar .vc_bar,
				.archive-case-study-category-list .cat-link:after,
				.single-post .entry-post-feature.post-quote,
				.entry-post-share .share-icon,
				.widget .tagcloud a:before,
				.entry-case-study-feature .gallery-item .overlay,
				.widget_search .search-submit:hover,
				.widget_product_search .search-submit:hover,
				body.search .page-main-content .search-form .search-submit:hover,
				.tm-search-form .category-list a:hover,
				.woocommerce .select2-container--default .select2-results__option--highlighted[aria-selected],
				.vc_general.vc_pagination.vc_pagination-shape-round .vc_active .vc_pagination-trigger:before
				{
					background-color: {$color};
				}";

			$css .= "
                .primary-background-color-important,
				.primary-background-color-hover-important:hover,
				.lSSlideOuter .lSPager.lSpg>li a:before,
				.lg-progress-bar .lg-progress,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-03 .vc_tta-tab.vc_active > a,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-03 .vc_active .vc_tta-panel-heading
				{
					background-color: {$color}!important;
				}";

			$css .= "
                .tm-twitter.style-slider-quote .tweet-text
				{
					background-color: {$alpha05};
				}";

			$css .= "
                .tm-popup-video.style-poster-01 .video-overlay
				{
					background-color: {$alpha80};
				}";

			$css .= "
                .tm-view-demo .overlay
				{
					background-color: {$alpha90};
				}";

			// Border.
			$css .= "
				.primary-border-color,
				.tm-button.style-solid:not(:hover),
				.tm-box-image.style-01 .circle-arrow .middle-dot,
				.tm-image-hotspot.style-signal .drag_element:before,
				.widget_search .search-field:focus,
				.widget_product_search .search-field:focus,
                .popup-search-wrap .search-form .search-field:focus,
                .widget .mc4wp-form input[type=email]:focus,
				.tm-popup-video.style-button-02 .wave-pulse:before,
				.tm-popup-video.style-button-02 .wave-pulse:after,
				.tm-popup-video.style-poster-02 .wave-pulse:before,
				.tm-popup-video.style-poster-02 .wave-pulse:after,
				.widget_pages .current-menu-item, .widget_nav_menu .current-menu-item, .insight-core-bmw .current-menu-item,
				.tm-box-image.style-11 .content-wrap:hover
				{
					border-color: {$color};
				}";

			// Combo Background + Border
			$css .= "
			.tm-gradation.style-01 .item:hover .circle,
			.tm-list-selection.style-01 select,
			.tm-slider-button.style-01 .slider-btn:hover
			{
				border-color: $color;
				background-color: $color;	
			}
			";

			$css .= "
			.wishlist-btn.style-01 a:not(:hover),
			.compare-btn.style-01 a:not(:hover) {
				color: $color;
				border-color: $color;
			}
			";

			// Border Important.
			$css .= "
                .primary-border-color-important,
				.primary-border-color-hover-important:hover,
				.lg-outer .lg-thumb-item.active, .lg-outer .lg-thumb-item:hover,
				#fp-nav ul li a.active span, .fp-slidesNav ul li a.active span,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-01 .vc_tta-tab > a:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-01 .vc_tta-tab.vc_active > a,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-01 .vc_tta-panel-heading:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-01 .vc_active .vc_tta-panel-heading,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-02 .vc_tta-tab > a:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-02 .vc_tta-tab.vc_active > a,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-02 .vc_tta-panel-heading:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-02 .vc_active .vc_tta-panel-heading,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-03 .vc_tta-tab > a:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-03 .vc_tta-tab.vc_active > a,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-03 .vc_tta-panel-heading:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-mitech-03 .vc_active .vc_tta-panel-heading
				{
					border-color: {$color}!important;
				}";

			// Border Top.
			$css .= "
                .tm-grid-wrapper.filter-style-01 .filter-counter:before,
                .hint--primary.hint--top-left:before,
                .hint--primary.hint--top-right:before,
                .hint--primary.hint--top:before
                {
					border-top-color: {$color};
				}";

			// Border Right.
			$css .= "
                .hint--primary.hint--right:before
                {
					border-right-color: {$color};
				}";

			// Border Bottom.
			$css .= "
                .hint--primary.hint--bottom-left:before,
                .hint--primary.hint--bottom-right:before,
                .hint--primary.hint--bottom:before
                {
					border-bottom-color: {$color};
				}";

			// Border Left.
			$css .= "
                .hint--primary.hint--left:before
                {
                    border-left-color: {$color};
                }";

			$css .= ".testimonial-info svg *
			{
				fill: {$color}; 
			}";

			$css .= "
			.tm-circle-progress-chart.style-02 .circle-design
			{
				box-shadow: 0 2px 17px {$alpha27};
			}";

			$css .= "
			.tm-image-hotspot.style-signal .drag_element:before
			{
				box-shadow: inset 0 0 17px 10px $alpha60;
			}";

			if ( Mitech_Woo::instance()->is_activated() ) {
				$css .= "
				.widget_price_filter .ui-slider,
				.tm-product .woocommerce-loop-product__title a:hover,
				.woocommerce .shop_table td.product-subtotal,
				.cart-collaterals .order-total .amount,
				.woocommerce .cart_list.product_list_widget a:hover,
				.woocommerce .cart.shop_table td.product-name a:hover,
				.woocommerce ul.product_list_widget li .product-title:hover,
				.entry-product-meta a:hover,
				.woo-quick-view-popup-content .product_title a:hover,
				.tm-banner.style-02 .tm-banner-button
				{
					color: {$color}
				}";

				$css .= "
				 .woocommerce nav.woocommerce-pagination ul li span.prev:hover,
				 .woocommerce nav.woocommerce-pagination ul li span.next:hover,
				 .woocommerce nav.woocommerce-pagination ul li a.prev:hover,
				 .woocommerce nav.woocommerce-pagination ul li a.next:hover
				 {
					color: {$color} !important;
				 }";

				$css .= "
				 .woocommerce nav.woocommerce-pagination ul li span.current,
				 .woocommerce nav.woocommerce-pagination ul a:hover
				 {
					background-color: {$color} !important;
				 }";

				$css .= "
				.woocommerce-MyAccount-navigation .is-active a,
				.woocommerce-MyAccount-navigation a:hover
				{ 
					background-color: {$color}; 
				}";

				$css .= "
				.single-product .woo-single-gallery .lSPager > li:hover img,
				.single-product .woo-single-gallery .lSPager > li.active img,
				body.woocommerce-cart table.cart td.actions .coupon .input-text:focus,
				.woocommerce div.quantity .qty:focus,
				.woocommerce div.quantity button:hover:before,
				.tm-banner.style-02 .banner-wrap:hover
				{
					border-color: {$color};
				}";

				$css .= "
                .mini-cart .widget_shopping_cart_content,
				.single-product .woocommerce-tabs li.active,
				.woocommerce .select2-container .select2-choice {
					border-bottom-color: {$color};
				}";
			}

			return $css;
		}

		function secondary_color_css() {
			$color = Mitech::setting( 'secondary_color' );

			// Color.
			$css = "
				.secondary-color,
				.tm-accordion.style-02 .accordion-section.active .accordion-icon:before,
				.tm-accordion.style-02 .accordion-title:hover .accordion-icon:before,
				.tm-blog .post-read-more.style-link a:hover,
				.tm-blog .post-categories,
				.tm-blog-widget .post-categories,
				.tm-box-icon:hover div.btn,
				.tm-box-icon a.btn:hover,
				.tm-box-icon.style-03 .icon,
				.tm-box-icon.style-04 .icon,
				.tm-box-image:hover div.btn,
				.tm-box-image a.btn:hover,
				.tm-counter.style-01 .heading,
				.tm-gradation.style-01 .gradation-btn:hover,
				.tm-heading.highlight-01 .heading mark,
				.tm-heading.modern-number-01 .heading mark,
				.tm-pricing.style-01 .tm-pricing-list li:before,
				.tm-twitter.style-slider-quote .tweet-text a,
				.related-case-study-item .post-categories,
				.single-post .post-link a,
				.entry-post-categories,
				.related-posts .post-categories,
				.entry-case-study-categories,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-title>a
				{
					color: {$color} 
				}";

			// Color Important.
			$css .= "
				.secondary-color-important,
				.secondary-color-hover-important:hover
				{
					color: {$color}!important;
				}";

			// Background Color.
			$css .= "
				.secondary-background-color,
				.hint--secondary:after,
				.top-bar-01 .top-bar-button:hover,
				.tm-accordion.style-01 .accordion-section.active .accordion-title,
				.tm-accordion.style-01 .accordion-section:hover .accordion-title,
				.tm-blog.style-list .post-link,
				.tm-blog.style-list-small-image .post-link,
				.tm-box-image.style-01 .circle-arrow .middle-arrow,
				.tm-box-large-image.style-02 .btn,
				.tm-heading.left-line .heading:before,
				.tm-pricing.style-01 .tm-pricing-feature-mark,
				.tm-pricing.style-02 .tm-pricing-button,
				.tm-search-form .search-submit:hover,
				.tm-social-networks.style-title .link-text:after,
				.widget_archive .count,
				.widget_categories .count,
				.widget_product_categories .count,
				.woocommerce-widget-layered-nav-list .count,
				.vc_tta-color-secondary.vc_tta-style-classic .vc_tta-tab>a,
				.vc_tta-color-secondary.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-tabs.vc_tta-color-secondary.vc_tta-style-modern .vc_tta-tab > a,
				.vc_tta-color-secondary.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-secondary.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-body,
				.vc_tta-color-secondary.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-secondary.vc_tta-style-flat .vc_tta-tab>a,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:focus,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-tab:not(.vc_active) >a:focus,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-tab:not(.vc_active) >a:hover
				{
					background-color: {$color};
				}";

			$css .= "
				.secondary-background-color-important,
				.secondary-background-color-hover-important:hover,
				.mejs-controls .mejs-time-rail .mejs-time-current
				{
					background-color: {$color}!important;
				}";

			$css .= "
				.secondary-border-color,
				.vc_tta-color-secondary.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-controls-icon::after,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-controls-icon::before,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body::after,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body::before,
				.vc_tta-tabs.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-tab > a
				{
					border-color: {$color};
				}";


			$css .= "
				.secondary-border-color-important,
				.secondary-border-color-hover-important:hover,
				.wp-block-quote
				{
					border-color: {$color}!important;
				}";

			// Border Top.
			$css .= "
                .hint--secondary.hint--top-left:before,
                .hint--secondary.hint--top-right:before,
                .hint--secondary.hint--top:before,
                .tm-pricing.style-02 .tm-pricing-feature-mark
                {
					border-top-color: {$color};
				}";

			// Border Right.
			$css .= "
				.rtl blockquote,
                .hint--secondary.hint--right:before
                {
					border-right-color: {$color};
				}";

			// Border Bottom.
			$css .= "
                .hint--secondary.hint--bottom-left:before,
                .hint--secondary.hint--bottom-right:before,
                .hint--secondary.hint--bottom:before
                {
					border-bottom-color: {$color};
				}";

			// Border Left.
			$css .= "
				blockquote,
                .hint--secondary.hint--left:before
                {
                    border-left-color: {$color};
                }";

			if ( Mitech_Woo::instance()->is_activated() ) {
				$css .= "
				.tm-product-search-form .search-submit:hover,
				.woocommerce .cats .product-category:hover .cat-text,
				.woocommerce .products div.product .product-overlay
				{ 
					background-color: {$color}; 
				}";

				$css .= "
				.woocommerce.single-product div.product .images .thumbnails .item img:hover
				{
					border-color: {$color};
				}";
			}

			return $css;
		}

		function third_color_css() {
			$css   = '';
			$color = Mitech::setting( 'third_color' );

			$css .= "
			.third-color,
			.tm-swiper .swiper-pagination-bullet,
			.tm-box-image.style-02:hover .heading,
			.tm-counter.style-03 .icon,
			.tm-icon.style-03 .icon,
			.comment-nav-links li .current,
			.comment-nav-links li a:hover,
			.comment-nav-links li a:focus,
			.page-pagination li .current,
			.page-pagination li a:hover,
			.page-pagination li a:focus,
			.entry-case-study-return-link
			{
				color: $color;
			}
			";

			$css .= "
			.tm-box-image.style-04:hover .content-wrap,
			.entry-case-study-return-link:hover,
			.tm-team-member.group-style-01 .social-networks,
			.tm-pricing.style-02.highlight .inner
			{
				background-color: $color;
			}
			";

			return $css;
		}

		function light_gallery_css() {
			$css                    = '';
			$primary_color          = Mitech::setting( 'primary_color' );
			$secondary_color        = Mitech::setting( 'secondary_color' );
			$cutom_background_color = Mitech::setting( 'light_gallery_custom_background' );
			$background             = Mitech::setting( 'light_gallery_background' );

			$tmp = '';

			if ( $background === 'primary' ) {
				$tmp .= "background-color: {$primary_color} !important;";
			} elseif ( $background === 'secondary' ) {
				$tmp .= "background-color: {$secondary_color} !important;";
			} else {
				$tmp .= "background-color: {$cutom_background_color} !important;";
			}

			$css .= ".lg-backdrop { $tmp }";

			return $css;
		}

		function off_canvas_menu_css() {
			$css  = '';
			$type = Mitech::setting( 'navigation_minimal_01_background_type' );
			if ( $type === 'gradient' ) {
				$gradient = Mitech::setting( 'navigation_minimal_01_background_gradient_color' );

				$css .= ".page-off-canvas-main-menu {
				    background-color: {$gradient['color_1']};
					background-image: linear-gradient(138deg, {$gradient['color_1']} 0%, {$gradient['color_2']} 100%);
				}";
			}

			return $css;
		}

		function mobile_menu_css() {
			$css  = '';
			$type = Mitech::setting( 'mobile_menu_background_type' );
			if ( $type === 'gradient' ) {
				$gradient = Mitech::setting( 'mobile_menu_background_gradient_color' );

				$css .= ".page-mobile-main-menu > .inner {
				    background-color: {$gradient['color_1']};
					background-image: linear-gradient(138deg, {$gradient['color_1']} 0%, {$gradient['color_2']} 100%);
				}";
			}

			return $css;
		}
	}

	new Mitech_Custom_Css();
}
