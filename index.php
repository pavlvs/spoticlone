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
	<div id="mainContainer">
		<div id="topContainer">
			<div id="navBarContainer">
				<nav class="navBar">
					<a href="index.php" class="logo">
						<img src="assets/images/icons/logo.png" alt="logo">
					</a>
				</nav>
			</div><!--End of navBarContainer -->
		</div><!--End of topContainer -->
		<div id="nowPlayingBarContainer">
			<div id="nowPlayingBar">
				<div id="nowPlayingLeft">
					<div class="content">
						<span class="albumLink">
							<img src="assets/images/square.jpg" alt="square" class="albumArtwork">
						</span>
						<div class="trackInfo">
							<span class="trackName">
								Happy Foo
							</span>
							<span class="artistName">
								Pavlvs X
							</span>
						</div>
					</div>
				</div><!--End of nowPlayingLeft -->
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
						<div class="playbackBar">
							<span class="progressTime current">0:00</span>
							<div class="progressBar">
								<div class="progressBarBg">
									<div class="progress"></div>
								</div>
							</div>
							<span class="progressTime remaining">0:00</span>
						</div>
					</div>
				</div><!--End of nowPlayingCenter -->
				<div id="nowPlayingRight">
					<div class="volumeBar">
						<button class="controlButton volume" title="volume button"><img src="assets/images/icons/volume.png" alt="volume button"></button>
						<div class="progressBar">
							<div class="progressBarBg">
								<div class="progress"></div>
							</div>
						</div>
					</div>
				</div><!--End of nowPlayingRight -->
			</div><!--End of nowPlayingBar -->
		</div><!--End of nowPlayingContainer -->
	</div><!--End of mainContainer -->
</body>

</html>