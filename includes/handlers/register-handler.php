<?php

function sanitizeFormUsername($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}
function sanitizeFormString($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}

function sanitizeFormPassword($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
}

function validateUsername($un) {
	# code...
}
function validateFirstName($fn) {
	# code...
}
function validateLastName($ln) {
	# code...
}
function validateEmails($em1, $em2) {
	# code...
}
function validatePasswords($pw1, $pw2) {
	# code...
}
if (isset($_POST['registerButton'])) {
	// register button was pressed
	$username = sanitizeFormUsername($_POST['username']);
	$firstName = sanitizeFormString($_POST['firstName']);
	$lastName = sanitizeFormString($_POST['lastName']);
	$email1 = sanitizeFormString($_POST['email1']);
	$email2 = sanitizeFormString($_POST['email2']);
	$password1 = sanitizeFormPassword($_POST['password1']);
	$password2 = sanitizeFormPassword($_POST['password2']);

	validateUsername($username);
	validateFirstName($firstName);
	validateLastName($lastName);
	validateEmails($email1, $email2);
	validatePasswords($password1, $password2);
}
?>