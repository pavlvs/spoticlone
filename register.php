<?php
include "includes/handlers/register-handler.php";
include "includes/handlers/login-handler.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Spoticlone</title>
</head>

<body>
    <div id="inputContainer">
        <form action="register.php" method="POST" id="loginForm">
        	<h2>Login to your account</h2>
        	<p>
        		<label for="loginUsername">Username</label>
        		<input type="text" name="loginUsername" id="loginUsername" value="" placeholder="e.g. bartSimpson" required>
        	</p>
        	<p>
        		<label for="loginPassword">Password</label>
        		<input type="password" name="loginPassword" id="loginPassword" value="" placeholder="Your password" required>
        	</p>
			<button type="submit" name="loginButton">LOG IN</button>
        </form>
        <form action="register.php" method="POST" id="registerForm">
        	<h2>Create your free account</h2>
        	<p>
        		<label for="username">Username</label>
        		<input type="text" name="username" id="username" value="" placeholder="e.g. bartSimpson" required>
        	</p>
        	<p>
        		<label for="firstName">First name</label>
        		<input type="text" name="firstName" id="firstName" value="" placeholder="e.g. Bart" required>
        	</p>
        	<p>
        		<label for="lastName">Last name</label>
        		<input type="text" name="lastName" id="lastName" value="" placeholder="e.g. Simpson" required>
        	</p>
        	<p>
        		<label for="email1">Email</label>
        		<input type="email" name="email1" id="email1" value="" placeholder="e.g. bart@simpson.com" required>
        	</p>
        	<p>
        		<label for="email2">Confirm Email</label>
        		<input type="email" name="email2" id="email2" value="" placeholder="e.g. bart@simpson.com" required>
        	</p>
        	<p>
        		<label for="password1">Password</label>
        		<input type="password" name="password1" id="password1" value="" placeholder="Your password" required>
        	</p>
        	<p>
        		<label for="password2">Confirm Password</label>
        		<input type="password" name="password2" id="password2" value="" placeholder="Your password" required>
        	</p>
			<button type="submit" name="registerButton">Sign Up</button>
        </form>
    </div>
</body>

</html>