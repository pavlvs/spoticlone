<?php
include "includes/header.php";
if (isset($_GET['id'])) {
	$albumId = $_GET['id'];
} else {
	header("Location: index.php");
}

$album = new Album($con, $albumId);

$artist = $album->getArtist();

?>
<div class="entityInfo">
	<div class="leftSection">
		<img src="<?php echo $album->getArtwork(); ?>" alt="">
	</div>
	<div class="rightSection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p>By <?php echo $artist->getName(); ?></p>
		<p><?php echo $album->getNumberOfSongs(); ?> song(s)</p>
	</div>
</div>

<div class="tracklistContainer">
	<ul class="tracklist">
		<?php
$songIdArray = $album->getSongIds();

$i = 1;
foreach ($songIdArray as $songId) {
	$albumSong = new Song($con, $songId);
	$albumArtist = $albumSong->getArtist();
	echo <<<EOT
<li class="tracklistRow">
	<div class="trackCount">
		<img class="play" src="assets/images/icons/play-white.png">
		<span class="trackNumber">$i</span>
	</div>
</li>
EOT;
	$i++;
}
?>
	</ul>
</div>
<h1 class="pageHeadingBig">You Might Also Like</h1>
<?php include "includes/footer.php"?>

