<?php
namespace PetPortal\Lib;

use PetPortal\Lib\Logger;

/**
 * Error code index
 *
 * 1000 = Invalid User Credentials
 * 1001 = Unable to Connect to Authentication Service
 *
 */
class Error {

	/**
	 * Logs to the debug.log a warning that a user failed to authenticate
	 *
	 * @param  string $message A custom message to display
	 * @return WP_Error        A WordPress Error object to guide the interface
	 */
	public static function invalid_credentials( $message = '' )
	{

		Logger::warn( '1000 Invalid User Credentials -> ' . $message );

		return new \WP_Error(
			'denied',
			__( '<strong>WHOOPS!</strong> Invalid username or incorrect password. <a href="' . get_site_url() . '/wp-login.php?action=lostpassword">Lost your password</a>' )
		);

	}

	/**
	 * Logs to the debug.log an error that the authentication servers are down
	 *
	 * @param  string $message A custom message to display
	 * @return WP_Error        A WordPress Error object to guie the interface
	 */
	public static function cannot_connect_to_auth_server( $message = '' )
	{

		Logger::warn( '1000 Unable to Connect to Authentication Service -> ' . $message );

		return new \WP_Error(
			'denied',
			__( '<strong>UGH.</strong> Sorry, but it seems our authentication servers are down. Please try again later.' )
		);

	}

}
