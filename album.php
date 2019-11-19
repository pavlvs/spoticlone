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
		<span>By <?php echo $artist->getName(); ?></span>
	</div>
</div>
<h1 class="pageHeadingBig">You Might Also Like</h1>
<?php include "includes/footer.php"?>

