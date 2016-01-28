<?php
namespace PetPortal\Config;

use PetPortal\App\Controllers\SessionsController;

class Application {

	/**
	 * Initializes the plugin
	 *
	 * @return void
	 */
	public function initialize()
	{

		$this->run_filters();

	}

	/**
	 * Runs necessary filters to hook into WordPress
	 *
	 * @return void
	 */
	public function run_filters()
	{

		add_filter( 'authenticate', array( $this, 'authenticate' ), 10, 3 );

	}

	/**
	 * Callback function for the WordPress authenticate filter. This allows
	 * us to hook into the WordPress authentication code and oauth with Apollo
	 * instead.
	 *
	 * @param  WP_User $user     A WordPress user object
	 * @param  string  $username The username passed from the form
	 * @param  string  $password The password passed from the form
	 * @return WP_User|Error
	 */
	public function authenticate( $user, $username, $password )
	{

			$sessions_controller = new SessionsController();
			return $sessions_controller->create( $user, $username, $password );

	}

}
