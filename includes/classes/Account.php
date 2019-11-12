<?php
	/**
	 *
	 */
	class Account
	{
		private $errorArray;
		public function __construct(argument)
		{
			$this->errorArray = array();
		}

		public function register($un, $fn, $ln, $em1, $em2, $pw1, $pw2)
		{
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
		}
		private function validateLastName($ln) {
			# code...
		}
		private function validateEmails($em1, $em2) {
			# code...
		}
		private function validatePasswords($pw1, $pw2) {
			# code...
}
	}
 ?>