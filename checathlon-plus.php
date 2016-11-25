<?php
/**
 * Plugin Name: Checathlon Plus
 * Plugin URI:  https://foxland.fi/downloads/checathlon/
 * Description: Extra features for Checathlon theme.
 * Version:     1.0.0
 * Author:      Sami Keijonen
 * Author URI:  https://foxland.fi/
 * Text Domain: checathlon-plus
 * Domain Path: /languages
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package   ChecathlonPlus
 * @author    Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright Copyright (c) 2016, Sami Keijonen
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Singleton class that sets up and initializes the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
final class Checathlon_Plus {

	/**
	 * Directory path to the plugin folder.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_path = '';

	/**
	 * Directory URI to the plugin folder.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_uri = '';

	/**
	 * JavaScript directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $js_uri = '';

	/**
	 * CSS directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $css_uri = '';

	/**
	 * Plugin version.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '';

	/**
	 * The name of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $plugin_name = '';

	/**
	 * Unique plugin slug identifier.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $plugin_slug = '';

	/**
	 * Theme/Plugin shop URL.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $remote_api_url = '';

	/**
	 * Plugin author.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $author = '';

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup();
			$instance->includes();
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Initial plugin setup.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup() {

		$this->dir_path = trailingslashit( plugin_dir_path( __FILE__ ) );
		$this->dir_uri  = trailingslashit( plugin_dir_url(  __FILE__ ) );

		$this->js_uri  = trailingslashit( $this->dir_uri . 'assets/js'  );
		$this->css_uri = trailingslashit( $this->dir_uri . 'assets/css' );

		$this->version        = '1.0.0';
		$this->plugin_name    = 'Checathlon Plus';
		$this->plugin_slug    = 'checathlon-plus';
		$this->remote_api_url = 'http://foxland.fi';
		$this->author         = 'Sami Keijonen';
	}

	/**
	 * Loads files for the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function includes() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Enable Plugin Updater.
		add_action( 'init', array( $this, 'plugin_updater' ) );

		// Load files after theme has setup.
		add_action( 'after_setup_theme', array( $this, 'load_files' ), 20 );

		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );

	}

	/**
	 * Loads the plugin updater.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function plugin_updater() {

		// Bail if not in admin.
		if ( ! is_admin() ) {
			return;
		}

		// Includes the files needed for the plugin updater in admin.
		if ( ! class_exists( 'EDD_Plugin_Updater_Admin' ) ) {
			include( $this->dir_path . 'plugin-updater/plugin-updater-admin.php' );
		}

		/* Loads the admin updater class */
		$updater = new EDD_Plugin_Updater_Admin(
			array(
				'remote_api_url' => $this->remote_api_url, // Site where EDD is hosted
				'item_name'      => $this->plugin_name,    // Name of the plugin
				'plugin_slug'    => $this->plugin_slug,    // Plugin slug
				'version'        => $this->version,        // The current version of this theme
				'author'         => $this->author          // The author of this plugin
			)
		);

		// If there is no valid license key status, don't allow updates.
		if ( 'valid' != get_option( $this->plugin_slug . '_license_key_status', false ) ) {
			return;
		}

		// Includes the files needed for the plugin updater.
		if ( ! class_exists( 'EDD_SL_Plugin_Updater' ) ) {
			include( $this->dir_path . 'plugin-updater/plugin-updater-class.php' );
		}

		// Go ahead and initialize the updater.
		$edd_updater = new EDD_SL_Plugin_Updater( $this->remote_api_url, __FILE__, array(
				'version'   => $this->version,
				'license'   => trim( get_option( $this->plugin_slug . '_license_key' ) ),
				'item_name' => $this->plugin_name,
				'author'    => $this->author
			)
		);
	}

	/**
	 * Loads the plugin files.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function load_files() {

		// Bail if Checathlon theme is not around.
		$theme = wp_get_theme();
		if ( 'Checathlon' !== $theme->name && 'Checathlon' !== $theme->parent_theme ) {
			return;
		}

		// Load functions files.
		require_once( $this->dir_path . 'inc/customizer.php' );
		require_once( $this->dir_path . 'inc/class-widget-pricing.php' );

	}

	/**
	 * Loads the translation files.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function i18n() {

		load_plugin_textdomain( 'checathlon-plus', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) . 'languages' );
	}

}

/**
 * Gets the instance of the `Checathlon_Plus` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function checathlon_plus() {
	return Checathlon_Plus::get_instance();
}

// Let's roll the plugin in action.
checathlon_plus();
