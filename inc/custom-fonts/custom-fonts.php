<?php
/**
 * Custom Fonts Module.
**/

// Bail if there is no support for custom fonts.
if ( ! current_theme_supports( 'checathlon-plus-custom-fonts' ) ) {
	return;
}

/* === VARS === */

/**
 * Fonts Config Defined By Theme.
 **/
function checathlon_plus_fonts_config(){
	$theme_support = get_theme_support( 'checathlon-plus-custom-fonts' );
	$fonts_config  = array();

	// Get theme config for fonts.
	if ( isset( $theme_support[0] ) ) {
		$fonts_config = $theme_support[0];
	}

	return $fonts_config;
}

/**
 * Fonts Settings.
 **/
function checathlon_plus_fonts_settings() {
	$theme_support  = get_theme_support( 'checathlon-plus-custom-fonts' );
	$fonts_settings = array();

	// Get theme config for fonts settings.
	if ( isset( $theme_support[1] ) ){
		$fonts_settings = $theme_support[1];
	}

	return $fonts_settings;
}

/**
 * Font Subsets.
 **/
function checathlon_plus_fonts_subsets(){

	// Add latin and latin-extended as default subset.
	$subsets = array( 'latin', 'latin-ext' );

	// Add user defined subset.
	$settings = checathlon_plus_fonts_settings();
	if ( isset( $settings['font_subset'] ) ) {
		$subset = $settings['font_subset'];

		// Add subsets.
		if ( 'cyrillic' == $subset ) {
			$subsets[] = 'cyrillic';
			$subsets[] = 'cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets[] = 'greek';
			$subsets[] = 'greek-ext';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets[] = 'vietnamese';
		} elseif ( 'no-subset' != $subset ){
			/* do nothing. */
		} else {
			$subsets[] = $subset;
		}
	}

	// Sanitize.
	$subsets = array_map( 'sanitize_html_class', $subsets );

	return apply_filters( 'checathlon_plus_fonts_subsets', $subsets );
}

/**
 * Font Allowed Weight (+style)
 * Set to false to load all available weight/style.
 **/
function checathlon_plus_fonts_allowed_weight() {
	// Default weights.
	$weights = array(
		'400',
		'400i',
		'700',
		'700i',
	);

	// Get weights from the settings.
	$settings = checathlon_plus_fonts_settings();
	if ( isset( $settings['allowed_weight'] ) ) {
		$weights = $settings['allowed_weight'];
	}

	return apply_filters( 'checathlon_plus_fonts_allowed_weight', $weights );
}

/**
 * Get default fonts defined by theme.
 **/
function checathlon_plus_theme_default_fonts() {
	$default_fonts = array();

	// Get default fonts from the settings.
	$settings = checathlon_plus_fonts_settings();
	if ( isset( $settings['theme_default_fonts'] ) ) {
		$default_fonts = $settings['theme_default_fonts'];
	}

	return apply_filters( 'checathlon_plus_theme_default_fonts', $default_fonts );
}

/**
 * Get priority for the Customizer.
 **/
function checathlon_plus_fonts_priority() {
	$priority = 11;

	// Get priority from the settings.
	$settings = checathlon_plus_fonts_settings();
	if ( isset( $settings['priority'] ) ) {
		$priority = $settings['priority'];
	}

	return apply_filters( 'checathlon_plus_theme_default_fonts_priority', $priority );
}

/**
 * Fonts Customizer Label.
 **/
function checathlon_plus_fonts_label() {
	// Default label.
	$defaults = array(
		'fonts' => esc_html_x( 'Theme Fonts', 'customizer', 'checathlon-plus' ),
	);

	// Label from the settings.
	$theme_support = get_theme_support( 'checathlon-plus-custom-fonts' );
	$args = isset( $theme_support[2] ) ? $theme_support[2] : array();

	return wp_parse_args( $args, $defaults );
}

/* === FONTS AVAILABLE === */

require_once( $this->dir_path . 'inc/custom-fonts/fonts.php' );

/* === UTILITY === */

require_once( $this->dir_path . 'inc/custom-fonts/utility.php' );

/* === CUSTOMIZER === */

require_once( $this->dir_path . 'inc/custom-fonts/customizer.php' );

/* === IMPLEMENTATION === */

/**
 * Return Google Font URL containing all fonts used.
 **/
function checathlon_plus_fonts_all_google_url() {
	// Get fonts config.
	$config = checathlon_plus_fonts_config();

	// Vars: List of all fonts used.
	$fonts         = array();
	$fonts_subsets = array();
	$default_fonts = checathlon_plus_theme_default_fonts();

	// Loop settings data.
	foreach ( $config as $section => $section_data ) {

		// Get font saved and skip web safe fonts.
		$font = checathlon_plus_fonts_remove_websafe( get_theme_mod( $section, $section_data['default'] ) );

		// Skip theme default fonts. They are handled by theme.
		if ( ! empty( $font ) && ! in_array( $font, $default_fonts ) ) {
			$fonts[$font] = checathlon_plus_get_font_weight( $font );

			// Subsets.
			$get_font_subsets = checathlon_plus_get_font_subsets( $font );
			if ( ! empty( $get_font_subsets ) ) {
				foreach ( $get_font_subsets as $subset ) {
					$fonts_subsets[] = $subset;
				}
			}
		}

	}

	if ( ! empty( $fonts ) ) {

		// Get available subset.
		$subsets_settings = checathlon_plus_fonts_subsets();
		$subsets          = array_intersect( $subsets_settings, $fonts_subsets );

		// Return url.
		return checathlon_plus_google_fonts_url( $fonts, $subsets );
	}

	return '';
}

