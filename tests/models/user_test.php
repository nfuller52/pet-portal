<?php

use PetPortal\App\Models\User;

class UserTest extends WP_UnitTestCase {

	public function setUp()
	{

		parent::setup();
		$this->model = new User;

	}

	function test_class_can_be_instantiated()
	{

		$this->assertInstanceOf(
			'PetPortal\App\Models\User',
			$this->model
		);

	}

}

