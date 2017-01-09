<?php
/**
 * Custom Colors Module.
**/

/* === VARS === */

/**
 * Colors Config Defined By Theme.
 **/
function checathlon_plus_colors_config(){
	$theme_support = get_theme_support( 'checathlon-plus-custom-colors' );
	$colors_config = array();

	// Get theme config for colors.
	if ( isset( $theme_support[0] ) ) {
		$colors_config = $theme_support[0];
	}

	return $colors_config;
}

/**
 * Colors Settings.
 **/
function checathlon_plus_colors_settings() {
	$theme_support   = get_theme_support( 'checathlon-plus-custom-colors' );
	$colors_settings = array();

	// Get theme config for colors settings.
	if ( isset( $theme_support[1] ) ) {
		$colors_settings = $theme_support[1];
	}

	return $colors_settings;
}

/**
 * Get priority for the Customizer.
 **/
function checathlon_plus_colors_priority() {
	$priority = 11;

	// Get priority from the settings.
	$settings = checathlon_plus_colors_settings();
	if ( isset( $settings['priority'] ) ) {
		$priority = $settings['priority'];
	}

	return apply_filters( 'checathlon_plus_theme_default_colors_priority', $priority );
}

/**
 * Colors Customizer Label.
 **/
function checathlon_plus_colors_label() {
	// Default label.
	$defaults = array(
		'colors' => esc_html_x( 'Theme Colors', 'customizer', 'checathlon-plus' ),
	);

	// Label from the settings.
	$theme_support = get_theme_support( 'checathlon-plus-custom-colors' );
	$args = isset( $theme_support[2] ) ? $theme_support[2] : array();

	return wp_parse_args( $args, $defaults );
}

/* === CUSTOMIZER === */

require_once( $this->dir_path . 'inc/custom-colors/customizer.php' );

/* === IMPLEMENTATION === */

/**
 * Enqueues front-end CSS from the Customizer color settings.
 *
 * @since 1.0.0
 * @see   wp_add_inline_style()
 */
