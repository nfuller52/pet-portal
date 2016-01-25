<?php
namespace PetPortal\App\Models;

use PetPortal\Lib\Client;
use PetPortal\Lib\Configuration;

class Apollo {

	/**
	 * Sets the properties for the object.
	 *
	 * Stores the current user from WordPress, if one is logged in.
	 * Stores the user's meta if the user is logged in.
	 * Stores a client object for making external requests.
	 * Stores a configuration object for interacting with WordPress options.
	 *
	 * @param PetPortal\App\Lib\Client $client not required by default
	 * @param PetPortal\App\Lib\Configuration $config not required by default
	 */
	public function __construct( $client = null, $config = null )
	{

		if ( $client === null ) { $client = new Client(); }
		if ( $config === null ) { $config = new Configuration(); }

		$this->current_user = wp_get_current_user();
		$this->user_meta    = $this->current_user_meta();
		$this->client       = $client;
		$this->config       = $config;

	}

	public function access_token( $username, $password )
	{

		$options = array(
			'params' => array(
				'grant_type' => 'password',
				'username'   => $username,
				'password'   => $password,
			),
		);

		return $this->client->post( $this->config->token_url(), $options );

	}

	public function refresh_token( $refresh_token )
	{

		$options = array(
			'params' => array(
				'grant_type'    => 'refresh_token',
				'refresh_token' => $refresh_token,
			),
		);

		return $this->client->post( $this->config->token_url(), $options );

	}

	public function revoke_token( $token )
	{

		if ( is_user_logged_in() ) { return false; }

		$options = array(
			'params' => array(
				'token' => $token,
			),
			'headers' => array(
				'Authorization' => 'Bearer ' . $this->current_user_meta['access_token'],
			);
		);

		return $this->client->post( $this->config->revoke_url(), $options );

	}

	// Private Methods
	/////////////////////////////////////////////

	/**
	 * Fetch the apollo meta array for the current user object
	 *
	 * @return array returns an unserialized array of meta data about the user
	 */
	private function current_user_meta()
	{

		if ( $this->current_user === false ) { return false; }

		$meta = get_user_meta( $this->current_user->ID, 'apollo', true );
		return unserialize( $meta );

	}

}
