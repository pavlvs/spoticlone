<?php
include "includes/includedFiles.php";
if (isset($_GET['id'])) {
	$playlistId = $_GET['id'];
} else {
	header("Location: index.php");
}

$playlist = new Playlist($db, $playlistId);
$owner = new User($db, $playlist->getOwner());
?>

<div class="entityInfo">
	<div class="leftSection">
		<div class="playlistImage">
			<img src="assets/images/icons/playlist.png" alt="playlist image">
		</div>
	</div>
	<div class="rightSection">
		<h2><?php echo $playlist->getName(); ?></h2>
		<p>By <?php echo $playlist->getOwner(); ?></p>
		<p><?php echo $playlist->getNumberOfSongs(); ?> song(s)</p>
		<button class="button spoticlone">DELETE PLAYLIST</button>
	</div>
</div>

<div class="tracklistContainer">
	<ul class="tracklist">
		<?php
		$songIdArray = $playlist->getSongIds();

		$i = 1;
		foreach ($songIdArray as $songId) {
			$playlistSong = new Song($db, $songId);
			$songArtist = $playlistSong->getArtist();
			echo <<<EOT
		<li class="tracklistRow">
			<div class="trackCount">
				<img class="play" src="assets/images/icons/play-white.png" onclick="setTrack('
EOT;
			echo $playlistSong->getId();
			echo <<<EOT
		', tempPlaylist, true)">
				<span class="trackNumber">$i</span>
			</div>
			<div class="trackInfo">
				<span class="trackName">
EOT;
			echo $playlistSong->getTitle();
			echo <<<EOT
				</span>
				<span class="trackArtist">
EOT;
			echo $songArtist->getName();
			echo <<<EOT
				</span>
			</div>
			<div class="trackOptions">
				<img class="optionsButton" src="assets/images/icons/more.png">
			</div>
			<div class="trackDuration">
				<span class="duration">
EOT;
			echo $playlistSong->getDuration();
			echo <<<EOT
				</span>
			</div>
		</li>
EOT;
			$i++;
		}
		?>
		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>
	</ul>
</div>
<h1 class="pageHeadingBig">You Might Also Like</h1>