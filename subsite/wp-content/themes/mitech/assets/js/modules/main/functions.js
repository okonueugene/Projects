var $window            = $( window ),
    $html              = $( 'html' ),
    $body              = $( 'body' ),
    $pageWrapper       = $( '#page' ),
    $pageHeader        = $( '#page-header' ),
    $headerInner       = $( '#page-header-inner' ),
    $pageContent       = $( '#page-content' ),
    headerStickyEnable = $insight.header_sticky_enable,
    headerStickyHeight = parseInt( $insight.header_sticky_height ),
    queueResetDelay,
    animateQueueDelay  = 200,
    wWidth             = window.innerWidth;
/**
 * Global ajaxBusy = false
 * Desc: Status of ajax
 */
var ajaxBusy = false;
$( document ).ajaxStart( function() {
	ajaxBusy = true;
} ).ajaxStop( function() {
	ajaxBusy = false;
} );

$( window ).on( 'resize', function() {
	$body.addClass( 'window-resized' );
	wWidth = window.innerWidth;

	calMobileMenuBreakpoint();
	reCalculateVcRowFullHeight();
	boxedFixVcRow();
	calculateLeftHeaderSize();
	initStickyHeader();
	initFooterParallax();
	initFooterFixed();
} );

$( window ).on( 'load', function() {
	initPreLoader();
	initStickyHeader();

	window.dispatchEvent( new Event( 'resize' ) );
} );

$( document ).ready( function() {
	initLazyLoaderImages();

	// Call functions in load event to make header sticky working properly.
	initQueueAnimationForElements();
	initAnimationForElements();

	calMobileMenuBreakpoint();
	reCalculateVcRowFullHeight();
	boxedFixVcRow();

	marqueBackground();
	scrollToTop();
	// Remove empty p tags form wpautop.
	$( 'p:empty' ).remove();

	calculateLeftHeaderSize();

	insightInitGrid();
	initSliders();

	setTimeout( function() {
		navOnePage();
	}, 100 );

	$body.on( 'click', '.vc_tta-tab, .vc_tta-panel', function() {
		var $tabs = $( this ).parents( '.vc_general' ).first();

		$tabs.find( '.ll-image' ).laziestloader( { threshold: 100 } ).removeClass( 'unload' );

		$( window ).trigger( 'resize' );
	} );

	initFooterParallax();
	initFooterFixed();
	initSmoothScrollLinks();
	initLightGalleryPopups();
	initVideoPopups();
	initMapPopups();
	initSearchPopup();
	initHeaderRightMoreTools();
	initOffSidebar();

	insightInitSmartmenu();
	initOffCanvasMenu();
	initMobileMenu();
	initCookieNotice();
	initNewsletterPopup();
	handlerEntryPostShare();
} );

function initSliders() {
	$( '.mitech-swiper' ).each( function() {
		if ( $( this ).hasClass( 'mitech-swiper-linked-yes' ) ) {
			var mainSlider = $( this ).children( '.mitech-main-swiper' ).insightSwiper();
			var thumbsSlider = $( this ).children( '.mitech-thumbs-swiper' ).insightSwiper();

			mainSlider.controller.control = thumbsSlider;
			thumbsSlider.controller.control = mainSlider;
		} else {
			$( this ).insightSwiper();
		}
	} );
}

function initPreLoader() {
	setTimeout( function() {
		$body.addClass( 'loaded' );
	}, 200 );

	var $loader = $( '#page-preloader' );

	setTimeout( function() {
		$loader.remove();
	}, 2000 );
}

function initLightGalleryPopups() {
	$( '.tm-light-gallery' ).each( function() {
		insightInitLightGallery( $( this ) );
	} );
}

function initVideoPopups() {
	$( '.tm-popup-video' ).each( function() {
		handlerPopupVideo( $( this ) );
	} );
}

function handlerPopupVideo( $popup ) {
	var options = {
		selector: 'a',
		fullScreen: false,
		zoom: false
	};
	$popup.lightGallery( options );
}

function initMapPopups() {
	$( '.tm-popup-map' ).each( function() {
		handlerPopupMap( $( this ).children( 'a' ) );
	} );
}

