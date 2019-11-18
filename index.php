<?php
include "includes/config.php";
if (isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
} else {
	header("Location: register.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spoticlone</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<div id="nowPlayingBarContainer">
		<div id="nowPlayingBar">
			<div id="nowPlayingLeft"></div>
			<div id="nowPlayingCenter"></div>
			<div id="nowPlayingRight"></div>
		</div>
	</div>
</body>

</html>