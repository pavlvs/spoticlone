<?php
	/**
	 *
	 */
	class Account
	{

		public function __construct(argument)
		{

		}

		public function register()
		{
			$this->validateUsername($username);
			$this->validateFirstName($firstName);
			$this->validateLastName($lastName);
			$this->validateEmails($email1, $email2);
			$this->validatePasswords($password1, $password2);
			# code...
		}
		private function validateUsername($un) {
			# code...
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