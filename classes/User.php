<?php
class User
{
	private $db;
	private $username;
	public function __construct($username)
	{
		$this->db = new Database();
		$this->username = $username;
	}

	public function getUsername()
	{ # code...
		return $this->username;
	}

	public function getEmail()
	{
		$sql = "SELECT email
				FROM users
				WHERE username = '$this->username'";
		$this->db->query($sql);
		$user = $this->db->single();
		return $user->email;
	}

	public function getFirstAndLastName()
	{
		$sql = "SELECT concat(firstName, ' ', lastName) AS `name`
				FROM users
				WHERE username = '$this->username'";
		$this->db->query($sql);
		$user = $this->db->single();
		return $user->name;
	}
}
