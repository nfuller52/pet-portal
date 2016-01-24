<?php

use PetPortal\App\Controllers\RegistrationsController;

class RegistrationsControllerTest extends WP_UnitTestCase {

	public function setUp()
	{

		parent::setup();
		$this->controller = new RegistrationsController;

	}

	function test_class_can_be_instantiated()
	{

		$this->assertInstanceOf(
			'PetPortal\App\Controllers\RegistrationsController',
			$this->controller
		);

	}

}

