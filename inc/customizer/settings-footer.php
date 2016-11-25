<?php
/**
 * Theme Customizer for footer.
 *
 * @package ChecathlonPlus
 */

	// Add the 'footer' section.
	$wp_customize->add_section(
		'footer',
		array(
			'title'       => esc_html__( 'Footer', 'checathlon-plus' ),
			'priority'    => 100,
			'panel'       => 'theme',
		)
	);

	// Add the footer text setting.
	$wp_customize->add_setting(
		'footer_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'checathlon_sanitize_textarea'
		)
	);

	// Add the footer text control.
	$wp_customize->add_control(
		'footer_text',
		array(
			'label'       => esc_html__( 'Footer text', 'checathlon-plus' ),
			'description' => esc_html__( 'Replace default Footer text by entering your own text.', 'checathlon-plus' ),
			'section'     => 'footer',
			'priority'    => 10,
			'type'        => 'textarea'
		)
	);

	// Hide from footer text setting.
	$wp_customize->add_setting(
		'hide_footer_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'checathlon_sanitize_checkbox'
		)
	);

	// Hide footer text control.
	$wp_customize->add_control(
		'hide_footer_text',
		array(
			'label'       => esc_html__( 'Hide Footer Text', 'checathlon-plus' ),
			'description' => esc_html__( 'Check this if you want to hide Footer text.', 'checathlon-plus' ),
			'section'     => 'footer',
			'priority'    => 20,
			'type'        => 'checkbox'
		)
	);
