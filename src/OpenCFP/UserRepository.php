<?php

namespace OpenCFP;

class UserRepository 
{
	public function __construct()
	{
	}

	public function getUserById($id)
	{
		$user = new \OpenCFP\User($id);
		return $user;
	}
}