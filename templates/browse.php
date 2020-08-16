<?php include 'includes/includedFiles.php'; ?>

<h1 class="pageHeadingBig">You Might Also Like</h1>
<div class="gridViewContainer">

    <?php foreach ($albums as $album) : ?>
        <div class="gridViewItem">
            <span role="link" tabindex="0" class="albumLink" data-link="<?= BASE_URI ?>templates/album.php?id=<?= $album->id ?>&action=showAlbum">
                <img src="<?= $album->artworkPath ?>" alt="">
                <div class="gridViewInfo">
                    <?= $album->title ?>
                </div>
            </span>
        </div>
    <?php endforeach; ?>
    <?php $_SESSION['ajax'] = true; ?>
</div>