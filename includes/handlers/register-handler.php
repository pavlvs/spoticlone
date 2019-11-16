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
	return $inputText;
}

function sticky($name) {
	if (isset($_POST[$name])) {
		echo $_POST[$name];
	}
}

if (isset($_POST['registerButton'])) {
	echo $_POST['password1'];
	// register button was pressed
	$username = sanitizeFormUsername($_POST['username']);
	$firstName = sanitizeFormString($_POST['firstName']);
	$lastName = sanitizeFormString($_POST['lastName']);
	$email1 = sanitizeFormString($_POST['email1']);
	$email2 = sanitizeFormString($_POST['email2']);
	$password1 = sanitizeFormPassword($_POST['password1']);
	$password2 = sanitizeFormPassword($_POST['password2']);

	$success = $account->register($username, $firstName, $lastName, $email1, $email2, $password1, $password2);
	if ($success) {
		header("Location:index.php");
	}
}
?>