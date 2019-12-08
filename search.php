<?php
include 'includes/includedFiles.php';

if(isset($_GET['term'])){
    $term = urldecode($_GET['term']);
} else {
    $term = "";
}
?>

<div class="searchContainer">
    <h4>Search for an album, artist or song</h4>
    <input type="text" name="" value="<?php echo $term; ?>" placeholder="Start typing..." class="searchInput" onfocus="this.selectionStart = this.selectionEnd = this.value.length;">
</div>

<script type="text/javascript">
    $('.searchInput').focus();
    $(function(){
        var timer;

        $('.searchInput').keyup(function () {
            clearTimeout(timer);

            timer = setTimeout(function () {
                var val = $('.searchInput').val();
                openPage("search.php?term=" + val);
            }, 2000);
        })
    })
</script>


<div class="tracklistContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="tracklist">
        <?php
            $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '$term%'");
            if (mysqli_num_rows($songsQuery) == 0) {
                echo "<span class='noResults'>No songs found matching " . $term ."</span>";
            }
            $songIdArray = array();

        $i = 1;
    while ($row = mysqli_fetch_array($songsQuery)) {

            if ($i > 15) {
                break;
            }
            array_push($songIdArray, $row['id']);
            $albumSong = new Song($con, $row['id']);
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
