<?php
/**
 * Checathlon Plus Customizer.
 *
 * @package ChecathlonPlus
 */

/**
 * Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function checathlon_plus_customize_register( $wp_customize ) {

	// Load different part of the Customizer.
	require_once( checathlon_plus()->dir_path . 'inc/customizer/settings-before-footer-widget.php' );
	require_once( checathlon_plus()->dir_path . 'inc/customizer/settings-first-widget.php' );
	require_once( checathlon_plus()->dir_path . 'inc/customizer/settings-footer.php' );

	// PostMessage settings.
	$wp_customize->get_setting( 'before_footer_area_title' )->transport = 'postMessage';
	$wp_customize->get_setting( 'footer_text' )->transport              = 'postMessage';

	// Set partial refresh.
	if ( isset( $wp_customize->selective_refresh ) ) {

		// Partial refresh for before footer area title.
		$wp_customize->selective_refresh->add_partial( 'before_footer_area_title', array(
			'selector'            => '.before-footer-widgets-title',
			'render_callback'     => function() {
				return checathlon_get_before_footer_area_title_html();
			},
		) );

		// Partial refresh for footer text.
		$wp_customize->selective_refresh->add_partial( 'footer_text', array(
			'selector'            => '.site-info',
			'render_callback'     => function() {
				return checathlon_get_footer_text_html();
			},
		) );

	}

}
add_action( 'customize_register', 'checathlon_plus_customize_register' );
