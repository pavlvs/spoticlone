<?php
include "includes/config.php";
include "includes/classes/Account.php";
include "includes/classes/Constants.php";

$account = new Account($con);

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
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>
    <?php
if (isset($_POST['registerButton'])) {
	echo "<script>
                        $(function() {
                            $('#loginForm').hide();
                            $('#registerForm').show();
                        });
                    </script>";
} else {
	echo "<script>
                        $(function() {
                            $('#loginForm').show();
                            $('#registerForm').hide();
                        });
                    </script>";
}
?>

    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form action="register.php" method="POST" id="loginForm">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="loginUsername">Username</label>
                        <input type="text" name="loginUsername" id="loginUsername" value="<?php sticky("loginUsername");?>" placeholder="e.g. bartSimpson" required>
                    </p>
                    <p>
                        <label for="loginPassword">Password</label>
                        <input type="password" name="loginPassword" id="loginPassword" value="" placeholder="Your password" required>
                    </p>
                        <button type="submit" name="loginButton">LOG IN</button>

                        <div class="hasAccountText">
                            <span id="hideLogin">Don't have an account yet? Sign up here.</span>
                        </div>
                </form>
                <form action="register.php" method="POST" id="registerForm">
                    <h2>Create your free account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php sticky("username");?>" placeholder="e.g. bartSimpson" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                        <label for="firstName">First name</label>
                        <input type="text" name="firstName" id="firstName" value="<?php sticky("firstName");?>" placeholder="e.g. Bart" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                        <label for="lastName">Last name</label>
                        <input type="text" name="lastName" id="lastName" value="<?php sticky("lastName");?>" placeholder="e.g. Simpson" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                        <?php $account->getError(Constants::$invalidEmail);?>
                        <label for="email1">Email</label>
                        <input type="email" name="email1" id="email1" value="<?php sticky("email1");?>" placeholder="e.g. bart@simpson.com" required>
                    </p>
                    <p>
                        <label for="email2">Confirm Email</label>
                        <input type="email" name="email2" id="email2" value="<?php sticky("email2");?>" placeholder="e.g. bart@simpson.com" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$passwordLength); ?>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordsCharacters); ?>
                        <label for="password1">Password</label>
                        <input type="password" name="password1" id="password1" value="" placeholder="Your password" required>
                    </p>
                    <p>
                        <label for="password2">Confirm Password</label>
                        <input type="password" name="password2" id="password2" value="" placeholder="Your password" required>
                    </p>
                        <button type="submit" name="registerButton">Sign Up</button>

                        <div class="hasAccountText">
                            <span id="hideRegister">Already have an account? Login here.</span>
                        </div>
                </form>
            </div>
            <div id="loginText">
                <h1>Get great music, right now</h1>
                <h2>Listen to loads of songs for free</h2>
                <ul>
                    <li>Discover music you;ll fall in love with</li>
                    <li>Create your own playlists</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>