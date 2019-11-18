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
			<div id="nowPlayingCenter">
				<div class="content playerControls">
					<div class="buttons">
						<button class="controlButton shuffle" title="Shuffle button"><img src="assets/images/icons/shuffle.png" alt="shuffle button"></button>
						<button class="controlButton previous" title="previous button"><img src="assets/images/icons/previous.png" alt="previous button"></button>
						<button class="controlButton play" title="play button"><img src="assets/images/icons/play.png" alt="play button"></button>
						<button class="controlButton pause" title="pause button" style="display:none"><img src="assets/images/icons/pause.png" alt="pause button"></button>
						<button class="controlButton next" title="next button"><img src="assets/images/icons/next.png" alt="next button"></button>
						<button class="controlButton repeat" title="repeat button"><img src="assets/images/icons/repeat.png" alt="repeat button"></button>
					</div>
				</div>
			</div>
			<div id="nowPlayingRight"></div>
		</div>
	</div>
</body>

</html>