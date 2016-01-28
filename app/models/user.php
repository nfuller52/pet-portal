<?php
namespace PetPortal\App\Models;

use PetPortal\App\Models\Apollo;
use PetPortal\App\Models\Users\Login;
use PetPortal\Lib\Error;

class User {

	public function __construct( $apollo = null )
	{

		if ( $apollo === null ) { $apollo = new Apollo(); }

		$this->apollo = $apollo;

	}

	public function authenticate( $username, $password )
	{

		$response = $this->apollo->access_token( $username, $password );

		if ( is_wp_error( $response ) ) {
			return Error::cannot_connect_to_auth_server();
		} else {
			$login = new Login();
			return $login->user( $username, $response );
		}

	}

}
