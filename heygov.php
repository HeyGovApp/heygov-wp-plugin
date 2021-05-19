<?php
/*
Plugin Name: HeyGov
Plugin URI: https://heygov.com
Description: Add HeyGov functionality: Report Issue widget, Apps banner
Version: 1.1
Author: HeyGov
Author URI: https://heygov.com
License: GPL2
*/

define('HEYGOV_URL', plugin_dir_url( __FILE__ ));
define('HEYGOV_DIR', plugin_dir_path( __FILE__ ));

require HEYGOV_DIR . 'vendor/autoload.php';

require_once 'includes/class/heygov-resource.php';
require_once 'includes/class/heygov-settings.php';

function heygov_validate_id(string $id) {

	if (empty($id)) {
		return new \WP_Error('heygov_empty_id', 'HeyGov ID is empty');
	}

	$re = wp_remote_get('https://api.heygov.com/jurisdictions/' . $id);

	if (is_wp_error($re)) {
		return $re;
	}

	$data = wp_remote_retrieve_body($re);
	$data = json_decode($data);

	if (isset($data->slug)) {
		$id = $data->slug;
	} else {
		return new \WP_Error('heygov_invalid_id', 'HeyGov ID is invalid');
	}

	return $id;
}

class HeyGov {

	public function __construct() {
		$setting = new HeyGovSettings();
		$resource = new HeyGovResource();

		if (is_admin()) {
			add_action('admin_menu', array($setting, 'add_admin_menu'));
			add_action('admin_enqueue_scripts', array($resource, 'load_admin_includes'));
		} else {
			add_action('wp_enqueue_scripts', array($resource, 'load_site_includes'));
			add_action('wp_footer', array($resource, 'load_widget'));
			add_action('wp_footer', array($resource, 'load_apps_banner'));
			add_shortcode('heygov-widget', array($setting, 'heygov_shortcode'));
		}

		add_action( 'init', 'heygov_load_module' );
	}


}

function heygov_load_module() {
	if ( class_exists( 'FLBuilder' ) ) {
		require_once 'pagebuilder-module/heygov-pb-module.php';
	}
}

// Start the plugin
new HeyGov;