/**
 * Enqueue ( Google ) Fonts.
 **/
function checathlon_plus_fonts_enqueue_scripts() {
	$google_fonts_url = checathlon_plus_fonts_all_google_url();
	if ( ! empty( $google_fonts_url ) ) {
		wp_enqueue_style( 'checathlon-plus-custom-fonts', $google_fonts_url, array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'checathlon_plus_fonts_enqueue_scripts' );

/**
 * Print CSS to Modify Font
 */
function checathlon_plus_fonts_print_style(){
	// CSS.
	$css = '';

	// Config.
	$config = checathlon_plus_fonts_config();

	// Loop settings.
	foreach ( $config as $section => $section_data ) {

		// Get fonts saved.
		$font = get_theme_mod( $section, $section_data['default'] );

		// Only add if it's not the default. Theme already loads default fonts.
		if ( $font && $font !== $section_data['default'] ) {

			$target_element = $section_data['target'];
			$font_family    = checathlon_plus_get_font_family( $font );

			$css .= "{$target_element}{font-family:{$font_family};}";

		}

		// Get font weight.
		if ( isset( $section_data['font_weight'] ) && $section_data['font_weight'] ){
			$font_weight = get_theme_mod( $section . '_weight', esc_attr( $section_data['font_weight'] ) );

			$target_element = $section_data['target'];
			$css .= "{$target_element}{font-weight:{$font_weight};}";
		}

	}

	// Print CSS.
	if ( ! empty( $css ) ) {
		echo "\n" . '<style type="text/css" id="checathlon-plus-custom-fonts-rules-css">' . trim( wp_strip_all_tags( $css ) ) . '</style>' . "\n";
	}
}
add_action( 'wp_head', 'checathlon_plus_fonts_print_style' );

/**
 * Custom Font: Body Class Status
 **/
function checathlon_plus_fonts_body_class( $classes ) {
	// Get theme default fonts.
	$default_fonts = checathlon_plus_theme_default_fonts();

	// Add active status.
	$classes[] = 'custom-fonts-active';

	// Get fonts config.
	$config = checathlon_plus_fonts_config();

	// Foreach setting.
	foreach ( $config as $section => $section_data ) {

		// Format font name.
		$font = get_theme_mod( $section, $section_data['default'] );

		// Bail if no new font have been set.
		if ( ! in_array( $font, $default_fonts ) ) {
			$font = 'fl-' . $section . '-' . $font;
			$font = strtolower( $font );
			$font = str_replace( ' ','-', $font );

			// Add body class.
			$classes[] = sanitize_html_class( $font );
		}
	}

	return array_unique( $classes );
}
add_filter( 'body_class', 'checathlon_plus_fonts_body_class' );

/* === EDITOR STYLE === */

$settings = checathlon_plus_fonts_settings();
if ( isset( $settings['editor_styles'] ) && ! empty( $settings['editor_styles'] ) ){
	require_once( $this->dir_path . 'inc/custom-fonts/editor-style.php' );
}

/**
 * Google Font URL : Combine multiple google font in one URL
 * @param  $fonts array fonts name as key and weight/style (array or comma separated string) as value.
 * @param  $subsets mixed array/comma separated string of subsets to load.
 * @return string
 */
function checathlon_plus_google_fonts_url( $fonts, $subsets = array() ){
	// Vars.
	$base_url  = 'https://fonts.googleapis.com/css';
	$font_args = array();
	$family    = array();

	// Format Each Font Family in Array.
	foreach ( $fonts as $font_name => $font_weight ) {
		$font_name = str_replace( ' ', '+', $font_name );
		if ( ! empty( $font_weight ) ) {
			if ( is_array( $font_weight ) ) {
				$font_weight = implode( ",", $font_weight );
			}
			$family[] = trim( $font_name . ':' . urlencode( trim( $font_weight ) ) );
		} else {
			$family[] = trim( $font_name );
		}
	}

	// Only return URL if font family defined.
	if ( ! empty ( $family ) ) {
		// Make Font Family a String.
		$family = implode( "|", $family );

		//Add font family in args.
		$font_args['family'] = $family;

		// Add font subsets in args.
		if ( ! empty( $subsets ) ) {
			// Format subsets to string.
			if ( is_array( $subsets ) ) {
				$subsets = implode( ',', $subsets );
			}

			$font_args['subset'] = urlencode( trim( $subsets ) );
		}

		$fonts_url = add_query_arg( $font_args, $base_url );

		return esc_url_raw( $fonts_url );
	}

	return '';
}
