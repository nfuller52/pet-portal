<?php

use PetPortal\App\Controllers\SessionsController;

class SessionsControllerTest extends WP_UnitTestCase {

	public function setUp()
	{

		parent::setup();
		$this->controller = new SessionsController;

	}

	function test_class_can_be_instantiated()
	{

		$this->assertInstanceOf(
			'PetPortal\App\Controllers\SessionsController',
			$this->controller
		);

	}

}

