<?php
/**
 * Custom Colors functionality.
 *
 * @package ChecathlonPlus
 * @since   1.1.0
 */

// Customizer setting configuration.
$colors_config = array(
	'header_colors' => array(
		'label'       => esc_html_x( 'Header and main navigation', 'customizer', 'checathlon-plus' ),
		'description' => esc_html_x( 'Site header and main navigation colors and background.', 'customizer', 'checathlon-plus' ),
		'styles'      => array(
			'site-header-bg'          => '#ffffff',
			'main-navigation-link'    => '#474747',
			'main-navigation-hover'   => '#ff1654',
			'mobile-navigation-bg'    => '#474747',
			'mobile-navigation-link'  => '#d4d4d4',
			'mobile-navigation-hover' => '#ffffff',
		),
		'style-labels' => array(
			esc_html__( 'Site header backgroud', 'checathlon-plus' ),
			esc_html__( 'Main nagivation link color', 'checathlon-plus' ),
			esc_html__( 'Main nagivation link hover and active color', 'checathlon-plus' ),
			esc_html__( 'Mobile navigation backgroud', 'checathlon-plus' ),
			esc_html__( 'Mobile nagivation link color', 'checathlon-plus' ),
			esc_html__( 'Mobile nagivation link hover and active color', 'checathlon-plus' ),
		),
	),
	'content_colors' => array(
		'label'       => esc_html_x( 'Content', 'customizer', 'checathlon-plus' ),
		'description' => esc_html_x( 'Main navigation colors and background.', 'customizer', 'checathlon-plus' ),
		'styles'      => array(
			'main-color'         => '#1f1f1f',
			'headings-color'     => '#1f1f1f',
			'content-link-color' => '#ff1654',
			'content-link-hover' => '#1f1f1f',
			'highlight-color'    => '#ff1654',
			'soft-color'         => '#6c6c6c',
		),
		'style-labels' => array(
			esc_html__( 'Content color', 'checathlon-plus' ),
			esc_html__( 'Content headings color', 'checathlon-plus' ),
			esc_html__( 'Content link color', 'checathlon-plus' ),
			esc_html__( 'Content link hover color', 'checathlon-plus' ),
			esc_html__( 'Highlight color', 'checathlon-plus' ),
			esc_html__( 'Content soft color (byline)', 'checathlon-plus' ),
		),
	),
	'button_colors' => array(
		'label'       => esc_html_x( 'Buttons', 'customizer', 'checathlon-plus' ),
		'description' => esc_html_x( 'Buttons color and background.', 'customizer', 'checathlon-plus' ),
		'styles'      => array(
			'button-bg'              => '#ff1654',
			'button-color'           => '#ffffff',
			'button-bg-hover'        => '#474747',
			'button-color-hover'     => '#ffffff',
			'sec-button-bg'          => '#474747',
			'sec-button-color'       => '#ffffff',
			'sec-button-bg-hover'    => '#ff1654',
			'sec-button-color-hover' => '#ffffff',
		),
		'style-labels' => array(
			esc_html__( 'Button background color', 'checathlon-plus' ),
			esc_html__( 'Button color', 'checathlon-plus' ),
			esc_html__( 'Button hover background color', 'checathlon-plus' ),
			esc_html__( 'Button hover color', 'checathlon-plus' ),
			esc_html__( 'Secondary button background color', 'checathlon-plus' ),
			esc_html__( 'Secondary button color', 'checathlon-plus' ),
			esc_html__( 'Secondary button hover background color', 'checathlon-plus' ),
			esc_html__( 'Secondary button hover color', 'checathlon-plus' ),
		),
	),
	'footer_colors' => array(
		'label'       => esc_html_x( 'Footer', 'customizer', 'checathlon-plus' ),
		'description' => esc_html_x( 'Footer colors and background.', 'customizer', 'checathlon-plus' ),
		'styles'      => array(
			'footer-bg'           => '#474747',
			'footer-text'         => '#d4d4d4',
			'footer-link'         => '#d4d4d4',
			'footer-link-hover'   => '#ffffff',
			'footer-widget-color' => '#ffffff',
		),
		'style-labels' => array(
			esc_html__( 'Footer backgroud', 'checathlon-plus' ),
			esc_html__( 'Text color', 'checathlon-plus' ),
			esc_html__( 'Link color', 'checathlon-plus' ),
			esc_html__( 'Link hover color', 'checathlon-plus' ),
			esc_html__( 'Widget title color', 'checathlon-plus' ),
		),
	),
);

// Additional settings for custom color features.
$colors_settings = array(
	'editor_styles' => array(
		'color_base',
		'color_titles',
	),
	/**
	 * Translators: to add an additional color character subset specific to your language
	 * translate this to 'greek', 'cyrillic', or 'vietnamese'. Do not translate into your own language.
	 * Note: availability of the subset depends on colors selected.
	 */
	'priority' => 12,
);

// Additional strings used in custom color feature.
$colors_strings = array(
	'colors' => esc_html_x( 'Theme Colors', 'customizer', 'checathlon-plus' ),
);

// Add theme support for custom colors.
add_theme_support( 'checathlon-plus-custom-colors', $colors_config, $colors_settings, $colors_strings );
