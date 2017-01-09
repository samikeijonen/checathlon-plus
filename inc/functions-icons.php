<?php
/**
 * Icon (SVG) related functions and filters.
 *
 * @package ChecathlonPlus
 */

/**
 * Display SVG social link icons in custom menu widget.
 *
 * @param  array   $nav_menu_args An array of arguments passed to wp_nav_menu().
 * @param  WP_Term $nav_menu      Nav menu object.
 * @param  array   $args          Display arguments for the current widget.
 * @param  array   $instance      Array of settings for the current widget.
 * @return array   $nav_menu_args An array of arguments passed to wp_nav_menu() with social icons.
 */
function checathlon_plus_widget_social_menu( $nav_menu_args, $nav_menu, $args, $instance ) {
	// Menu location to check.
	$menu_location = 'social';

	// Bail if there is no 'social' menu.
	if ( ! has_nav_menu( $menu_location ) ) {
		return $nav_menu_args;
	}

	// Get menu name for 'social' menu.
	$menu_name = wp_get_nav_menu_object( get_nav_menu_locations( $menu_location )[ $menu_location ] )->name;

	// If we assign the same social menu in widget, let's use SVG icons.
	if ( $menu_name === $nav_menu->name ) {
		$nav_menu_args['theme_location']  = 'social';
		$nav_menu_args['link_before']     = '<span class="screen-reader-text">';
		$nav_menu_args['link_after']      = '</span>' . checathlon_get_svg( array( 'icon' => 'chain' ) );
		$nav_menu_args['menu_class']      = 'social-links-menu';
		$nav_menu_args['depth']           = 1;
		$nav_menu_args['container_class'] = 'menu-social widget-social-navigation';
	}

	return $nav_menu_args;
}
add_filter( 'widget_nav_menu_args', 'checathlon_plus_widget_social_menu', 10, 4 );
