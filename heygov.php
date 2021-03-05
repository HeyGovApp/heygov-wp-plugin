<?php
/*
Plugin Name: HeyGov
Plugin URI: https://townweb.com
Description: Plugin to setup & manage heygov widget
Version: 1.0
Author: TownWeb
Author URI: https://townweb.com
License: GPL2
*/

include 'vendor/autoload.php';

define('HEYGOV_URL', plugin_dir_url( __FILE__ ));
define('HEYGOV_DIR', plugin_dir_path( __FILE__ ));

require_once 'includes/class/heygov-resource.php';
require_once 'includes/class/heygov-settings.php';

class HeyGov {

	function __construct() {
		$setting = new HeyGovSettings();
		$resource = new HeyGovResource();

		if (is_admin()) {
			add_action('admin_menu', array($setting, 'add_admin_menu'));
			add_action('admin_enqueue_scripts', array($resource, 'load_admin_includes'));
		} else {
			add_action('wp_footer', array($resource, 'load_frontend_includes'));
			add_shortcode('heygov-widget', array($setting, 'heygov_shortcode'));
		}
	}
}

$twdHeyGov = new HeyGov;

function heygov_load_module() {
	if ( class_exists( 'FLBuilder' ) ) {
		require_once 'pagebuilder-module/heygov-pb-module.php';
	}
  }
add_action( 'init', 'heygov_load_module' );

/**
 * Update from Heygov
 */
$updateChecker = \Puc_v4p4_Factory::buildUpdateChecker('https://bitbucket.org/TownWebTeam/heygov-wp-plugin', __FILE__, 'heygov-wp-plugin');
$updateChecker->setAuthentication(array(
  'consumer_key'      =>  'vAhE5vuYXxNFk9QmZV',
  'consumer_secret'   =>  'BH24FefsSH6AHS9a6d3QZqq9AZCjzXna'
));