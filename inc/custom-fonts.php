<?php
/**
 * Custom Fonts functionality. It's based on David Chandra Nokonoko theme.
 *
 * @package ChecathlonPlus
 * @author  David Chandra
 * @link    https://github.com/turtlepod/nokonoko/
 * @since   1.1.0
 */

// Customizer setting configuration.
$fonts_config = array(
	'font_site_title' => array(
		'label'       => esc_html_x( 'Site Title', 'customizer', 'checathlon-plus' ),
		'description' => esc_html_x( 'Site title text in the header.', 'customizer', 'checathlon-plus' ),
		'target'      => '.site-title.title-font',
		'fonts'       => array( 'websafe', 'heading', 'base' ),
		'default'     => 'Lora',
	),
	'font_post_title' => array(
		'label'       => esc_html_x( 'Post Title', 'customizer', 'checathlon-plus' ),
		'description' => esc_html_x( 'Page, post, and archive titles.', 'customizer', 'checathlon-plus' ),
		'target'      => '.entry-title.title-font,.page-title.title-font',
		'fonts'       => array( 'websafe', 'heading', 'base' ),
		'default'     => 'Lora',
	),
	'font_main_nav' => array(
		'label'       => esc_html_x( 'Main Navigation', 'customizer', 'checathlon-plus' ),
		'description' => esc_html_x( 'Primary menu links in the header.', 'customizer', 'checathlon-plus' ),
		'target'      => '.main-navigation a',
		'fonts'       => array( 'websafe', 'heading', 'base' ),
		'default'     => 'Source Sans Pro',
	),
	'font_titles'   => array(
		'label'       => esc_html_x( 'Headings', 'customizer', 'checathlon-plus' ),
		'description' => esc_html_x( 'Headings in the content (h2, h3, h4, h5, h6) and widget titles.', 'customizer', 'checathlon-plus' ),
		'target'      => 'h1, h2, h3, h4, h5, h6',
		'fonts'       => array( 'websafe', 'heading', 'base' ),
		'default'     => 'Source Sans Pro',
	),
	'font_base'     => array(
		'label'       => esc_html_x( 'Base Body', 'customizer', 'checathlon-plus' ),
		'description' => esc_html_x( 'Main font for the content.', 'customizer', 'checathlon-plus' ),
		'target'      => 'body,button,input,select,textarea,body#tinymce',
		'fonts'       => array( 'websafe', 'heading', 'base' ),
		'default'     => 'Source Sans Pro',
	),
);

// Additional settings for custom font features.
$fonts_settings = array(
	'editor_styles' => array(
		'font_base',
		'font_titles',
	),
	/**
	 * Translators: to add an additional font character subset specific to your language
	 * translate this to 'greek', 'cyrillic', or 'vietnamese'. Do not translate into your own language.
	 * Note: availability of the subset depends on fonts selected.
	 */
	'font_subset'         => esc_html_x( 'no-subset', 'Google Font Subset: add new subset( greek, cyrillic, vietnamese )', 'checathlon-plus' ),
	'allowed_weight'      => array( '300', '300i', '400', '400i', '600', '600i', '700', '700i' ),
	'theme_default_fonts' => array( 'Source Sans Pro', 'Lora' ),
	'priority'            => 11,
);

// Additional strings used in custom font feature.
$fonts_strings = array(
	'fonts' => esc_html_x( 'Theme Fonts', 'customizer', 'checathlon-plus' ),
);

// Add theme support for custom fonts.
add_theme_support( 'checathlon-plus-custom-fonts', $fonts_config, $fonts_settings, $fonts_strings );
