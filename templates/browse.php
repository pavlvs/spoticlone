<?php include_once 'includes/includedFiles.php'; ?>

<h1 class="pageHeadingBig">You Might Also Like</h1>
<div class="gridViewContainer">
    <?php foreach ($albums as $album) : ?>
        <div class="gridViewItem">
            <span role="link" tabindex="0" class="albumLink" data-link="<?= BASE_URI ?>public/index.php?action=showAlbum&albumId=<?= $album->id ?>">
                <img src="<?= $album->artworkPath ?>" alt="">
                <div class="gridViewInfo">
                    <?= $album->title ?>
                </div>
            </span>
        </div>
    <?php endforeach; ?>
</div>