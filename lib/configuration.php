<?php
namespace PetPortal\Lib;

class Configuration {

	public function __construct()
	{

	}

	public function token_url()
	{

		return 'http://10.0.1.156:3000/oauth/token';

	}

	public function revoke_url()
	{

		return 'http://10.0.1.156:3000/oauth/revoke';

	}

}
