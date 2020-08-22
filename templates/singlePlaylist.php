<?php
include_once "includes/includedFiles.php";

$owner = new User($playlist->getOwner());
?>

<div class="entityInfo">
    <div class="leftSection">
        <div class="playlistImage">
            <img src="<?= IMG_FOLDER ?>icons/playlist.png" alt="playlist image">
        </div>
    </div>
    <div class="rightSection">
        <h2><?= $playlist->getName(); ?></h2>
        <p>By <?= $playlist->getOwner(); ?></p>
        <p><?= $playlist->getNumberOfSongs(); ?> song(s)</p>
        <button class="button spoticlone">DELETE PLAYLIST</button>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
        $songIdArray = $playlist->getSongIds();
        $i = 0;
        ?>
        <?php foreach ($songIdArray as $songId) :
            $playlistSong = new Song($songId);
            $songArtist = $playlistSong->getArtist();
            $i++;
        ?>
            <li class="tracklistRow">
                <div class="trackCount">
                    <img class="play" src="<?= IMG_FOLDER ?>icons/play-white.png" id="playlistSongBtn" data-songid="<?= $playlistSong->getId() ?>">
                    <span class="trackNumber">
                        <?= $i ?>
                    </span>
                </div>
                <div class="trackInfo">
                    <span class="trackName">
                        <?= $playlistSong->getTitle() ?>
                    </span>
                    <span class="trackArtist">
                        <?= $songArtist->getName() ?>
                    </span>
                </div>
                <div class="trackOptions">
                    <img class="optionsButton" src="<?= IMG_FOLDER ?>icons/more.png">
                </div>
                <div class="trackDuration">
                    <span class="duration">
                        <?= $playlistSong->getDuration() ?>
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
<h1 class="pageHeadingBig">You Might Also Like</h1>