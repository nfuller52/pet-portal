<?php

use PetPortal\App\Controllers\PasswordsController;

class PasswordsControllerTest extends WP_UnitTestCase {

	public function setUp()
	{

		parent::setup();
		$this->controller = new PasswordsController;

	}

	function test_class_can_be_instantiated()
	{

		$this->assertInstanceOf(
			'PetPortal\App\Controllers\PasswordsController',
			$this->controller
		);

	}

}

