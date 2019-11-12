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

if (isset($_POST['registerButton'])) {
	// register button was pressed
	$username = sanitizeFormUsername($_POST['username']);
	$firstName = sanitizeFormString($_POST['firstName']);
	$lastName = sanitizeFormString($_POST['lastName']);
	$email1 = sanitizeFormString($_POST['email1']);
	$email2 = sanitizeFormString($_POST['email2']);
	$password1 = sanitizeFormPassword($_POST['password1']);
	$password2 = sanitizeFormPassword($_POST['password2']);

}
?>