function checathlon_plus_colors_print_style() {
	// CSS.
	$css = '';

	// Config.
	$config = checathlon_plus_colors_config();

	// Loop settings.
	foreach( $config as $section => $section_data ) {

		// Loop styles.
		foreach( $section_data['styles'] as $section_color => $default_color ) {

			// Get colors saved.
			$color = get_theme_mod( $section_color, $default_color );

			// Only add color if it's not the default. Theme already loads default colors.
			if ( $color && $color !== $default_color ) {
				// Site header colors.
				if ( 'site-header-bg' === $section_color ) {
					$css .= "
						.site-header {
							background-color: {$color};
						}";

					$css .= "
						@media screen and (min-width: 62.875em) {
							.main-navigation ul ul {
								background-color: {$color};
							}
						}";
				}

				if ( 'main-navigation-link' === $section_color ) {
					$css .= "
						@media screen and (min-width: 62.875em) {
							.main-navigation a,
							.main-navigation a:visited {
								color: {$color};
							}
						}";

					$css .= "
						.menu-toggle,
						.menu-toggle:hover,
						.menu-toggle:focus,
						.menu-toggle:active {
							color: {$color};
						}";
				}

				if ( 'main-navigation-hover' === $section_color ) {
					$css .= "
						@media screen and (min-width: 62.875em) {
							.main-navigation a:hover,
							.main-navigation a:focus,
							.main-navigation a:active,
							.main-navigation .current-menu-item > a,
							.main-navigation .current-menu-ancestor > a {
								color: {$color};
							}
						}";
				}

				if ( 'mobile-navigation-bg' === $section_color ) {
					$css .= "
						@media screen and (max-width: 62.874em) {
							.main-navigation {
								background-color: {$color};
							}
						}";
				}

				if ( 'mobile-navigation-link' === $section_color ) {
					$css .= "
						@media screen and (max-width: 62.874em) {
							.main-navigation a,
							.main-navigation a:visited {
								color: {$color};
							}
						}";
				}

				if ( 'mobile-navigation-hover' === $section_color ) {
					$css .= "
						@media screen and (max-width: 62.874em) {
							.main-navigation a:hover,
							.main-navigation a:focus,
							.main-navigation a:active,
							.main-navigation .current-menu-item > a,
							.main-navigation .current-menu-ancestor > a {
								color: {$color};
							}
						}";
				}

				// Content colors.
				if ( 'main-color' === $section_color ) {
					$css .= "
						body,
						button,
						input,
						select,
						textarea {
							color: {$color};
						}";
				}

				if ( 'headings-color' === $section_color ) {
					$css .= "
						h1,
						h2,
						h3,
						h4,
						h5,
						h6 {
							color: {$color};
						}";
				}

				if ( 'highlight-color' === $section_color ) {
					$css .= "
						.highlight-color,
						.jetpack-testimonial .entry-inner .icon,
						.before-footer-widgets-wrapper .icon,
						.checathlon_widget_pricing .icon,
						.page-template-team-page .entry-title a:hover,
						.page-template-team-page .entry-title a:focus,
						.page-template-team-page .entry-title a:active {
							color: {$color};
						}";

						$css .= "
							.archive-description:before {
								border-bottom-color: {$color};
							}
						";
				}

				if ( 'content-link-color' === $section_color ) {
					$css .= "
						a,
						a:visited {
							color: {$color};
						}";
				}

				if ( 'content-link-hover' === $section_color ) {
					$css .= "
						a:hover,
						a:focus,
						a:active {
							color: {$color};
						}";
				}

				if ( 'soft-color' === $section_color ) {
					$css .= "
						.soft-color,
						.soft-color,
						.single .byline,
						.comment-metadata a,
						.post-navigation .post-title,
						.job-title,
						.edd_cart_header_row,
						.edd_cart_subtotal,
						.edd_cart_discount,
						.edd_cart_tax,
						.edd-description,
						.entry-inner-wrapper .checathlon-widget-pricing-entry-content,
						.entry-header-bg-link > .icon,
						.entry-terms > a,
						.widget_tag_cloud a,
						.widget_tag_cloud a:visited {
							color: {$color};
						}";
				}

				// Button colors.
				if ( 'button-bg' === $section_color ) {
					$css .= '
						button,
						input[type="button"],
						input[type="reset"],
						input[type="submit"],
						a.button,
						a.button:visited {
							background-color:' . $color . ';
						}';
				}

				if ( 'button-color' === $section_color ) {
					$css .= '
						button,
						input[type="button"],
						input[type="submit"],
						input[type="reset"],
						a.button,
						a.button:visited {
							color:' . $color . ';
						}';
				}

				if ( 'button-bg-hover' === $section_color ) {
					$css .= '
						button:hover,
						input[type="button"]:hover,
						input[type="submit"]:hover,
						input[type="reset"]:hover,
						a.button:hover,
						button:focus,
						input[type="button"]:focus,
						input[type="reset"]:focus,
						input[type="submit"]:focus,
						a.button:focus,
						button:active,
						input[type="button"]:active,
						input[type="reset"]:active,
						input[type="submit"]:active,
						a.button:active {
							background-color:' . $color . ';
						}';
				}

				if ( 'button-color-hover' === $section_color ) {
					$css .= '
						button:hover,
						input[type="button"]:hover,
						input[type="reset"]:hover,
						input[type="submit"]:hover,
						a.button:hover,
						button:focus,
						input[type="button"]:focus,
						input[type="reset"]:focus,
						input[type="submit"]:focus,
						a.button:focus,
						button:active,
						input[type="button"]:active,
						input[type="reset"]:active,
						input[type="submit"]:active,
						a.button:active {
							color:' . $color . ';
						}';
				}

				if ( 'sec-button-bg' === $section_color ) {
					$css .= "
						a.button-secondary,
						a.button-secondary:visited,
						a.edd-cart-saving-button,
						a.edd-cart-saving-button:visited,
						.edd-download-info .button.edd-demo-link,
						.edd-download-info .button.edd-demo-link:visited,
						body .wp-core-ui .quicktags-toolbar input.button.button-small {
							background-color: {$color};
						}";
				}

				if ( 'sec-button-color' === $section_color ) {
					$css .= "
						a.button-secondary,
						a.button-secondary:visited,
						a.edd-cart-saving-button,
						a.edd-cart-saving-button:visited,
						.edd-download-info .button.edd-demo-link,
						.edd-download-info .button.edd-demo-link:visited,
						body .wp-core-ui .quicktags-toolbar input.button.button-small {
							color: {$color};
						}";
				}

				if ( 'sec-button-bg-hover' === $section_color ) {
					$css .= "
						a.button-secondary:hover,
						a.button-secondary:focus,
						a.button-secondary:active,
						a.edd-cart-saving-button.button:hover,
						a.edd-cart-saving-button.button:focus,
						a.edd-cart-saving-button.button:active,
						.edd-download-info .button.edd-demo-link:hover,
						.edd-download-info .button.edd-demo-link:focus,
						.edd-download-info .button.edd-demo-link:active,
						body .wp-core-ui .quicktags-toolbar input.button.button-small:hover,
						body .wp-core-ui .quicktags-toolbar input.button.button-small:focus,
						body .wp-core-ui .quicktags-toolbar input.button.button-small:active {
							background-color: {$color};
						}";
				}

				if ( 'sec-button-color-hover' === $section_color ) {
					$css .= '
						a.button-secondary:hover,
						a.button-secondary:focus,
						a.button-secondary:active,
						a.edd-cart-saving-button.button:hover,
						a.edd-cart-saving-button.button:focus,
						a.edd-cart-saving-button.button:active,
						.edd-download-info .button.edd-demo-link:hover,
						.edd-download-info .button.edd-demo-link:focus,
						.edd-download-info .button.edd-demo-link:active,
						body .wp-core-ui .quicktags-toolbar input.button.button-small:hover,
						body .wp-core-ui .quicktags-toolbar input.button.button-small:focus,
						body .wp-core-ui .quicktags-toolbar input.button.button-small:active {
							color:' . $color . ';
						}';
				}

				// Footer colors.
				if ( 'footer-bg' === $section_color ) {
					$css .= '
						.footer-widgets-wrapper {
							background-color:' . $color .';
						}
					';
				}

				if ( 'footer-text' === $section_color ) {
					$css .= '
						.footer-widgets-wrapper {
							color:' . $color .';
						}
					';
				}

				if ( 'footer-link' === $section_color ) {
					$css .= '
						.footer-widgets-wrapper .widget a,
						.footer-widgets-wrapper .widget a:visited {
							color:' . $color .';
						}
					';
				}

				if ( 'footer-link-hover' === $section_color ) {
					$css .= '
						.footer-widgets-wrapper .widget a:hover,
						.footer-widgets-wrapper .widget a:focus,
						.footer-widgets-wrapper .widget a:active {
							color:' . $color .';
						}
					';
				}

				if ( 'footer-widget-color' === $section_color ) {
					$css .= '
						.footer-widgets-wrapper .widget-title,
						.site-title-footer {
							color:' . $color .';
						}
					';
				}
			}

		} // End foreach.

	} // End foreach.

	// Add inline styles.
	if ( ! empty( $css ) ) {
		wp_add_inline_style( 'checathlon-style', trim( $css ) );
	}
}
add_action( 'wp_enqueue_scripts', 'checathlon_plus_colors_print_style', 11 );
