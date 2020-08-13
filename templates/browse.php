<?php include 'includes/header.php' ?>
<h1 class="pageHeadingBig">You Might Also Like</h1>
<div class="gridViewContainer">

    <?php foreach ($albums as $album) : ?>
        <div class="gridViewItem">
            <span role="link" tabindex="0" onclick="openPage('album.php?id='.<?= $album->id ?>)">
                <img src="<?= $album->artworkPath ?>" alt="">
                <div class="gridViewInfo">
                    <?= $album->title ?>
                </div>
            </span>
        </div>
    <?php endforeach; ?>
</div>
<?php include 'includes/footer.php' ?>