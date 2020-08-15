<?php
include 'includes/includedFiles.php';

if (isset($_GET['id'])) {
    $artistId = $_GET['id'];
} else {
    header("Location: index.php");
}

$artist = new Artist($db, $artistId);
?>

<div class="entityInfo borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName">
                <?= $artist->getName(); ?>
            </h1>
            <div class="headerButtons">
                <button class="button spoticlone" onclick="playFirstSong()">PLAY</button>
            </div>
        </div>
    </div>
</div>

<div class="tracklistContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="tracklist">
        <?php
        $songIdArray = $artist->getSongIds();

        $i = 1;
        foreach ($songIdArray as $songId) {

            if ($i > 5) {
                break;
            }

            $albumSong = new Song($db, $songId);
            $albumArtist = $albumSong->getArtist();

            echo <<<EOT
            <li class="tracklistRow">
            <div class="trackCount">
            <img class="play" src="<?= IMG_FOLDER ?>icons/play-white.png" onclick="setTrack('
EOT;
            echo $albumSong->getId();
            echo <<<EOT
            ', tempPlaylist, true)">
            <span class="trackNumber">$i</span>
            </div>
            <div class="trackInfo">
                <span class="trackName">
EOT;
            echo $albumSong->getTitle();
            echo <<<EOT
                </span>
                <span class="trackArtist">
EOT;
            echo $albumArtist->getName();
            echo <<<EOT
                </span>
            </div>
            <div class="trackOptions">
                <img class="optionsButton" src="<?= IMG_FOLDER ?>icons/more.png">
            </div>
            <div class="trackDuration">
                <span class="duration">
EOT;
            echo $albumSong->getDuration();
            echo <<<EOT
                </span>
            </div>
        <   /li>
EOT;
            $i++;
        }
        ?>
        <script>
            var tempSongIds = '<?= json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>
<div class="gridViewContainer">
    <h2>ALBUMS</h2>
    <?php
    $albumQuery = mysqli_query($db, "SELECT * FROM albums WHERE artist='$artistId'");

    while ($row = mysqli_fetch_array($albumQuery)) {
        echo "<div class='gridViewItem'>
        <span role='link' tabindex='0' onclick='openPage(\"album.php?id="
            . $row['id'] .
            "\")'>
            <img src='"
            . $row['artworkPath'] .
            "'><div class='gridViewInfo'>"
            . $row['title'] .
            "</div>
        </span>
        </div>";
    }
    ?>
</div>