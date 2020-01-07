<?php

	/**
	 * Plugin Name:		Interactive Maps
	 * Description:		Create fancy, extendable interactive maps.
	 * Version:			1.0.0
	 * Author:			Yarrington Ltd
	 * Author URI:		https://yarrington.co.uk?refer=yarr_im
	 * Text Domain:		yarr_im
	 * License:			GPL-2.0+
	 * License URI:		http://www.gnu.org/licenses/gpl-2.0.txt
	 */

	define('YIM_INIT', true);
	define('YIM_PLUGIN_DIR', __DIR__);
	define('YIM_PLUGIN_FILE', __FILE__);
	define('YIM_MAP_EDITOR_URI', '/wp-admin/map-editor');

	// Post Types
	require 'post-types/maps.php';

	// Functions
	require 'functions/acf_maps.php';
	require 'functions/functions.php';

	// Shortcodes
	require 'shortcodes/yim_shortcode.php';