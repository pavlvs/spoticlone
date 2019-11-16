<?php
/**
 *
 */
class Account {
	private $errorArray;
	private $con;
	public function __construct($con) {
		$this->errorArray = array();
		$this->con = $con;
	}
	public function login($un, $pw) {
		$pw = md5($pw);
		$loginQuery = mysqli_query($this->con, "SELECT username, password FROM users WHERE username = '$un' AND password = '$pw'");
		if (mysqli_num_rows($loginQuery) == 1) {
			return true;
		} else {
			array_push($this->errorArray, Constants::$loginFailed);
			return false;
		}
	}
	public function register($un, $fn, $ln, $em1, $em2, $pw1, $pw2) {

		$this->validateUsername($un);
		$this->validateFirstName($fn);
		$this->validateLastName($ln);
		$this->validateEmails($em1, $em2);
		$this->validatePasswords($pw1, $pw2);

		var_dump($this->errorArray);

		if (empty($this->errorArray) == true) {
			return $this->insertUserDetails($un, $fn, $ln, $em1, $pw1);
		} else {
			return false;
		}
	}

	public function getError($error) {
		if (!in_array($error, $this->errorArray)) {
			$error = "";
		}
		return "<span class='errorMessage'>$error</span>";
	}
	private function insertUserDetails($un, $fn, $ln, $em, $pw) {
		$encryptedPw = md5($pw);
		$profilePic = "assets/images/profile-pics/avatar.jpg";
		$date = date("Y-m-d");

		$query = "INSERT INTO users VALUES('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')";
		$result = mysqli_query($this->con, $query);
		return $result;
	}
	private function validateUsername($un) {
		if (strlen($un) > 25 || strlen($un) < 5) {
			array_push($this->errorArray, Constants::$usernameCharacters);
			return;
		}

		$checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users where username = '$un");
		if (mysqli_num_rows($checkUsernameQuery) != 0) {
			array_push($this->errorArray, Constants::$usernameExists);
			return;
		}
	}
	private function validateFirstName($fn) {
		# code...
		if (strlen($fn) > 25 || strlen($fn) < 2) {
			// do not register
			array_push($this->errorArray, Constants::$firstNameCharacters);
			return;
		}
	}
	private function validateLastName($ln) {
		# code...
		if (strlen($ln) > 25 || strlen($ln) < 2) {
			// do not register
			array_push($this->errorArray, Constants::$lastNameCharacters);
			return;
		}
	}
	private function validateEmails($em1, $em2) {
		# code...
		if ($em1 != $em2) {
			// do not register
			array_push($this->errorArray, Constants::$emailsDoNotMatch);
			return;
		}
		if (!filter_var($em1, FILTER_VALIDATE_EMAIL)) {
			// do not register
			array_push($this->errorArray, Constants::$invalidEmail);
			return;
		}
		$checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users where email='$em1'");
		if (mysqli_num_rows($checkEmailQuery) != 0) {
			array_push($this->errorArray, Constants::$emailTaken);
		}
	}
	private function validatePasswords($pw1, $pw2) {
		if ($pw1 != $pw2) {
			// do not register
			array_push($this->errorArray, Constants::$passwordsDoNotMatch);
			return;
		}
		if (preg_match('/[^A-Za-z0-9]/', $pw1)) {
			array_push($this->errorArray, Constants::$passwordsCharacters);
			return;
			# code...
		}
		echo strlen($pw1);
		if (strlen($pw1) > 30 || strlen($pw1) < 5) {
			// do not register
			array_push($this->errorArray, Constants::$passwordLength);
			return;
		}
	}
}
?>