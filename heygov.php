<?php
/*
Plugin Name: HeyGov
Plugin URI: https://heygov.com
Description: Manage the HeyGov widget on your municipality WordPress website
Version: 1.3.1
Requires at least: 5.0
Requires PHP: 7.0
Author: HeyGov
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define('HEYGOV_URL', plugin_dir_url( __FILE__ ));
define('HEYGOV_DIR', plugin_dir_path( __FILE__ ));

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

		add_filter('plugin_action_links_heygov/heygov.php', [$this, 'actionLinks']);
		add_action('init', 'heygov_load_module');
	}

	public function actionLinks(array $links) {
		return array_merge([
			'settings'	=>	'<a href="' . menu_page_url('heygov_settings', false) . '">' . __('Settings', 'heygov') . '</a>'
		], $links);
	}

	public function enablePlugin() {
		$id = heygov_validate_id($_SERVER['HTTP_HOST']);

		if (!is_wp_error($id)) {
			update_option('heygov_id', $id);
		}
	}

}

function heygov_load_module() {
	if ( class_exists( 'FLBuilder' ) ) {
		require_once 'pagebuilder-module/heygov-pb-module.php';
	}
}

// Start the plugin
$heygov = new HeyGov;

register_activation_hook(__FILE__, [$heygov, 'enablePlugin']);
