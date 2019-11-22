<?php
$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
$resultArray = array();
while ($row = mysqli_fetch_array($songQuery)) {
	array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);
?>
<script>
    $(function() {
        currentPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        setTrack(currentPlaylist[0], currentPlaylist, false);
    });

    function setTrack(trackId, newPlaylist, play) {
        audioElement.setTrack("assets/music/bensound-clearday.mp3");
        if (play) {
            audioElement.play();
        }
    }
</script>
<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                    <img src="assets/images/square.jpg" alt="square" class="albumArtwork">
                </span>
                <div class="trackInfo">
                    <span class="trackName">
                        Happy Foo
                    </span>
                    <span class="artistName">
                        Pavlvs X
                    </span>
                </div>
            </div>
        </div>
        <!--End of nowPlayingLeft -->
        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle button"><img src="assets/images/icons/shuffle.png" alt="shuffle button"></button>
                    <button class="controlButton previous" title="previous button"><img src="assets/images/icons/previous.png" alt="previous button"></button>
                    <button class="controlButton play" title="play button"><img src="assets/images/icons/play.png" alt="play button"></button>
                    <button class="controlButton pause" title="pause button" style="display:none"><img src="assets/images/icons/pause.png" alt="pause button"></button>
                    <button class="controlButton next" title="next button"><img src="assets/images/icons/next.png" alt="next button"></button>
                    <button class="controlButton repeat" title="repeat button"><img src="assets/images/icons/repeat.png" alt="repeat button"></button>
                </div>
                <div class="playbackBar">
                    <span class="progressTime current">0:00</span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress"></div>
                        </div>
                    </div>
                    <span class="progressTime remaining">0:00</span>
                </div>
            </div>
        </div>
        <!--End of nowPlayingCenter -->
        <div id="nowPlayingRight">
            <div class="volumeBar">
                <button class="controlButton volume" title="volume button"><img src="assets/images/icons/volume.png" alt="volume button"></button>
                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of nowPlayingRight -->
    </div>
    <!--End of nowPlayingBar -->
</div>
<!--End of nowPlayingBarContainer -->