<?php
namespace PetPortal\App\Models\Users;

use PetPortal\Lib\Error;

class Login {

	public function user( $username, $response )
	{

		if ( $response['code'] === 200 ) {
			$this->response_body = $response['body'];
		} else {
			return Error::invalid_credentials( $username . ' with password [FILTERED]' );
		}

	}

}
