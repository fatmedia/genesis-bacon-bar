<?php
/**
 * Core plugin class.
 *
 * @package      Genesis Bacon Bar
 * @author       Robert Neu <http://wpbacon.com/>
 * @copyright    Copyright (c) 2014, FAT Media, LLC
 * @license      GPL-2.0+
 *
 */

// Exit if accessed directly
defined( 'WPINC' ) or die;

class Genesis_Bacon_Bar {
	/**
	 *
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load' ) );
	}

	/**
	 * Load the plugin.
	 */
	public function load() {
		self::define_constants();
		self::includes();
	}

	/**
	 * Define useful constants.
	 */
	public function define_constants() {
		// Plugin version.
		define( 'BACON_BAR_VERSION', '1.0.5' );
		// Plugin root file.
		if ( ! defined( 'BACON_BAR_FILE' ) ) {
			define( 'BACON_BAR_FILE', dirname( dirname( __FILE__ ) ) . '/genesis-bacon-bar.php' );
		}
		// Plugin directory URL.
		if ( ! defined( 'BACON_BAR_URL' ) ) {
			define( 'BACON_BAR_URL', plugin_dir_url( BACON_BAR_FILE ) );
		}
		// Plugin directory path.
		if ( ! defined( 'BACON_BAR_DIR' ) ) {
			define( 'BACON_BAR_DIR', plugin_dir_path( BACON_BAR_FILE ) );
		}
	}

	/**
	 * Include functions and libraries.
	 */
	public function includes() {
		// Load Gary Jones' Template Loader Class.
		if ( ! class_exists( 'Gamajo_Template_Loader' ) ) {
			require_once( BACON_BAR_DIR . 'includes/vendor/class-gamajo-template-loader.php' );
		}
		require_once( BACON_BAR_DIR . 'includes/class-baconbar-template-loader.php' );
		require_once( BACON_BAR_DIR . 'includes/functions.php' );
		require_once( BACON_BAR_DIR . 'includes/scripts.php' );
		if ( is_admin() ) {
			require_once( BACON_BAR_DIR . 'includes/admin/functions.php' );
		}
		// Include some files after Genesis to avoid conflicts.
		add_action( 'genesis_setup', array( $this, 'include_after_genesis' ) );
	}

	/**
	 * Include the Bacon Bar customizer class.
	 */
	public function include_after_genesis() {
		require_once( BACON_BAR_DIR . 'includes/admin/customizer.php' );
		if ( is_admin() ) {
			require_once( BACON_BAR_DIR . 'includes/admin/class-settings.php' );
		}
	}
}
