<?php
include 'includes/includedFiles.php';

if(isset($_GET['id'])){
    $artistId = $_GET['id'];
}else {
    header("Location: index.php");
}

$artist = new Artist($con, $artistId);
?>

<div class="entityInfo borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName">
                <?php echo $artist->getName(); ?>
            </h1>
            <div class="headerButtons">
                <button class="button spoticlone">PLAY</button>
            </div>
        </div>
    </div>
</div>

<div class="tracklistContainer borderBottom">
    <ul class="tracklist">
        <?php
            $songIdArray = $artist->getSongIds();

        $i = 1;
        foreach ($songIdArray as $songId) {

            if ($i > 5) {
                break;
            }

            $albumSong = new Song($con, $songId);
            $albumArtist = $albumSong->getArtist();

            echo <<<EOT
            <li class="tracklistRow">
            <div class="trackCount">
            <img class="play" src="assets/images/icons/play-white.png" onclick="setTrack('
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
                <img class="optionsButton" src="assets/images/icons/more.png">
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
<script >
    var tempSongIds = '<?php echo json_encode($songIdArray);?>';
    tempPlaylist = JSON.parse(tempSongIds);
</script>
    </ul>
</div>