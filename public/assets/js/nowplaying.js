$(function () {
    $('#mainContent').load(encodeURI(window.location.href));
    let mousedown = false;
    class Audio {
        audio;
        currentlyPlaying;
        constructor() {
            this.audio = document.createElement('audio');
        }

        setTrack(track) {
            this.currentlyPlaying = track;
            this.audio.src = track.path;
        }

        play() {
            this.audio.play();
        }

        pause() {
            this.audio.pause();
        }

        setTime(seconds) {
            this.audio.currentTime = seconds;
        }
    }

    audioElement = new Audio();
    let audio = audioElement.audio;

    currentPlaylist = setPlaylist();
    track = parseInt(currentPlaylist[0]);
    setTrack(track, currentPlaylist, false);
    updateTimeProgressbar(audio);
    //audioElement.play();

    // ==============  EVENT LISTENERS ==============

    $('#nowPlayingBarContainer').on(
        'mousedown touchstart mousemove touchmove',
        function (e) {
            e.preventDefault();
        }
    );

    $('#homeLink').click(function () {
        openPage($(this).attr('data-link'));
    });

    $('#browseLink').click(function () {
        openPage($(this).attr('data-link'));
    });

    $('.navItemLink').click(function () {
        openPage($(this).attr('data-link'));
    });

    $('#playBtn').click(function () {
        $('#playBtn').hide();
        $('#pauseBtn').show();
        playSong();
    });

    $('#pauseBtn').click(function () {
        $('#playBtn').show();
        $('#pauseBtn').hide();
        pauseSong();
    });

    $('.playbackBar .progressBar').mousedown(function () {
        mousedown = true;
    });

    $('.playbackBar .progressBar').mousemove(function (e) {
        if (mousedown) {
            //set time of song depending on mouse position
            timeFromOffset(e, this);
        }
    });

    $('.playbackBar .progressBar').mouseup(function (e) {
        //set time of song depending on mouse position
        timeFromOffset(e, this);
    });

    $('.volumeBar .progressBar').mousedown(function () {
        mousedown = true;
    });

    $('.volumeBar .progressBar').mousemove(function (e) {
        if (mousedown) {
            let percentage = e.offsetX / $(this).width();
            if (percentage >= 0 && percentage <= 1) {
                audio.volume = percentage;
            }
        }
    });

    $('.volumeBar .progressBar').mouseup(function (e) {
        let percentage = e.offsetX / $(this).width();
        if (percentage >= 0 && percentage <= 1) {
            audio.volume = percentage;
        }
    });

    $(document).mouseup(function () {
        mousedown = false;
    });

    audio.addEventListener('canplay', function () {
        let duration = formatTime(audio.duration);
        $('#timeRemaining').text(duration);
    });

    audio.addEventListener('timeupdate', function () {
        if (audio.duration) {
            updateTimeProgressbar(audio);
        }
    });

    audio.addEventListener('volumechange', function () {
        updateVolumeBar(audio);
    });

    // ============== FUNCTIONS ==============

    //ajax call to get and set song track info
    function setTrack(trackId, newPlaylist, play) {
        $.post(
            '../includes/handlers/ajax/getRecordJson.php',
            {
                table: 'songs',
                id: trackId,
            },
            function (data) {
                let track = JSON.parse(data);
                $('#trackName').text(track.title);

                $.post(
                    '../includes/handlers/ajax/getRecordJson.php',
                    {
                        table: 'artists',
                        id: track.artist,
                    },
                    function (data) {
                        let artist = JSON.parse(data);
                        $('#artistName').text(artist.name);
                    }
                );
                $.post(
                    '../includes/handlers/ajax/getRecordJson.php',
                    {
                        table: 'albums',
                        id: track.album,
                    },
                    function (data) {
                        let album = JSON.parse(data);
                        const artworkDir = '../public/';
                        $('#albumArtwork').attr(
                            'src',
                            artworkDir + album.artworkPath
                        );
                    }
                );
                audioElement.setTrack(track);
            }
        );
        if (play) {
            audioElement.play();
        }
    }

    //ajax callto get a random array of 10 songs
    function setPlaylist() {
        $.ajaxSetup({ async: false }); //execute synchronously
        var returnData = null;
        $.post(
            '../includes/handlers/ajax/getJsonArrayOfSongs.php',
            {},
            function (data) {
                data = JSON.parse(data);
                returnData = data;
            }
        );
        $.ajaxSetup({ async: true }); //return to default setting
        return returnData;
    }

    function playSong() {
        if (audio.currentTime == 0) {
            let songId = parseInt(audioElement.currentlyPlaying.id);
            $.post(
                '../includes/handlers/ajax/updatePlays.php',
                {
                    songId: songId,
                },
                function (data) {}
            );
            console.log('update count');
        } else {
            console.log("don't update count");
        }
        audioElement.play();
    }

    function pauseSong() {
        audioElement.pause();
    }

    function openPage(url) {
        if (timer != null) {
            clearTimeout(timer);
        }

        if (url.indexOf('?') == -1) {
            url = url + '?';
        }
        var encodedUrl = encodeURI(url + '&userLoggedIn=' + userLoggedIn);
        console.log('happening');
        $('#mainContent').load(encodedUrl);

        $('body').scrollTop(0);
        history.pushState(null, null, url);
    }
    //playSong();

    function formatTime(seconds) {
        seconds = Math.round(seconds);
        minutes = Math.floor(seconds / 60);
        seconds = seconds - minutes * 60;
        extrazero = seconds < 10 ? '0' : '';
        timeFormatted = minutes + ':' + extrazero + seconds;
        return timeFormatted;
    }

    function updateTimeProgressbar(audio) {
        $('#currentTime').text(formatTime(audio.currentTime));
        $('#timeRemaining').text(
            formatTime(audio.duration - audio.currentTime)
        );
        let progress = (audio.currentTime / audio.duration) * 100;
        $('#progressTime').css('width', progress + '%');
    }

    function updateVolumeBar(audio) {
        let volume = audio.volume * 100;
        $('#progressVolume').css('width', volume + '%');
    }

    function timeFromOffset(mouse, progressBar) {
        let percentage = (mouse.offsetX / $(progressBar).width()) * 100;
        let seconds = audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }
});
