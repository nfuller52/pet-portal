<?php
/*
Plugin Name: Pet Portal
Version: 0.0.1
Description: Pet Portal Integration with WordPress
Author: Nick Fuller
Plugin URI: https://www.vippetcare.com
Text Domain: pet-portal
 */

namespace PetPortal;

use PetPortal\Config\Application;

defined( 'ABSPATH' ) or die( 'It\'s a trap!' );
define( 'PET_PORTAL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'APOLLO_BASE_URL', 'http://10.0.1.156:3000/' );

require_once( PET_PORTAL_PLUGIN_DIR . '/config/autoloader.php' );
Config\Autoloader::register();

add_action( 'init', 'PetPortal\initialize' );
function initialize() {
	$plugin = new Application();
	$plugin->initialize();
}

function apollo_base_url() {
	return APOLLO_BASE_URL;
}
