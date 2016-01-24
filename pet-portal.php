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

defined( 'ABSPATH' ) or die( 'It\'s a trap!' );
define( 'PET_PORTAL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( PET_PORTAL_PLUGIN_DIR . '/config/autoloader.php' );
Config\Autoloader::register();
