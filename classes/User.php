<?php

/**
 *
 */
class User
{
	private $db;
	private $username;
	public function __construct($db, $username)
	{
		$this->db = $db;
		$this->username = $username;
	}

	public function getUsername()
	{ # code...
		return $this->username;
	}
}
