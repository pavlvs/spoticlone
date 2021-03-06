<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">

        <div id="nowPlayingLeft">
            <div class="content">
                <span id="albumLink" class="albumLink">
                    <img src="" alt="square" id="albumArtwork" class="albumArtwork" role='link' tabindex='0' id="trackName" data-link="">
                </span>
                <div class="trackInfo">
                    <span id="trackName" class="trackName" role='link' tabindex='0' data-link="">
                    </span>
                    <span id="artistName" class="artistName" role='link' tabindex='0' data-link="">
                    </span>
                </div>
            </div>
        </div>
        <!--End of nowPlayingLeft -->

        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <button id="shuffleBtn" class="controlButton shuffle" title="Shuffle button">
                        <img src="<?= IMG_FOLDER ?>icons/shuffle.png" alt="shuffle button" id="shuffleIcon">
                    </button>

                    <button id="previousBtn" class="controlButton previous" title="previous button">
                        <img src="<?= IMG_FOLDER ?>icons/previous.png" alt="previous button">
                    </button>

                    <button id="playBtn" class="controlButton play" title="play button">
                        <img src="<?= IMG_FOLDER ?>icons/play.png" alt="play button">
                    </button>

                    <button id="pauseBtn" class="controlButton pause" title="pause button" style="display:none">
                        <img src="<?= IMG_FOLDER ?>icons/pause.png" alt="pause button">
                    </button>

                    <button id="nextBtn" class="controlButton next" title="next button">
                        <img src="<?= IMG_FOLDER ?>icons/next.png" alt="next button">
                    </button>

                    <button id="repeatBtn" class="controlButton repeat" title="repeat button">
                        <img src="<?= IMG_FOLDER ?>icons/repeat.png" alt="repeat button" id="#repeatIcon">
                    </button>
                </div>

                <div class="playbackBar">
                    <span id="currentTime" class="progressTime current">
                        0:00
                    </span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div id="progressTime" class="progress">
                            </div>
                        </div>
                    </div>
                    <span id="timeRemaining" class="progressTime remaining">
                        0:00
                    </span>
                </div>

            </div>
        </div>
        <!--End of nowPlayingCenter -->

        <div id="nowPlayingRight">
            <div class="volumeBar">
                <button id="volumeBtn" class="controlButton volume" title="volume button">
                    <img src="<?= IMG_FOLDER ?>icons/volume.png" alt="volume button" id="muteIcon">
                </button>
                <div class="progressBar">
                    <div class="progressBarBg">
                        <div id="progressVolume" class="progress">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of nowPlayingRight -->

    </div>
    <!--End of nowPlayingBar -->

</div>
<!--End of nowPlayingBarContainer -->