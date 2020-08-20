<?php
include 'includes/includedFiles.php';
?>

<div class="entityInfo borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName">
                <?= $artist->getName(); ?>
            </h1>
            <div class="headerButtons">
                <button class="button spoticlone" id="playFirstSong">PLAY</button>
            </div>
        </div>
    </div>
</div>

<div class="tracklistContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="tracklist">
        <?php
        $songIdArray = $artist->getSongIds();
        $i = 0;
        ?>
        <?php foreach ($songIdArray as $songId) :
            if ($i > 5) {
                break;
            }
            $albumSong = new Song($songId);
            $albumArtist = $albumSong->getArtist();
            $i++;
        ?>
            <li class="tracklistRow">
                <div class="trackCount">
                    <img class="play" src="<?= IMG_FOLDER ?>icons/play-white.png" id="artistSongBtn" data-songid="<?= $albumSong->getId() ?>">
                    <span class="trackNumber">
                        <?= $i ?>
                    </span>
                </div>
                <div class="trackInfo">
                    <span class="trackName">
                        <?= $albumSong->getTitle() ?>
                    </span>
                    <span class="trackArtist">
                        <?= $albumArtist->getName() ?>
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
    </ul>
</div>
<div class="gridViewContainer">
    <h2>ALBUMS</h2>
    <?php foreach ($albums as $album) : ?>
        <div class="gridViewItem">
            <span role="link" tabindex="0" id="artistAlbumLink" data-link="<?= BASE_URI ?>public/index.php?action=showAlbum&albumId=<?= $album->id ?>">
                <img src=" <?= $album->artworkPath ?> ">
                <div class="gridViewInfo">
                    <?= $album->title ?>
                </div>
            </span>
        </div>
    <?php endforeach; ?>
</div>