<?php

/**
 *
 * The plugin bootstrap file
 *
 * This file is responsible for starting the plugin using the main plugin class file.
 *
 * @since 0.0.1
 * @package Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:     Plugin Name
 * Description:     This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:         0.0.1
 * Author:          Your Name
 * Author URI:      https://www.example.com
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     plugin-name
 * Domain Path:     /lang
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access not permitted.' );
}

if ( ! class_exists( 'my_custom' ) ) {

	/*
	 * main my_custom class
	 *
	 * @class my_custom
	 * @since 0.0.1
	 */
	class my_custom {

		/*
		 * my_custom plugin version
		 *
		 * @var string
		 */
		public $version = '4.7.5';

		/**
		 * The single instance of the class.
		 *
		 * @var my_custom
		 * @since 0.0.1
		 */
		protected static $instance = null;

		/**
		 * Main my_custom instance.
		 *
		 * @since 0.0.1
		 * @static
		 * @return my_custom - main instance.
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * my_custom class constructor.
		 */
		public function __construct() {
			$this->load_plugin_textdomain();
			$this->define_constants();
			$this->includes();
			$this->define_actions();
		}

		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'my-custom-text-domain', false, basename( dirname( __FILE__ ) ) . '/lang/' );
		}

		/**
		 * Include required core files
		 */
		public function includes() {
			// Load custom functions and hooks
			require_once __DIR__ . '/includes/includes.php';
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}


		/**
		 * Define my_custom constants
		 */
		private function define_constants() {
			define( 'MY_CUSTOM_PLUGIN_FILE', __FILE__ );
			define( 'MY_CUSTOM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			define( 'MY_CUSTOM_VERSION', $this->version );
			define( 'MY_CUSTOM_PATH', $this->plugin_path() );
			define( 'MY_CUSTOM_WIDGETS_VIEWS', MY_CUSTOM_PATH.'/includes/views/widgets' );
			define( 'MY_CUSTOM_TXDM', 'my-custom-text-domain' );
		}

		/**
		 * Define my_custom actions
		 */
		public function define_actions() {
			//
		}

		/**
		 * Define my_custom menus
		 */
		public function define_menus() {
            //
		}
	}

	$my_custom = new my_custom();
}
