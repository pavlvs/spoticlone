<?php
class Account
{
	private $db;
	private $validate;

	public function __construct()
	{
		$this->db = new Database();
		$this->validate = new Validator();
	}
	public function login($un, $pw)
	{
		$pw = md5($pw);
		$sql = "SELECT username, `password`
				FROM `users`
				WHERE `username` = :username
				AND `password` = :password";

		$this->db->query($sql);

		$this->db->bind(':username', $un);
		$this->db->bind(':password', $pw);

		$row = $this->db->single();

		if ($row) {
			return true;
		} else {
			$this->validate->loginError();

			return false;
		}
	}

	public function logout()
	{
		unset($_SESSION['userLoggedIn']);
		//unset($_SESSION['userId']);
		//unset($_SESSION['username']);
		//unset($_SESSION['name']);

		header('Location: index.php?action=register');
		session_destroy();
	}

	public function register($un, $fn, $ln, $em1, $em2, $pw1, $pw2)
	{
		$this->validate->username($un);
		$this->validate->firstName($fn);
		$this->validate->lastName($ln);
		$this->validate->emails($em1, $em2);
		$this->validate->passwords($pw1, $pw2);
		$errors = $this->validate->hasErrors();

		if ($errors > 0) {
			return false;
		} else {
			return $this->insertUserDetails($un, $fn, $ln, $em1, $pw1);
		}
	}

	private function insertUserDetails($un, $fn, $ln, $em, $pw)
	{
		$encryptedPw = md5($pw);
		$profilePic = "<?= IMG_FOLDER ?>profile-pics/avatar.jpg";
		$date = date("Y-m-d");

		$sql = "INSERT INTO users (username, firstName, lastName, email, `password`, signUpDate, profilePic)
				VALUES(:un, :fn, :ln, :em, :encryptedPw, :date, :profilePic)";
		$this->db->query($sql);
		$this->db->bind(':un', $un);
		$this->db->bind(':fn', $fn);
		$this->db->bind(':ln', $ln);
		$this->db->bind(':em', $em);
		$this->db->bind(':pw', $encryptedPw);
		$this->db->bind(':profilePic', $profilePic);
		$this->db->bind(':date', $date);

		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function showError($error)
	{
		$this->validate->getError($error);
	}
}
