<?php
include "includes/includedFiles.php";
?>
<h1 class="pageHeadingBig">You Might Also Like</h1>
<div class="gridViewContainer">
	<?php
	$sql = "SELECT *
			FROM albums
			ORDER BY rand()
			LIMIT 10";

	$albums = mysqli_query($db, $sql);
	?>
	<?php while ($album = mysqli_fetch_assoc($albums)) : ?>
		<div class="gridViewItem">
			<span role="link" tabindex="0" class="albumLink" data-link="index.php?action=showAlbum&id='.<?= $album['id'] ?>)">
				<img src="<?= $album['artworkPath'] ?>" alt="">
				<div class="gridViewInfo">
					<?= $album['title'] ?>
				</div>
			</span>
		</div>
	<?php endwhile; ?>
</div>