<?php
/**
 * Custom Colors Customizer
 *
 * @since 1.1.0
 * @package ChecathlonPlus
 **/

/**
 * Registers Customizer sections, settings, and controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function checathlon_plus_colors_customizer_register( $wp_customize ) {

	/* == CONFIG == */
	$config   = checathlon_plus_colors_config();
	$labels   = checathlon_plus_colors_label();
	$priority = checathlon_plus_colors_priority();

	// Panel.
	$wp_customize->add_panel(
		'colors',
		array(
			'title'    => esc_html( $labels['colors'] ),
			'priority' => absint( $priority ),
		)
	);

	// Create sections from config.
	foreach( $config as $section => $section_data ) {

		// Section.
		$wp_customize->add_section(
			$section,
			array(
				'title' => esc_html( $section_data['label'] ),
				'panel' => 'colors',
			)
		);

		// Create setting/controls from config 'styles'.
		$k = 0;
		foreach( $section_data['styles'] as $section_color => $default_color ) {

			// Setting.
			$wp_customize->add_setting(
				$section_color,
				array(
					'default'           => $default_color,
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			// Control.
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
					$section_color,
					array(
						'label'   => isset( $section_data['style-labels'][$k] ) ? esc_html( $section_data['style-labels'][$k] ) : '',
						'section' => $section,
					)
			) );

			$k++;
		} // end foreach

	} // end foreach
}
add_action( 'customize_register', 'checathlon_plus_colors_customizer_register' );

/**
 * Format Choices Array From Fonts Group.
 **/
function checathlon_plus_colors_format_choices( $font_groups ) {

	// Output.
	$output = array();

	// For each group, add it in array.
	foreach( $font_groups as $font_group ) {

		// Add websafe font.
		if ( 'websafe' == $font_group ) {
			$fonts = checathlon_plus_fonts_websafe();
			foreach( $fonts as $font_name => $font_data ) {
				$output[$font_name] = $font_data['name'];
			}
		}

		// Headings Fonts.
		elseif ( 'heading' == $font_group ) {
			$fonts = checathlon_plus_fonts_heading();
			foreach( $fonts as $font_name => $font_data ){
				$output[$font_name] = $font_data['name'];
			}
		}

		// Base Fonts.
		elseif ( 'base' == $font_group ) {
			$fonts = checathlon_plus_fonts_base();
			foreach( $fonts as $font_name => $font_data ){
				$output[$font_name] = $font_data['name'];
			}
		}
	}

	return $output;
}
