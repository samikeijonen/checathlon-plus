<?php
/**
 * Theme Customizer for EDD.
 *
 * @package ChecathlonPlus
 */

	// Featured area downloads tag.
	$wp_customize->add_setting(
		'featured_area_downloads_tag',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_key'
		)
	);

	// Featured area downloads tag control.
	$wp_customize->add_control(
		'featured_area_downloads_tag',
		array(
			'label'           => esc_html__( 'Downloads tag', 'checathlon-plus' ),
			'description'     => esc_html__( 'Enter download tag and featured downloads will be show from that tag.', 'checathlon-plus' ),
			'section'         => 'front-page-featured',
			'priority'        => 20,
			'type'            => 'text',
			'active_callback' => 'checathlon_plus_show_downloads_tag',
		)
	);

	// Add the 'edd' section.
	$wp_customize->add_section(
		'edd',
		array(
			'title'    => esc_html__( 'Easy Digital Downloads', 'checathlon-plus' ),
			'priority' => 90,
			'panel'    => 'theme',
		)
	);

	// Add the empty cart text setting.
	$wp_customize->add_setting(
		'empty_cart_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'checathlon_sanitize_textarea',
		)
	);

	// Add the empty cart text control.
	$wp_customize->add_control(
		'empty_cart_text',
		array(
			'label'       => esc_html__( 'Empty cart text', 'checathlon-plus' ),
			'description' => esc_html__( 'Replace default empty cart text in checkout page by entering your own text.', 'checathlon-plus' ),
			'section'     => 'edd',
			'priority'    => 10,
			'type'        => 'textarea',
		)
	);

	// Show downloads on empty cart setting.
	$wp_customize->add_setting(
		'show_downloads_empty_cart',
		array(
			'default'           => '',
			'sanitize_callback' => 'checathlon_sanitize_checkbox',
		)
	);

	// Show downloads on empty cart control.
	$wp_customize->add_control(
		'show_downloads_empty_cart',
		array(
			'label'       => esc_html__( 'Show downloads in empty cart', 'checathlon-plus' ),
			'description' => esc_html__( 'Check this if you want to show downloads in empty cart.', 'checathlon-plus' ),
			'section'     => 'edd',
			'priority'    => 20,
			'type'        => 'checkbox',
		)
	);

	// Featured area title setting only for downloads.
	$wp_customize->add_setting(
		'downloads_featured_area_title',
		array(
			'default'           => checathlon_get_downloads_featured_area_title(),
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	// Featured area title control.
	$wp_customize->add_control(
		'downloads_featured_area_title',
		array(
			'label'           => esc_html__( 'Downloads featured area title', 'checathlon-plus' ),
			'description' => esc_html__( 'After single downloads and empty cart title for downloads.', 'checathlon-plus' ),

			'section'         => 'edd',
			'priority'        => 30,
			'type'            => 'text',
			'active_callback' => 'checathlon_show_featured_title',
		)
	);

	/**
	 * Checks when to show downloads tag field.
	 *
	 * @since  1.0.0
	 *
	 * @param  WP_Customize_Control
	 * @return boolean
	 */
	function checathlon_plus_show_downloads_tag( $control ) {
		return ( 'download' == $control->manager->get_setting( 'front_page_featured' )->value() );
	}
