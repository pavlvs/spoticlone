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
        		<input type="password" name="loginPassword" id="loginPassword" value="" required>
        	</p>
			<button type="submit" name="loginButton">LOG IN</button>
        </form>
    </div>
</body>

</html>