<?php
/**
 * Custom Fonts: Editor Style Functions.
 * Ajax CSS in editor style is taken from "Stargazer" theme by Justin Tadlock.
 * @author David Chandra <david@genbumedia.com>
 * @author Justin Tadlock <justintadlock@gmail.com>
**/

/**
 * Editor Styles Setting
 */
function checathlon_plus_fonts_mce_setting() {
	$settings = checathlon_plus_fonts_settings();
	return $settings['editor_styles'];
}

/**
 * Fonts used in tinymce editor.
 **/
function checathlon_plus_fonts_mce_fonts(){
	// Variables.
	$settings = checathlon_plus_fonts_mce_setting();
	$config   = checathlon_plus_fonts_config();
	$fonts    = array();

	foreach( $settings as $setting ) {
		$font         = get_theme_mod( $setting, $config[$setting]['default'] );
		$fonts[$font] = checathlon_plus_get_font_weight( $font );
	}

	return $fonts;
}

/**
 * Get Base Font (Google Font).
 **/
function checathlon_plus_fonts_mce_google_fonts_url() {

	// Variables.
	$google_fonts  = array();
	$fonts_subsets = array();
	$fonts         = checathlon_plus_fonts_mce_fonts();

	// Loop fonts data.
	foreach( $fonts as $font_name => $font_data ) {
		$font = checathlon_plus_fonts_remove_websafe( $font_name );
		if ( ! empty( $font ) ) {
			$google_fonts[$font_name] = $font_data;

			// Subsets.
			$get_font_subsets = checathlon_plus_get_font_subsets( $font_name );
			if ( ! empty( $get_font_subsets ) ) {
				foreach( $get_font_subsets as $subset ) {
					$fonts_subsets[] = $subset;
				}
			}
		}
	}

	// Get available subset.
	$subsets_settings = checathlon_plus_fonts_subsets();
	$subsets          = array_intersect( $subsets_settings, $fonts_subsets );

	$url = checathlon_plus_google_fonts_url( $google_fonts, $subsets );

	return $url;
}

/**
 * Add WP Editor Styles.
 **/
function checathlon_plus_fonts_mce_css( $mce_css ) {
	$url = checathlon_plus_fonts_mce_google_fonts_url();

	// Add google font.
	if ( ! empty( $url ) ) {
		$mce_css .= ', ' . $url;
	}

	// Add font rules.
	$mce_css .= ', ' . add_query_arg( array( 'action' => 'checathlon_plus_fonts_mce_css', '_nonce' => wp_create_nonce( 'checathlon-plus-fonts-mce-nonce', __FILE__ ) ), admin_url( 'admin-ajax.php' ) );
	return $mce_css;
}
add_filter( 'mce_css', 'checathlon_plus_fonts_mce_css' );

/**
 * Ajax Callback.
 **/
function checathlon_plus_fonts_mce_css_ajax_callback() {

	// Check nonce.
	$nonce = isset( $_REQUEST['_nonce'] ) ? $_REQUEST['_nonce'] : '';
	if( ! wp_verify_nonce( $nonce, 'checathlon-plus-fonts-mce-nonce' ) ) {
		die();
	}

	// Variables.
	$css      = '';
	$settings = checathlon_plus_fonts_mce_setting();
	$config   = checathlon_plus_fonts_config();

	foreach( $settings as $setting ) {
		$font = get_theme_mod( $setting, $config[$setting]['default'] );

		$target_element = $config[$setting]['target'];
		$font_family    = checathlon_plus_get_font_family( $font );

		$css .= "{$target_element}{font-family:{$font_family};}";
	}

	header( 'Content-type: text/css' );
	echo wp_strip_all_tags( $css );
	die();
}
add_action( 'wp_ajax_checathlon_plus_fonts_mce_css', 'checathlon_plus_fonts_mce_css_ajax_callback' );
add_action( 'wp_ajax_no_priv_checathlon_plus_fonts_mce_css', 'checathlon_plus_fonts_mce_css_ajax_callback' );
