<?php
/**
 * Custom Fonts Customizer
 *
 * @since 1.1.0
 * @package ChecathlonPlus
 **/

/**
 * Registers Customizer sections, settings, and controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function checathlon_plus_fonts_customizer_register( $wp_customize ) {

	/* == CONFIG == */
	$config   = checathlon_plus_fonts_config();
	$labels   = checathlon_plus_fonts_label();
	$priority = checathlon_plus_fonts_priority();

	// Panel.
	$wp_customize->add_panel(
		'fonts',
		array(
			'title'    => esc_html( $labels['fonts'] ),
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
				'panel' => 'fonts',
			)
		);

		// Setting.
		$wp_customize->add_setting(
			$section,
			array(
				'default'           => $section_data['default'],
				'sanitize_callback' => 'checathlon_plus_fonts_sanitize',
			)
		);

		// Control.
		$wp_customize->add_control(
				$section,
				array(
					'label'       => esc_html( $section_data['label'] ),
					'description' => isset( $section_data['description'] ) ? $section_data['description'] : '',
					'section'     => $section,
					'type'        => 'select',
					'choices'     => checathlon_plus_fonts_format_choices( $section_data['fonts'] ),
				)
		);

		/* === FONT WEIGHT === */
		if ( isset( $section_data['font_weight'] ) && $section_data['font_weight'] ) {

			$section_weight = $section . '_weight';

			// Setting.
			$wp_customize->add_setting(
				$section_weight,
				array(
					'default'           => esc_attr( $section_data['font_weight'] ),
					'sanitize_callback' => 'checathlon_plus_fonts_font_weight_sanitize',
				)
			);

			// Control.
			$wp_customize->add_control(
				$section_weight,
				array(
					'label'   => esc_html( $labels['font_weight'] ),
					'section' => $section,
					'type'    => 'select',
					'choices' => checathlon_plus_fonts_font_weight_choices(),
				)
			);
		}

	} // end foreach
}
add_action( 'customize_register', 'checathlon_plus_fonts_customizer_register' );

/**
 * Sanitize Fonts.
 **/
function checathlon_plus_fonts_sanitize( $input ) {
	// Get list of all supported fonts.
	$fonts = checathlon_plus_fonts();

	// Check if it's in the list before saving.
	if ( array_key_exists( $input, $fonts ) ) {
		return $input;
	}

	// Return empty if not valid.
	return '';
}


/**
 * Sanitize Font Weight Option.
 **/
function checathlon_plus_fonts_font_weight_sanitize( $input ) {
	// Get weights.
	$weights = checathlon_plus_fonts_font_weight_choices();

	// Check we have allowed weight.
	if ( array_key_exists( $input, $weights ) ) {
		return $input;
	}

	return 'normal';
}
