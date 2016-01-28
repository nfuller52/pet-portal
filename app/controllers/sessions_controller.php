<?php
namespace PetPortal\App\Controllers;

use PetPortal\App\Controllers\ApplicationController;
use PetPortal\App\Models\User;

class SessionsController extends ApplicationController {

	/**
	 * Log in a user and start a WordPress session
	 *
	 * @param  WP_User $user    The WordPress user object passed through the action
	 * @param  string $username The username passed through the WordPress form
	 * @param  string $password The password passed through the WordPress form
	 * @return WP_User|false    Returns the user to login or false with incorrect credentials
	 */
	public function create( $user, $username, $password )
	{

		remove_action( 'authenticate', 'wp_authenticate_username_password', 20 );

		if ( $this->user_can_login( $username, $password ) ) {
			$user = new User();
			return $user->authenticate( $username, $password );
		} else {
			add_filter( 'login_errors', create_function( '$a', 'return "Please enter your username and password.";' ) );
			return false;
		}

	}

	/*
	 * Sign out
	 *
	 */
	public function destroy()
	{

	}

	// Private methods
	/////////////////////////////////////////////

	/**
	 * Determine if the username and password have been set
	 *
	 * @param  string $username The username provided via the WordPress form
	 * @param  string $password The password provided via the WordPress form
	 * @return bool
	 */
	private function user_can_login( $username, $password )
	{

		return ! (
			( trim( $username ) === '' || $username === null )
			||
			( trim( $password ) === '' || $password === null )
		);

	}

}
