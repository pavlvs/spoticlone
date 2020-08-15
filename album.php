<?php
include "includes/includedFiles.php";
if (isset($_GET['id'])) {
	$albumId = $_GET['id'];
} else {
	header("Location: index.php");
}

$album = new Album($albumId);

$artist = $album->getArtist();

?>
<div class="entityInfo">
	<div class="leftSection">
		<img src="<?= $album->getArtwork(); ?>" alt="">
	</div>
	<div class="rightSection">
		<h2><?= $album->getTitle(); ?></h2>
		<p>By <?= $artist->getName(); ?></p>
		<p><?= $album->getNumberOfSongs(); ?> song(s)</p>
	</div>
</div>

<div class="tracklistContainer">
	<ul class="tracklist">
		<?php
		$songIdArray = $album->getSongIds();

		$i = 1;
		foreach ($songIdArray as $songId) {
			$albumSong = new Song($db, $songId);
			$albumArtist = $albumSong->getArtist();
			echo <<<EOT
<li class="tracklistRow">
	<div class="trackCount">
		<img class="play" src="<?= IMG_FOLDER ?>icons/play-white.png" onclick="setTrack('
EOT;
			echo $albumSong->getId();
			echo <<<EOT
', tempPlaylist, true)">
		<span class="trackNumber">$i</span>
	</div>
	<div class="trackInfo">
		<span class="trackName">
EOT;
			echo $albumSong->getTitle();
			echo <<<EOT
		</span>
		<span class="trackArtist">
EOT;
			echo $albumArtist->getName();
			echo <<<EOT
		</span>
	</div>
	<div class="trackOptions">
		<img class="optionsButton" src="<?= IMG_FOLDER ?>icons/more.png">
	</div>
	<div class="trackDuration">
		<span class="duration">
EOT;
			echo $albumSong->getDuration();
			echo <<<EOT
		</span>
	</div>
</li>
EOT;
			$i++;
		}
		?>
		<script>
			var tempSongIds = '<?= json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>
	</ul>
</div>
<h1 class="pageHeadingBig">You Might Also Like</h1>