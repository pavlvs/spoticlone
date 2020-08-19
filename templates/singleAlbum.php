<?php
include_once "includes/includedFiles.php";
?>
<div class="entityInfo">
    <div class="leftSection">
        <img src="<?= $album->getArtwork(); ?>" alt="<?= $album->getTitle(); ?>">
    </div>
    <div class="rightSection">
        <h2 id="album" data-album="<?= $album->getId() ?>"><?= $album->getTitle(); ?></h2>
        <p role="link" tabindex="0" data-link="artist.php?id=<?= $artist->getId() ?>">
            By <?= $artist->getName(); ?>
        </p>
        <p><?= $album->getNumberOfSongs(); ?> song(s)</p>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
        $songIdArray = $album->getSongIds();
        $i = 0;
        ?>
        <?php foreach ($songIdArray as $songId) :
            $albumSong = new Song($songId);
            $albumArtist = $albumSong->getArtist();
            $i++;
        ?>
            <li class="tracklistRow">
                <div class="trackCount">
                    <img class="play" src="<?= IMG_FOLDER ?>icons/play-white.png?>" data-songid="<?= $albumSong->getId() ?>" data-tempPlayList="true" id="songBtn">
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
                    <img class="optionsButton" src="<?= IMG_FOLDER ?>icons/more.png?>">
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
</div>