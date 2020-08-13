</div>
</div>

<!--End of topContainer -->
<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                    <img src="" alt="square" class="albumArtwork" role='link' tabindex='0'>
                </span>
                <div class="trackInfo">
                    <span class="trackName" role='link' tabindex='0'> </span>
                    <span class="artistName" role='link' tabindex='0' onclick=""></span>
                </div>
            </div>
        </div>
        <!--End of nowPlayingLeft -->
        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle button"><img src="assets/images/icons/shuffle.png" alt="shuffle button" onclick="setShuffle()"></button>
                    <button class="controlButton previous" title="previous button"><img src="assets/images/icons/previous.png" alt="previous button" onclick="prevSong()"></button>
                    <button class="controlButton play" title="play button"><img src="assets/images/icons/play.png" alt="play button" onclick="playSong()"></button>
                    <button class="controlButton pause" title="pause button" style="display:none"><img src="assets/images/icons/pause.png" alt="pause button" onclick="pauseSong()"></button>
                    <button class="controlButton next" title="next button"><img src="assets/images/icons/next.png" alt="next button" onclick="nextSong()"></button>
                    <button class="controlButton repeat" title="repeat button"><img src="assets/images/icons/repeat.png" alt="repeat button" onclick="setRepeat()"></button>
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
                <button class="controlButton volume" title="volume button"><img src="assets/images/icons/volume.png" alt="volume button" onclick="setMute()"></button>
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

</div>
<!--End of mainContainer -->
<script src="../public/assets/js/jquery-3.4.1.js"></script>
<script src="../public/assets/js/script.js"></script>
</body>

</html>