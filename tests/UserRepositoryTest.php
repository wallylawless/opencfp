<?php

class UserRepositoryTest extends \PHPUnit_Framework_TestCase
{
	
	public function testGetById()
	{
		$repo = new \OpenCFP\UserRepository();

		$user = $repo->getUserById(10);

		$this->assertEquals(10, $user->id(), "GetById did not return a user with the requested ID");
	}

}