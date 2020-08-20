<?php
include 'includes/includedFiles.php';
?>

<div class="searchContainer">
    <h4>Search for an album, artist or song</h4>
    <input type="text" name="" value="<?= $term; ?>" placeholder="Start typing..." id="searchInput" class="searchInput" onfocus="this.selectionStart = this.selectionEnd = this.value.length;">
</div>

<?php
if ($term == "") {
    exit();
}
?>

<div class="tracklistContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="tracklist">

        <?php if (count($songs) == 0) : ?>
            <span class="noResults">
                No songs found matching <?= $term ?>
            </span>
        <?php endif; ?>

        <?php
        $songIdArray = array();
        $i = 0;
        ?>

        <?php foreach ($songs as $song) :
            if ($i > 15) {
                break;
            }
            array_push($songIdArray, $song->id);
            $albumSong = new Song($song->id);
            $albumArtist = $albumSong->getArtist();
            $i++;
        ?>
            <li class="tracklistRow">
                <div class="trackCount">
                    <img class="play" id="searchSongBtn" src="<?= IMG_FOLDER ?>icons/play-white.png" data-songid="<?= $albumSong->getId() ?>">
                    <span class="trackNumber">
                        <?= $i ?>
                    </span>
                </div>
                <div class="trackInfo">
                    <span class="trackName">
                        <?= $albumSong->getTitle() ?>
                    </span>
                    <span class="trackArtist" data-link="<?= BASE_URI ?>public/index.php?action?showartist&artistId=<?= $albumArtist->getId() ?>">
                        <?= $albumArtist->getName(); ?>
                    </span>
                </div>
                <div class="trackOptions">
                    <img class="optionsButton" src="<?= IMG_FOLDER ?>icons/more.png">
                </div>
                <div class="trackDuration">
                    <span class="duration">
                        <?= $albumSong->getDuration() ?>
                    </span>
                </div>
            </li>

        <?php endforeach; ?>
        <script>
            var tempSongIds = '<?= json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>

<div class="artistContainer borderBottom">
    <h2>ARTISTS</h2>

    <?php if (count($artists) == 0) : ?>
        <span class="noResults">No artists found matching <?= $term ?></span>
    <?php endif; ?>

    <?php foreach ($artists as $artist) : ?>

        <div class="searchResultsRow">
            <div class="artistName">
                <span id="artistLink" class="" role="link" tabindex="0" data-link="<?= BASE_URI ?>public/index.php?action=showartist&artistId=<?= $artist->id ?>">
                    <?= $artist->name ?>
                </span>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="gridViewContainer">
    <h2>ALBUMS</h2>

    <?php if (count($albums) == 0) : ?>
        <span class="noResults">
            No albums found matching <?= $term ?>
        </span>
    <?php endif; ?>

    <?php foreach ($albums as $album) : ?>
        <div class="gridViewItem">
            <span role="link" tabindex="0">
                <img src="<?= $album->artworkPath ?>">
                <div class="gridViewInfo">
                    <?= $album->title ?>
                </div>
            </span>
        </div>
    <?php endforeach; ?>
</div>