function handlerPopupMap( $popup ) {
	var options = {
		selector: 'this',
		iframeMaxWidth: '80%',
		autoplay: false,
		fullScreen: false,
		zoom: false,
		hash: false,
		share: false,
		pager: false,
		animateThumb: false,
		showThumbByDefault: false,
		getCaptionFromTitleOrAlt: false
	};
	$popup.lightGallery( options );
}

function marqueBackground() {
	$( '.background-marque' ).each( function() {
		var $el = $( this );
		var x = 0;
		var step = 1;
		var speed = 10;

		if ( $el.hasClass( 'to-left' ) ) {
			step = - 1;
		}

		$el.css( 'background-repeat', 'repeat-x' );

		var loop = setInterval( function() {
			x += step;
			$el.css( 'background-position-x', x + 'px' );
		}, speed );

		if ( $el.data( 'marque-pause-on-hover' ) == true ) {
			$( this ).hoverIntent( function() {
				clearInterval( loop );
			}, function() {
				loop = setInterval( function() {
					x += step;
					$el.css( 'background-position-x', x + 'px' );
				}, speed );
			} );
		}
	} );
}

function initSmoothScrollLinks() {
	// Allows for easy implementation of smooth scrolling for buttons.
	$( '.smooth-scroll-link' ).on( 'click', function( e ) {
		var href = $( this ).attr( 'href' );

		if ( ! href ) {
			href = $( this ).data( 'href' );
		}

		var _wWidth = window.innerWidth;
		if ( href.match( /^([.#])(.+)/ ) ) {
			e.preventDefault();
			var offset = 0;
			if ( $insight.header_sticky_enable == 1 && $pageHeader.length > 0 && $headerInner.data( 'sticky' ) == '1' ) {

				if ( $headerInner.data( 'header-position' ) === 'left' ) {
					if ( _wWidth < $insight.mobile_menu_breakpoint ) {
						offset += headerStickyHeight;
					}
				} else {
					offset += headerStickyHeight;
				}
			}

			// Add offset of admin bar when viewport min-width 600.
			if ( _wWidth > 600 ) {
				var adminBarHeight = $( '#wpadminbar' ).height();
				offset += adminBarHeight;
			}

			$.smoothScroll( {
				offset: - offset,
				scrollTarget: $( href ),
				speed: 600,
				easing: 'linear'
			} );
		}
	} );
}

function initAnimationForElements() {
	if ( ! $body.hasClass( 'page-has-animation' ) ) {
		return;
	}

	var $animations = $pageContent.find( '.tm-animation' );

	$animations.vcwaypoint( function() {
		// Fix for different ver of waypoints plugin.
		var _self = this.element ? this.element : $( this );
		$( _self ).addClass( 'animate' );
	}, {
		offset: '100%' // triggerOnce: true
	} );
}

function initQueueAnimationForElements() {
	$( '.tm-animation-queue' ).each( function() {
		var itemQueue  = [],
		    queueTimer,
		    queueDelay = $( this ).data( 'animation-delay' ) ? $( this ).data( 'animation-delay' ) : animateQueueDelay;

		$( this ).children( '.item' ).vcwaypoint( function() {
			// Fix for different ver of waypoints plugin.
			var _self = this.element ? this.element : $( this );

			queueResetDelay = setTimeout( function() {
				queueDelay = animateQueueDelay;
			}, animateQueueDelay );

			itemQueue.push( _self );
			processItemQueue( itemQueue, queueDelay, queueTimer );
			queueDelay += animateQueueDelay;
		}, {
			offset: '90%',
			triggerOnce: true
		} );
	} );
}

function processItemQueue( itemQueue, queueDelay, queueTimer, queueResetDelay ) {
	clearTimeout( queueResetDelay );
	queueTimer = window.setInterval( function() {
		if ( itemQueue !== undefined && itemQueue.length ) {
			$( itemQueue.shift() ).addClass( 'animate' );
			processItemQueue();
		} else {
			window.clearInterval( queueTimer );
		}
	}, queueDelay );
}

function insightInitSmartmenu() {
	var $primaryMenu = $pageHeader.find( '#page-navigation' ).find( 'ul' ).first();

	if ( ! $primaryMenu.hasClass( 'sm' ) ) {
		return;
	}

	$primaryMenu.smartmenus( {
		subMenusSubOffsetX: 0,
		subMenusSubOffsetY: - 17
	} );

	// Add animation for sub menu.
	$primaryMenu.on( {
		'show.smapi': function( e, menu ) {
			$( menu ).removeClass( 'hide-animation' ).addClass( 'show-animation' );
		},
		'hide.smapi': function( e, menu ) {
			$( menu ).removeClass( 'show-animation' ).addClass( 'hide-animation' );
		}
	} ).on( 'animationend webkitAnimationEnd oanimationend MSAnimationEnd', 'ul', function( e ) {
		$( this ).removeClass( 'show-animation hide-animation' );
		e.stopPropagation();
	} );
}

function insightInitLightGallery( $gallery ) {
	var _download   = (
		    $insight.light_gallery_download === '1'
	    ),
	    _autoPlay   = (
		    $insight.light_gallery_auto_play === '1'
	    ),
	    _zoom       = (
		    $insight.light_gallery_zoom === '1'
	    ),
	    _fullScreen = (
		    $insight.light_gallery_full_screen === '1'
	    ),
	    _share      = (
		    $insight.light_gallery_share === '1'
	    ),
	    _thumbnail  = (
		    $insight.light_gallery_thumbnail === '1'
	    );

	var options = {
		selector: '.zoom',
		thumbnail: _thumbnail,
		download: _download,
		autoplay: _autoPlay,
		zoom: _zoom,
		share: _share,
		fullScreen: _fullScreen,
		hash: false,
		animateThumb: false,
		showThumbByDefault: false,
		getCaptionFromTitleOrAlt: false
	};

	$gallery.lightGallery( options );
}

function animateMagicLineOnScroll( $li, onScroll ) {
	if ( onScroll == false ) {
		$li.siblings( 'li' ).removeClass( 'current-menu-item' );
		$li.addClass( 'current-menu-item' );
	}
}

function navOnePage() {
	if ( ! $body.hasClass( 'one-page' ) ) {
		return;
	}
	var $header = $( '#page-header' );
	var $headerInner = $header.children( '#page-header-inner' );
	var $mainNav = $( '#page-navigation' ).find( '.menu__container' ).first();
	var $li = $mainNav.children( '.menu-item' );
	var $links = $li.children( 'a[href*="#"]:not([href="#"])' );
	var onScroll = false;

	var offset = 0;

	if ( $body.hasClass( 'admin-bar' ) ) {
		offset += 32;
	}

	if ( headerStickyEnable == 1 && $headerInner.data( 'sticky' ) == '1' ) {
		offset += headerStickyHeight;
		offset = - offset;
	}

	$li.each( function() {
		if ( $( this ).hasClass( 'current-menu-item' ) ) {
			var _link = $( this ).children( 'a' );

			if ( _link[ 0 ].hash !== '' ) {
				$( this ).removeClass( 'current-menu-item' );
			}
		}
	} );

	$links.each( function() {
		var $this = $( this );
		var id = this.hash;
		var parent = $this.parent();

		if ( $( id ).length > 0 ) {
			$( id ).vcwaypoint( function( direction ) {
				if ( direction === 'down' ) {
					animateMagicLineOnScroll( parent, onScroll );
				}
			}, {
				offset: '25%'
			} );

			$( id ).vcwaypoint( function( direction ) {
				if ( direction === 'up' ) {
					animateMagicLineOnScroll( parent, onScroll );
				}
			}, {
				offset: '-25%'
			} );
		}
	} );

	// Allows for easy implementation of smooth scrolling for navigation links.
	$links.on( 'click', function() {
		var $this = $( this );
		var href = this.hash;
		var parent = $this.parent( 'li' );

		parent.siblings( 'li' ).removeClass( 'current-menu-item' );
		parent.addClass( 'current-menu-item' );

		if ( $( href ).length > 0 ) {
			$.smoothScroll( {
				offset: offset,
				scrollTarget: $( href ),
				speed: 600,
				easing: 'linear',
				beforeScroll: function() {
					onScroll = true;
				},
				afterScroll: function() {
					onScroll = false;
				}
			} );
		}

		return false;
	} );

	// Smooth scroll to section if url has hash tag when page loaded.
	var hashTag = window.location.hash;
	if ( hashTag && $( hashTag ).length > 0 ) {
		$.smoothScroll( {
			offset: offset,
			scrollTarget: $( hashTag ),
			speed: 600,
			easing: 'linear',
			beforeScroll: function() {
				onScroll = true;
			},
			afterScroll: function() {
				onScroll = false;
			}
		} );
	}
}

function initFooterParallax() {
	var footerWrap = $( '#page-footer-wrapper' );

	if ( ! footerWrap.hasClass( 'parallax' ) || $body.hasClass( 'page-template-one-page-scroll' ) ) {
		return;
	}

	if ( footerWrap.length > 0 ) {
		var contentWrap = $pageWrapper.children( '.content-wrapper' );
		if ( wWidth >= 1024 ) {
			var fwHeight = footerWrap.height();
			$body.addClass( 'page-footer-parallax' );
			contentWrap.css( {
				marginBottom: fwHeight
			} );
		} else {
			$body.removeClass( 'page-footer-parallax' );
			contentWrap.css( {
				marginBottom: 0
			} );
		}
	}
}

function initFooterFixed() {
	var footerWrap = $( '#page-footer-wrapper' );

	if ( ! footerWrap.hasClass( 'fixed' ) || $body.hasClass( 'page-template-one-page-scroll' ) ) {
		return;
	}

	if ( footerWrap.length > 0 ) {
		var contentWrap = $pageWrapper.children( '.content-wrapper' );

		var fwHeight = footerWrap.height();
		$body.addClass( 'page-footer-fixed' );
		contentWrap.css( {
			marginBottom: fwHeight
		} );
	}
}

function scrollToTop() {
	if ( $insight.scroll_top_enable != 1 ) {
		return;
	}
	var $scrollUp = $( '#page-scroll-up' );
	var lastScrollTop = 0;

	$window.on( 'scroll', function() {
		var st = $( this ).scrollTop();
		if ( st > lastScrollTop ) {
			$scrollUp.removeClass( 'show' );
		} else {
			if ( $window.scrollTop() > 200 ) {
				$scrollUp.addClass( 'show' );
			} else {
				$scrollUp.removeClass( 'show' );
			}
		}
		lastScrollTop = st;
	} );

	$scrollUp.on( 'click', function( evt ) {
		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
		evt.preventDefault();
	} );
}

function openMobileMenu() {
	$body.addClass( 'page-mobile-menu-opened' );

	$( document ).trigger( 'mobileMenuOpen' );
}

function closeMobileMenu() {
	$body.removeClass( 'page-mobile-menu-opened' );

	$( document ).trigger( 'mobileMenuClose' );
}

function calMobileMenuBreakpoint() {
	var _breakpoint = $insight.mobile_menu_breakpoint;
	if ( wWidth <= _breakpoint ) {
		$body.removeClass( 'desktop-menu' ).addClass( 'mobile-menu' );
	} else {
		$body.addClass( 'desktop-menu' ).removeClass( 'mobile-menu' );
	}
}

function initMobileMenu() {
	$( '#page-open-mobile-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		e.stopPropagation();

		openMobileMenu();
	} );

	$( '#page-close-mobile-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		e.stopPropagation();

		closeMobileMenu();
	} );

	$( '#page-mobile-main-menu' ).on( 'click', function( e ) {
		if ( e.target !== this ) {
			return;
		}

		closeMobileMenu();
	} );

	$( document ).on( 'mobileMenuOpen', function() {
		$html.css( {
			'overflow': 'hidden'
		} );
	} );

	$( document ).on( 'mobileMenuClose', function() {
		$html.css( {
			'overflow': ''
		} );
	} );

	var menu = $( '#mobile-menu-primary' );

	menu.on( 'click', 'a', function( e ) {
		var $this = $( this );
		var _li = $( this ).parent( 'li' );
		var href = $this.attr( 'href' );

		if ( $body.hasClass( 'one-page' ) && href && href.match( /^([.#])(.+)/ ) ) {
			closeMobileMenu();
			var offset = 0;

			if ( $body.hasClass( 'admin-bar' ) ) {
				offset += 32;
			}

			if ( headerStickyEnable == 1 && $headerInner.data( 'sticky' ) == '1' ) {
				offset += headerStickyHeight;
			}

			if ( offset > 0 ) {
				offset = - offset;
			}

			_li.siblings( 'li' ).removeClass( 'current-menu-item' );
			_li.addClass( 'current-menu-item' );

			setTimeout( function() {
				$.smoothScroll( {
					offset: offset,
					scrollTarget: $( href ),
					speed: 600,
					easing: 'linear'
				} );
			}, 300 );

			return false;
		}
	} );

	menu.on( 'click', '.toggle-sub-menu', function( e ) {
		var _li = $( this ).parents( 'li' ).first();

		e.preventDefault();
		e.stopPropagation();

		var _friends = _li.siblings( '.opened' );
		_friends.removeClass( 'opened' );
		_friends.find( '.opened' ).removeClass( 'opened' );
		_friends.find( '.sub-menu' ).stop().slideUp();

		if ( _li.hasClass( 'opened' ) ) {
			_li.removeClass( 'opened' );
			_li.find( '.opened' ).removeClass( 'opened' );
			_li.find( '.sub-menu' ).stop().slideUp();
		} else {
			_li.addClass( 'opened' );
			_li.children( '.sub-menu' ).stop().slideDown();
		}
	} );
}

function initOffCanvasMenu() {
	var menu = $( '#off-canvas-menu-primary' );
	var _lv1 = menu.children( 'li' );

	$( '#page-open-main-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.addClass( 'page-off-canvas-menu-opened' );
	} );

	$( '#page-close-main-menu' ).on( 'click', function( e ) {
		e.preventDefault();

		menu.fadeOut( function() {
			$body.removeClass( 'page-off-canvas-menu-opened' );
			menu.fadeIn();
			menu.find( '.sub-menu' ).slideUp();
		} );
	} );

	var transDelay = 0.1;
	_lv1.each( function() {
		$( this )[ 0 ].setAttribute( 'style', '-webkit-transition-delay:' + transDelay + 's; -moz-transition-delay:' + transDelay + 's; -ms-transition-delay:' + transDelay + 's; -o-transition-delay:' + transDelay + 's; transition-delay:' + transDelay + 's' );
		transDelay += 0.1;
	} );

	menu.on( 'click', '.menu-item-has-children > a, .page_item_has_children > a', function( e ) {
		e.preventDefault();
		e.stopPropagation();

		var _li = $( this ).parent( 'li' );
		var _friends = _li.siblings( '.opened' );
		_friends.removeClass( 'opened' );
		_friends.find( '.opened' ).removeClass( 'opened' );
		_friends.find( '.sub-menu, .children' ).stop().slideUp();

		if ( _li.hasClass( 'opened' ) ) {
			_li.removeClass( 'opened' );
			_li.find( '.opened' ).removeClass( 'opened' );
			_li.find( '.sub-menu, .children' ).stop().slideUp();
		} else {
			_li.addClass( 'opened' );
			_li.children( '.sub-menu, .children' ).stop().slideDown();
		}
	} );
}

function initStickyHeader() {
	var $headerHolder = $pageHeader.children( '.page-header-place-holder' );
	if ( $insight.header_sticky_enable == 1 && $pageHeader.length > 0 && $headerInner.data( 'sticky' ) == '1' ) {
		if ( $headerInner.data( 'header-position' ) != 'left' ) {
			var _hOffset = $headerInner.offset().top;

			// Fix offset top return negative value on some devices.
			if ( _hOffset < 0 ) {
				_hOffset = 0;
			}

			var _hHeight = $headerInner.outerHeight();
			var offset = _hOffset + _hHeight + 100;

			if ( ! $pageHeader.hasClass( 'header-layout-fixed' ) ) {
				var _hHeight = $headerInner.outerHeight();

				$headerHolder.height( _hHeight );
				$headerInner.addClass( 'held' );
			}

			$pageHeader.headroom( {
				offset: offset,
				onTop: function() {
					if ( ! $pageHeader.hasClass( 'header-layout-fixed' ) ) {

						setTimeout( function() {
							var _hHeight = $headerInner.outerHeight();

							$headerHolder.height( _hHeight );
						}, 300 );
					}
				},
			} );
		} else {
			if ( wWidth <= $insight.mobile_menu_breakpoint ) {
				if ( ! $pageHeader.data( 'headroom' ) ) {
					var _hOffset = $headerInner.offset().top;

					// Fix offset top return negative value on some devices.
					if ( _hOffset < 0 ) {
						_hOffset = 0;
					}

					var _hHeight = $headerInner.outerHeight();
					var offset = _hOffset + _hHeight + 100;

					$pageHeader.headroom( {
						offset: offset
					} );
				}
			} else {
				if ( $pageHeader.data( 'headroom' ) ) {
					$pageHeader.data( 'headroom' ).destroy();
					$pageHeader.removeData( 'headroom' );
				}
			}
		}
	}
}

function openSearchPopup() {
	$body.addClass( 'page-search-popup-opened' );

	$html.css( {
		'overflow': 'hidden'
	} );

	/*var popupSearch = $( '#page-search-popup' );
	var searchField = popupSearch.find( '.search-field' );

	setTimeout( function() {
		searchField.focus();
	}, 500 );*/
}

function closeSearchPopup() {
	$body.removeClass( 'page-search-popup-opened' );

	$html.css( {
		'overflow': ''
	} );
}

function initSearchPopup() {
	$( '#btn-open-popup-search' ).on( 'click', function( e ) {
		e.preventDefault();
		openSearchPopup();
	} );

	$( '#search-popup-close' ).on( 'click', function( e ) {
		e.preventDefault();
		closeSearchPopup();
	} );
}

function openOffSidebar() {
	$body.addClass( 'page-off-sidebar-opened' );
}

function closeOffSidebar() {
	$body.removeClass( 'page-off-sidebar-opened' );
}

function initOffSidebar() {
	$( '#page-open-off-sidebar' ).on( 'click', function( e ) {
		e.preventDefault();
		openOffSidebar();
	} );

	$( '#page-close-off-sidebar' ).on( 'click', function( e ) {
		e.preventDefault();
		closeOffSidebar();
	} );

	var offSidebar = $( '#page-off-sidebar' );

	offSidebar.on( 'click', function( e ) {
		if ( e.target !== this ) {
			return;
		}

		closeOffSidebar();
	} );
}

function initHeaderRightMoreTools() {
	$( '#header-right-more' ).on( 'click', function() {
		$body.toggleClass( 'header-more-tools-opened' );
	} );


	$( document ).on( 'click', function( evt ) {
		if ( evt.target.id === 'page-header-inner' ) {
			return;
		}

		if ( $( evt.target ).closest( '#page-header-inner' ).length ) {
			return;
		}

		$body.removeClass( 'header-more-tools-opened' );
	} );
}

function calculateLeftHeaderSize() {
	if ( $headerInner.data( 'header-position' ) != 'left' ) {
		return;
	}

	var _wWidth = window.innerWidth;
	var _containerWidth = parseInt( $body.data( 'site-width' ) );
	var $footer = $( '#page-footer-wrapper' );

	if ( _wWidth <= $insight.mobile_menu_breakpoint ) {
		$html.css( {
			marginLeft: 0
		} );

		if ( $footer.hasClass( 'parallax' ) || $footer.hasClass( 'fixed' ) || $footer.hasClass( 'overlay' ) ) {
			$footer.css( {
				left: 0
			} );
		}
	} else {
		var headerWidth = $headerInner.outerWidth();
		$html.css( {
			marginLeft: headerWidth + 'px'
		} );

		if ( $footer.hasClass( 'parallax' ) || $footer.hasClass( 'fixed' ) || $footer.hasClass( 'overlay' ) ) {
			$footer.css( {
				left: headerWidth + 'px'
			} );
		}

		var rows = $( '#page-main-content' ).find( '.vc_row, .vc_section' );
		var footerRows = $footer.find( '.page-footer-inner' ).first().find( '.vc_row, .vc_section' );
		rows = rows.add( footerRows );

		var $contentWidth = $( '#page' ).width();
		rows.each( function() {
			if ( $( this ).attr( 'data-vc-full-width' ) ) {
				var left = 0;

				if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
					left = - (
						(
							$contentWidth - _containerWidth
						) / 2
					) + 'px';
				}
				var width = $contentWidth + 'px';
				$( this ).css( {
					left: left,
					width: width
				} );

				var stretch = $( this ).attr( 'data-vc-stretch-content' );
				if ( typeof stretch === typeof undefined || stretch === false ) {
					var _padding = 0;
					if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
						_padding = (
							(
								$contentWidth - _containerWidth
							) / 2
						);
					}
					$( this ).css( {
						paddingLeft: _padding,
						paddingRight: _padding
					} );
				}
			}
		} );
	}
}

function boxedFixVcRow() {
	if ( ! $body.hasClass( 'boxed' ) ) {
		return;
	}

	if ( wWidth < 1200 ) {
		return;
	}

	var siteWidth    = $pageWrapper.outerWidth(),
	    contentWidth = $body.data( 'content-width' ),
	    space        = (
		                   siteWidth - contentWidth
	                   ) / 2;

	var breakpoint = Math.min( siteWidth, contentWidth );

	$pageWrapper.find( '[data-vc-full-width=true]' ).each( function() {
		$( this ).css( {
			left: - space,
			width: siteWidth + 'px'
		} );

		if ( $( this ).data( 'vc-stretch-content' ) != true ) {
			$( this ).css( {
				paddingLeft: space,
				paddingRight: space
			} );
		}
	} );
}

function reCalculateVcRowFullHeight() {
	var fullHeight = window.innerHeight,
	    fullHeightCal,
	    offset     = 0,
	    $adminBar  = $( '#wpadminbar' ),
	    $vcRows    = $( '.vc_row-o-full-height' );

	if ( $adminBar.length ) {
		offset += $adminBar.outerHeight();
	}

	$headerInner = $pageHeader.children( '.page-header-inner' );

	if ( ! $pageHeader.hasClass( 'header-layout-fixed' ) &&
	     (
		     $body.hasClass( 'handheld' ) || $headerInner.data( 'header-position' ) === undefined
	     ) ) {
		var hHeight = $headerInner.outerHeight();

		offset += hHeight;
	}

	fullHeightCal = fullHeight - offset;

	$vcRows.each( function() {
		if ( $( this ).hasClass( 'calculated-height' ) ) {
			$vcRows.css( 'min-height', fullHeightCal + 'px' );
		} else {
			$vcRows.css( 'min-height', fullHeight + 'px' );
		}
	} );

	$( document ).trigger( 'vc-full-height-row', $vcRows );
}

function handlerEntryPostShare() {
	$( '.post-share' ).each( function() {
		var self = $( this );
		var $toggle = self.find( '.share-icon' );

		$toggle.on( 'click', function() {
			self.toggleClass( 'opened' );
		} );

		$( document ).on( 'click', function( e ) {
			if ( $( e.target ).closest( $toggle ).length == 0 ) {
				self.removeClass( 'opened' );
			}
		} );
	} );

}

function initCookieNotice() {
	if ( $insight.noticeCookieEnable == 1 && $insight.noticeCookieConfirm != 'yes' && $insight.noticeCookieMessages != '' ) {

		$.growl( {
			location: 'br',
			fixed: true,
			duration: 3600000,
			size: 'large',
			title: '',
			message: $insight.noticeCookieMessages
		} );

		$( '#tm-button-cookie-notice-ok' ).on( 'click', function() {
			$( this ).parents( '.growl-message' ).first().siblings( '.growl-close' ).trigger( 'click' );

			var _data = {
				action: 'notice_cookie_confirm'
			};

			_data = $.param( _data );

			$.ajax( {
				url: $insight.ajaxurl,
				type: 'POST',
				data: _data,
				dataType: 'json',
				success: function( results ) {

				},
				error: function( errorThrown ) {
					console.log( errorThrown );
				}
			} );
		} );
	}
}

function initNewsletterPopup() {
	if ( $insight.isShowNewsletterPopup != '1' ) {
		return false;
	}

	$( window ).on( 'load', function() {
		$body.addClass( 'newsletter-popup-opened' );
	} );

	$( '#newsletter-popup-close' ).on( 'click', function() {
		$( document ).trigger( 'newsletterPopupClose' );
	} );

	var newsletterPopup = $( '#newsletter-popup' );

	newsletterPopup.on( 'click', function( e ) {
		if ( e.target !== this ) {
			return;
		}

		$( document ).trigger( 'newsletterPopupClose' );
	} );

	$( document ).on( 'newsletterPopupClose', function() {
		$body.removeClass( 'newsletter-popup-opened' );

		var data = {
			action: 'newsletter_popup_confirm'
		};

		data = $.param( data );

		$.ajax( {
			url: $insight.ajaxurl,
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function( results ) {

			},
			error: function( errorThrown ) {
				console.log( errorThrown );
			}
		} );
	} );
}

function initLazyLoaderImages() {
	var llImages = $( '.ll-image' );

	handlerLazyLoaderImages( llImages );
}

function handlerLazyLoaderImages( images ) {
	images.laziestloader( {}, function() {
		$( this ).removeClass( 'unload' );
	} );
}
