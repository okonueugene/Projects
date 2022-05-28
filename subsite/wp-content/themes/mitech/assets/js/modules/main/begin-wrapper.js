(
	function( $ ) {
		'use strict';

		$.fn.insightSwiper = function() {
			var $swiper;

			this.each( function() {

				var $slider = $( this );
				var $sliderInner = $slider.children( '.swiper-inner' ).first();
				var _settings = $slider.data();

				if ( _settings.queueInit == '0' ) {
					return;
				}

				var $sliderContainer = $sliderInner.children( '.swiper-container' ).first(),
				    lgItems          = _settings.lgItems ? _settings.lgItems : 1,
				    mdItems          = _settings.mdItems ? _settings.mdItems : lgItems,
				    smItems          = _settings.smItems ? _settings.smItems : mdItems,
				    xsItems          = _settings.xsItems ? _settings.xsItems : smItems,
				    lgGutter         = _settings.lgGutter ? _settings.lgGutter : 0,
				    mdGutter         = _settings.mdGutter ? _settings.mdGutter : lgGutter,
				    smGutter         = _settings.smGutter ? _settings.smGutter : mdGutter,
				    xsGutter         = _settings.xsGutter ? _settings.xsGutter : smGutter,
				    speed            = _settings.speed ? _settings.speed : 1000;

				if ( _settings.slideWrap ) {
					$sliderInner.children( '.swiper-container' )
					            .children( '.swiper-wrapper' )
					            .children( 'div' )
					            .wrap( "<div class='swiper-slide'><div class='swiper-slide-inner'></div></div>" );
				}

				if ( lgItems == 'auto' ) {
					var _options = {
						slidesPerView: 'auto',
						spaceBetween: lgGutter,
						breakpoints: {
							// when window width is >=
							767: {
								spaceBetween: smGutter
							},
							990: {
								spaceBetween: mdGutter
							},
							1199: {
								spaceBetween: lgGutter
							}
						}
					};
				} else {
					var _options = {
						slidesPerView: xsItems, //slidesPerGroup: lgItems,
						spaceBetween: xsGutter,
						breakpoints: {
							// when window width is <=
							767: {
								slidesPerView: smItems,
								spaceBetween: smGutter
							},
							990: {
								slidesPerView: mdItems,
								spaceBetween: mdGutter
							},
							1199: {
								slidesPerView: lgItems,
								spaceBetween: lgGutter
							}
						}
					};

					if ( _settings.slidesPerGroup == 'inherit' ) {
						_options.slidesPerGroup = xsItems;

						_options.breakpoints[ 767 ].slidesPerGroup = smItems;
						_options.breakpoints[ 990 ].slidesPerGroup = mdItems;
						_options.breakpoints[ 1199 ].slidesPerGroup = lgItems;
					}
				}

				_options.el = $sliderContainer;
				_options.init = false;

				_options.watchOverflow = true;

				if ( _settings.slideColumns ) {
					_options.slidesPerColumn = _settings.slideColumns;
				}

				if ( _settings.initialSlide ) {
					_options.initialSlide = _settings.initialSlide;
				}

				if ( _settings.autoHeight ) {
					_options.autoHeight = true;
				}

				if ( speed ) {
					_options.speed = speed;
				}

				// Maybe: fade, flip
				if ( _settings.effect ) {
					_options.effect = _settings.effect;
					/*_options.fadeEffect = {
						crossFade: true
					};*/
				}

				if ( _settings.loop ) {
					_options.loop = true;
				}

				if ( _settings.centered ) {
					_options.centeredSlides = true;
				}

				if ( _settings.autoplay ) {
					_options.autoplay = {
						delay: _settings.autoplay,
						disableOnInteraction: false
					};
				}

				if ( _settings.freemode ) {
					_options.freeMode = true;
				}

				var $wrapTools;

				if ( _settings.wrapTools ) {
					$wrapTools = $( '<div class="swiper-tools"></div>' );

					$slider.append( $wrapTools );
				}

				if ( _settings.nav ) {

					if ( _settings.customNav && _settings.customNav !== '' ) {
						var $customBtn = $( '#' + _settings.customNav );
						var $swiperPrev = $customBtn.find( '.slider-prev-btn' );
						var $swiperNext = $customBtn.find( '.slider-next-btn' );
					} else {
						var $swiperPrev = $( '<div class="swiper-nav-button swiper-button-prev"><i class="nav-button-icon"></i></div>' );
						var $swiperNext = $( '<div class="swiper-nav-button swiper-button-next"><i class="nav-button-icon"></i></div>' );

						var $swiperNavButtons = $( '<div class="swiper-nav-buttons"></div>' );
						$swiperNavButtons.append( $swiperPrev ).append( $swiperNext );

						if ( $wrapTools ) {
							$wrapTools.append( $swiperNavButtons );
						} else {
							$sliderInner.append( $swiperNavButtons );
						}
					}

					_options.navigation = {
						nextEl: $swiperNext,
						prevEl: $swiperPrev
					};
				}

				if ( _settings.pagination ) {
					var $swiperPagination = $( '<div class="swiper-pagination"></div>' );

					if ( $wrapTools ) {
						$wrapTools.append( $swiperPagination );
					} else {
						$slider.append( $swiperPagination );
					}

					_options.pagination = {
						el: $swiperPagination,
						clickable: true
					};
				}

				if ( _settings.scrollbar ) {
					var $scrollbar = $( '<div class="swiper-scrollbar"></div>' );
					$sliderContainer.prepend( $scrollbar );

					_options.scrollbar = {
						el: $scrollbar,
						draggable: true,
					};

					_options.loop = false;
				}

				if ( _settings.mousewheel ) {
					_options.mousewheel = {
						enabled: true
					};
				}

				if ( _settings.vertical ) {
					_options.direction = 'vertical'
				}

				$swiper = new Swiper( _options );

				if ( _settings.reinitOnResize ) {
					var _timer;
					$( window ).resize( function() {
						clearTimeout( _timer );

						_timer = setTimeout( function() {
							$swiper.destroy( true, true );

							$swiper = new Swiper( $sliderContainer, _options );
						}, 300 );
					} );
				}

				// Disabled auto play when focus.
				if ( _settings.autoplay ) {
					$sliderContainer.hoverIntent( function() {
						$swiper.autoplay.stop();
					}, function() {
						$swiper.autoplay.start();
					} );
				}

				$swiper.on( 'slideChange', function() {
					update_lazy_images( $slider );
				} );

				$swiper.on( 'init', function() {
					update_lazy_images( $slider );
				} );

				$swiper.init();

				$( document ).trigger( 'insightSwiperInit', [ $swiper, $slider, _options ] );
			} );

			return $swiper;
		};

		function update_lazy_images( $slider ) {
			var llImages = $slider.find( '.ll-notloaded' );

			if ( llImages.length > 0 ) {
				llImages.each( function( index, img ) {

					//$( img ).trigger( 'laziestloader' );

					$( img ).laziestloader().removeClass( 'unload' );
				} );
			}
		}
	}( jQuery )
);

(
	function( $ ) {
		'use strict';
