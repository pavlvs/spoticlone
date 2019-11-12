<?php
/**
 *
 */
class Account {
	private $errorArray;
	public function __construct() {
		$this->errorArray = array();
	}

	public function register($un, $fn, $ln, $em1, $em2, $pw1, $pw2) {
		$this->validateUsername($un);
		$this->validateFirstName($fn);
		$this->validateLastName($ln);
		$this->validateEmails($em1, $em2);
		$this->validatePasswords($pw1, $pw2);
		# code...
	}
	private function validateUsername($un) {
		if (strlen($un) > 25 || strlen($un) < 5) {
			// do not register
			array_push($this->errorArray, "Your username must be between 5 and 25 characters long");
			return;
		}

		//TODO: check if username exists
	}
	private function validateFirstName($fn) {
		# code...
		if (strlen($fn) > 25 || strlen($fn) < 2) {
			// do not register
			array_push($this->errorArray, "Your first name must be between 2 and 25 characters long");
			return;
		}
	}
	private function validateLastName($ln) {
		# code...
		if (strlen($ln) > 25 || strlen($ln) < 2) {
			// do not register
			array_push($this->errorArray, "Your last name must be between 2 and 25 characters long");
			return;
		}
	}
	private function validateEmails($em1, $em2) {
		# code...
		if ($em1 != $em2) {
			// do not register
			array_push($this->errorArray, "Your emails do not match");
			return;
		}
		if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
			// do not register
			array_push($this->errorArray, "Email is invalid");
			return;
		}
		//TODO: check that email hasn't already been used
	}
	private function validatePasswords($pw1, $pw2) {
		# code...
		if ($pw1 != $pw2) {
			// do not register
			array_push($this->errorArray, "Your passwords do not match");
			return;
		}
		if (preg_match('/[^A-Za-z0-9]/', $pw1)) {
			array_push($this->errorArray, "Your password can only contain numbers and letters");
			return;
			# code...
		}
		if (strlen($pw1) > 30 || strlen($pw2) < 5) {
			// do not register
			array_push($this->errorArray, "Your password must be between 5 and 30 characters long");
			return;
		}
	}
}
?>