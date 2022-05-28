initMiniCart();
initQuantityButtons();
initProductImagesSlider();
initQuickViewPopup();
shopLayoutSwitcher();

function initMiniCart() {
	var $miniCart = $( '#mini-cart' );
	$miniCart.on( 'click', function() {
		if ( $body.hasClass( 'desktop' ) ) {
			$( this ).addClass( 'open' );
		} else {
			window.location.href = $( this ).data( 'url' );
		}
	} );

	$( document ).on( 'click', function( e ) {
		if ( $( e.target ).closest( $miniCart ).length == 0 ) {
			$miniCart.removeClass( 'open' );
		}
	} );
}

function initQuantityButtons() {
	$( document ).on( 'click', '.increase, .decrease', function() {

		// Get values
		var $qty       = $( this ).siblings( '.qty' ),
		    currentVal = parseFloat( $qty.val() ),
		    max        = parseFloat( $qty.attr( 'max' ) ),
		    min        = parseFloat( $qty.attr( 'min' ) ),
		    step       = $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) {
			currentVal = 0;
		}
		if ( max === '' || max === 'NaN' ) {
			max = '';
		}
		if ( min === '' || min === 'NaN' ) {
			min = 0;
		}
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) {
			step = 1;
		}

		// Change the value
		if ( $( this ).is( '.increase' ) ) {

			if ( max && (
				max == currentVal || currentVal > max
			) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && (
				min == currentVal || currentVal < min
			) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event.
		$qty.trigger( 'change' );
	} );
}

function initProductImagesSlider() {
	if ( $insight.isProduct === '1' ) {
		var $sliderWrap = $( '#woo-single-gallery' );

		var $slider = $sliderWrap.children( 'ul' ).lightSlider( {
			item: 1,
			thumbItem: 4,
			slideMargin: 30,
			enableDrag: false,
			adaptiveHeight: true,
			gallery: true,
			galleryMargin: 30,
			thumbMargin: 30,

			onSliderLoad: function( el ) {
				$sliderWrap.removeClass( 'cS-hidden' );

				el.lightGallery( {
					selector: '#woo-single-gallery .lslide'
				} );
			}
		} );

		var $form = $( '.variations_form' );
		var variations = $form.data( 'product_variations' );

		$form.find( 'select' ).on( 'change', function() {
			var test = true;
			var globalAttrs = {};

			var formValues = $form.serializeArray();

			for ( var i = 0; i < formValues.length; i ++ ) {

				var _name = formValues[ i ].name;
				if ( _name.substring( 0, 10 ) === 'attribute_' ) {

					globalAttrs[ _name ] = formValues[ i ].value;

					if ( formValues[ i ].value === '' ) {
						test = false;

						break;
					}
				}
			}

			if ( test === true ) {
				globalAttrs = JSON.stringify( globalAttrs );

				for ( var i = variations.length - 1; i >= 0; i -- ) {
					var attributes = variations[ i ].attributes;
					var loopAttributes = JSON.stringify( attributes );

					if ( loopAttributes == globalAttrs ) {
						var url = variations[ i ].image.url;

						$slider.find( 'li' ).each( function( index ) {
							var fullImage = $( this ).attr( 'data-src' );

							if ( fullImage === url ) {
								$slider.goToSlide( index );

								return false;
							}
						} );
					}
				}
			} else {
				// Reset to main image.
				var $mainImage = $slider.find( '.product-main-image' );
				var index = $mainImage.index();
				$slider.goToSlide( index );
			}
		} );
	}
}

function initQuickViewPopup() {
	$( '.quick-view-btn' ).each( function() {
		var $popup = $( this ).siblings( '.woo-quick-view-popup' )

		$( this ).magnificPopup( {
			items: {
				src: $popup.html(),
				type: 'inline',
			},
			callbacks: {
				open: function() {
					$( '.woo-quick-view-popup-content .entry-summary .inner-content' ).perfectScrollbar( {
						suppressScrollX: true
					} );

					var $sliderWrap = $( '.woo-quick-view-popup-content #woo-single-gallery' );

					var $slider = $sliderWrap.children( 'ul' ).lightSlider( {
						item: 1,
						thumbItem: 4,
						slideMargin: 30,
						adaptiveHeight: true,

						onSliderLoad: function( el ) {
							$sliderWrap.removeClass( 'cS-hidden' );
						}
					} );
				},
			}
		} );
	} );
}

function shopLayoutSwitcher() {
	$( '#shop-style-switcher' ).on( 'click', '.switcher-item', function() {

		if ( $( this ).hasClass( 'active' ) ) {
			return;
		}

		var data = {
			action: 'shop_style_change'
		};

		if ( $( this ).hasClass( 'list' ) ) {
			data.shop_style = 'list';
		} else {
			data.shop_style = 'grid';
		}

		data = $.param( data );

		$.ajax( {
			url: $insight.ajaxurl,
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function() {
				location.reload();
			},
			error: function( errorThrown ) {
				console.log( errorThrown );
			}
		} );
	} );
}
