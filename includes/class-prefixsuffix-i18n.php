<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.giorgosgeorgantas.com
 * @since      1.0.0
 *
 * @package    Prefixsuffix
 * @subpackage Prefixsuffix/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Prefixsuffix
 * @subpackage Prefixsuffix/includes
 * @author     Giorgos Georgantas <g.giorgantas@gmail.com>
 */
class Prefixsuffix_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'prefixsuffix',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
