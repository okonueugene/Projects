(
	function( $ ) {
		'use strict';

		$( window ).on( 'resize', function() {
			maintenanceFullHeight();
		} );

		$( document ).ready( function() {
			maintenanceFullHeight();
		} );

		function maintenanceFullHeight() {
			var page = $( '#maintenance-wrap' );
			var height = $( window ).height();
			var adminBar = $( '#wpadminbar' );
			if ( adminBar ) {
				height -= adminBar.outerHeight();
			}

			var $header = $( '#page-header' );
			var $footer = $( '#page-footer' )

			if ( ! $header.hasClass( 'header-layout-fixed' ) ) {
				height -= $header.outerHeight();
			}

			if ( $footer ) {
				height -= $footer.outerHeight();
			}

			page.css( {
				'minHeight': height
			} );
		}
	}( window.jQuery )
);
