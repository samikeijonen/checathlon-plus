/**
 * Live-update changed settings in real time in the Customizer preview.
 */

( function( $ ) {
	// Site header colors.
	wp.customize(
		'site-header-bg',
		function( value ) {
			value.bind(
				function( to ) {
					$( '.site-header, .main-navigation ul ul' ).css( 'background-color', to );
				}
			);
		}
	);

	wp.customize(
		'main-navigation-link',
		function( value ) {
			value.bind(
				function( to ) {
					$( '.main-navigation a, .menu-toggle, .menu-toggle:hover, .menu-toggle:focus, .menu-toggle:active' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'main-navigation-hover',
		function( value ) {
			value.bind(
				function( to ) {
					$( '.main-navigation a:hover, .main-navigation a:focus, .main-navigation a:active, .main-navigation .current-menu-item > a, .main-navigation .current-menu-ancestor > a' ).css( 'color', to );
				}
			);
		}
	);

	// Content colors.
	wp.customize(
		'main-color',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'body, button, input, select, textarea' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'headings-color',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'h1, h2, h3, h4, h5, h6' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'highlight-color',
		function( value ) {
			value.bind(
				function( to ) {
					$( '.highlight-color, .jetpack-testimonial .entry-inner .icon, .before-footer-widgets-wrapper .icon, .checathlon_widget_pricing .icon, .page-template-team-page .entry-title a:hover, .page-template-team-page .entry-title a:focus, .page-template-team-page .entry-title a:active' ).css( 'color', to );
					$( '.archive-description:before' ).css( 'border-bottom-color', to );
				}
			);
		}
	);

	wp.customize(
		'content-link-color',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'a, a:visited' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'content-link-hover',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'a:hover, a:focus, a:active' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'soft-color',
		function( value ) {
			value.bind(
				function( to ) {
					$( '.soft-color, .soft-color, .single .byline, .comment-metadata a, .post-navigation .post-title, .job-title, .edd_cart_header_row, .edd_cart_subtotal, .edd_cart_discount, .edd_cart_tax, .edd-description, .entry-inner-wrapper .checathlon-widget-pricing-entry-content, .entry-header-bg-link > .icon, .entry-terms > a, .widget_tag_cloud a, .widget_tag_cloud a:visited' ).css( 'color', to );
				}
			);
		}
	);

	// Button colors.
	wp.customize(
		'button-bg',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'button, input[type="button"], input[type="reset"], input[type="submit"], a.button, a.button:visited' ).css( 'background-color', to );
				}
			);
		}
	);

	wp.customize(
		'button-color',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'button, input[type="button"], input[type="reset"], input[type="submit"], a.button, a.button:visited' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'button-bg-hover',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, a.button:hover' ).css( 'background-color', to );
				}
			);
		}
	);

	wp.customize(
		'button-color-hover',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, a.button:hover' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'sec-button-bg',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'a.button-secondary, a.button-secondary:visited, a.edd-cart-saving-button, a.edd-cart-saving-button:visited, .edd-download-info .button.edd-demo-link, .edd-download-info .button.edd-demo-link:visited, body .wp-core-ui .quicktags-toolbar input.button.button-small' ).css( 'background-color', to );
				}
			);
		}
	);

	wp.customize(
		'sec-button-color',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'a.button-secondary, a.button-secondary:visited, a.edd-cart-saving-button, a.edd-cart-saving-button:visited, .edd-download-info .button.edd-demo-link, .edd-download-info .button.edd-demo-link:visited, body .wp-core-ui .quicktags-toolbar input.button.button-small' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'sec-button-bg-hover',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'a.button-secondary:hover, a.edd-cart-saving-button:hover, .edd-download-info .button.edd-demo-link:hover, body .wp-core-ui .quicktags-toolbar input.button.button-small:hover' ).css( 'background-color', to );
				}
			);
		}
	);

	wp.customize(
		'sec-button-bg-hover',
		function( value ) {
			value.bind(
				function( to ) {
					$( 'a.button-secondary:hover, a.edd-cart-saving-button:hover, .edd-download-info .button.edd-demo-link:hover, body .wp-core-ui .quicktags-toolbar input.button.button-small:hover' ).css( 'color', to );
				}
			);
		}
	);

	// Footer colors.
	wp.customize(
		'footer-bg',
		function( value ) {
			value.bind(
				function( to ) {
					$( '.footer-widgets-wrapper' ).css( 'background-color', to );
				}
			);
		}
	);

	wp.customize(
		'footer-text',
		function( value ) {
			value.bind(
				function( to ) {
					$( '.footer-widgets-wrapper' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'footer-link',
		function( value ) {
			value.bind(
				function( to ) {
					$( '.footer-widgets-wrapper .widget a, .footer-widgets-wrapper .widget a:visited' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'footer-link-hover',
		function( value ) {
			value.bind(
				function( to ) {
					$( '.footer-widgets-wrapper .widget a:hover, .footer-widgets-wrapper .widget a:focus, .footer-widgets-wrapper .widget a:active' ).css( 'color', to );
				}
			);
		}
	);

	wp.customize(
		'footer-widget-color',
		function( value ) {
			value.bind(
				function( to ) {
					$( '.footer-widgets-wrapper .widget-title, .site-title-footer' ).css( 'color', to );
				}
			);
		}
	);
} )( jQuery );
