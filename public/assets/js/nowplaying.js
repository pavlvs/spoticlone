$(function () {
    $('#mainContent').load(encodeURI(window.location.href), function () {});
    const iconsFolder = 'assets/images/icons/';
    let repeat = false;
    let shuffle = false;
    let mousedown = false;
    let currentIndex = 0;
    let currentPlaylist = [];
    let shufflePlaylist = [];
    let albumPlaylist = [];
    let artistPlaylist = [];
    let timer;
    let userLoggedIn;

    const urlParams = new URLSearchParams(window.location.href);
    const albumId = urlParams.get('albumId');
    const artistId = urlParams.get('artistId');

    albumPlaylist = setTempPlayList('albums');
    artistPlaylist = setTempPlayList('artists');

    userLoggedIn = setUserLoggedIn();
    console.log(userLoggedIn);
    //loadPage();

    class Audio {
        audio;
        currentlyPlaying;
        constructor() {
            this.audio = document.createElement('audio');
        }

        setTrack(track) {
            this.currentlyPlaying = track;
            this.audio.src = track.path;
            //this.play();
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

    let newPlaylist = setPlaylist();
    setTrack(newPlaylist[0], newPlaylist, false);
    updateTimeProgressbar(audio);

    // ==============  EVENT LISTENERS ==============

    $('#nowPlayingBarContainer').on(
        'mousedown touchstart mousemove touchmove',
        function (e) {
            e.preventDefault();
        }
    );

    $(document).on('click', '.albumLink', function () {
        openPage($(this).attr('data-link'));
    });

    $(document).on('click', '#artistLink', function () {
        openPage($(this).attr('data-link'));
    });

    $(document).on('click', '#artistAlbumLink', function () {
        openPage($(this).attr('data-link'));
    });

    $(document).on('click', '#playFirstSong', function () {
        playFirstSong();
    });

    $('#homeLink').click(function () {
        openPage($(this).attr('data-link'));
    });

    $('#browseLink').click(function () {
        openPage($(this).attr('data-link'));
    });

    $('.navItemLink').click(function () {
        openPage($(this).attr('data-link'));
    });

    $('#albumArtwork').click(function () {
        openPage($(this).attr('data-link'));
    });

    $('#trackName').click(function () {
        openPage($(this).attr('data-link'));
    });

    $('#artistName').click(function () {
        openPage($(this).attr('data-link'));
    });

    $('#playBtn').click(function () {
        playSong();
    });

    $('#pauseBtn').click(function () {
        pauseSong();
    });

    $('#nextBtn').click(function () {
        nextSong();
    });

    $('#repeatBtn').click(function () {
        setRepeat();
    });

    $('#previousBtn').click(function () {
        prevSong();
    });

    $('#muteIcon').click(function () {
        setMute();
    });

    $('#shuffleBtn').click(function () {
        setShuffle();
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

    $(document).on('click', '#albumSongBtn', function () {
        console.log($(this).attr('data-songid'));
        songId = $(this).attr('data-songid');
        setTrack(songId, albumPlaylist, true);
    });

    $(document).on('click', '#artistSongBtn', function () {
        console.log($(this).attr('data-songid'));
        songId = $(this).attr('data-songid');
        setTrack(songId, artistPlaylist, true);
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

    audio.addEventListener('ended', function () {
        nextSong();
    });

    // ============== FUNCTIONS ==============

    //ajax call to get and set song track info
    function setTrack(trackId, newPlaylist, play) {
        if (newPlaylist != currentPlaylist) {
            currentPlaylist = newPlaylist;
            shufflePlaylist = currentPlaylist.slice();
            shuffleArray(shufflePlaylist);
        }
        currentIndex = shuffle
            ? shufflePlaylist.indexOf(trackId)
            : currentPlaylist.indexOf(trackId);

        pauseSong();

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
                        $('#artistName').attr(
                            'data-link',
                            'index.php?action=showartist&artistId=' + artist.id
                        );
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
                        $('#albumArtwork').attr(
                            'data-link',
                            'index.php?action=showalbum&albumId=' + album.id
                        );
                        $('#trackName').attr(
                            'data-link',
                            'index.php?action=showalbum&albumId=' + album.id
                        );
                    }
                );
                audioElement.setTrack(track);
                if (play) {
                    playSong();
                }
            }
        );
    }

    //ajax callto get a random array of 10 initial songs
    function setPlaylist() {
        $.ajaxSetup({ async: false }); //execute synchronously
        var returnData = null;
        $.post(
            '../includes/handlers/ajax/getJsonArrayOfSongs.php',
            {},
            function (data) {
                data = JSON.parse(data);
                songIds = [];
                data.forEach((element) => {
                    element = parseInt(element);
                    songIds.push(element);
                });

                returnData = songIds;
            }
        );
        $.ajaxSetup({ async: true }); //return to default setting
        return returnData;
    }

    function playFirstSong() {
        setTrack(artistPlaylist[0], artistPlaylist, true);
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
        $('#playBtn').hide();
        $('#pauseBtn').show();
        audioElement.play();
    }

    function pauseSong() {
        $('#playBtn').show();
        $('#pauseBtn').hide();
        audioElement.pause();
    }

    function prevSong() {
        if (audioElement.audio.currentTime >= 3 || currentIndex == 0) {
            audioElement.setTime(0);
        } else {
            currentIndex--;
            setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
        }
    }

    function nextSong() {
        if (repeat) {
            audioElement.setTime(0);
            playSong();
            return;
        }
        if (currentIndex == currentPlaylist.length - 1) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }

        let trackToPlay = shuffle
            ? shufflePlaylist[currentIndex]
            : currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);
    }

    function setRepeat() {
        repeat = !repeat;
        let repeatIcon = repeat ? 'repeat-active.png' : 'repeat.png';
        $('#repeatBtn img').attr('src', iconsFolder + repeatIcon);
    }

    function setMute() {
        audioElement.audio.muted = !audioElement.audio.muted;
        let muteIcon = audioElement.audio.muted
            ? 'volume-mute.png'
            : 'volume.png';
        $('#muteIcon').attr('src', iconsFolder + muteIcon);
    }

    function setShuffle() {
        shuffle = !shuffle;
        let shuffleIcon = shuffle ? 'shuffle-active.png' : 'shuffle.png';
        $('#shuffleIcon').attr('src', iconsFolder + shuffleIcon);

        if (shuffle) {
            //radomize playlist
            shuffleArray(shufflePlaylist);
            currentIndex = shufflePlaylist.indexOf(
                audioElement.currentlyPlaying.id
            );
        } else {
            //regular playlist
            currentIndex = currentPlaylist.indexOf(
                audioElement.currentlyPlaying.id
            );
        }
    }

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    // load pages into mainContainer through ajax
    function openPage(url) {
        if (timer != null) {
            clearTimeout(timer);
        }

        if (url.indexOf('?') == -1) {
            url = url + '?';
        }
        var encodedUrl = encodeURI(url + '&userLoggedIn=' + userLoggedIn);
        $('#mainContent').load(encodedUrl);

        $('body').scrollTop(0);
        history.pushState(null, null, url);
    }

    function loadPage() {
        url = window.location.href;
        let encodedUrl = encodeURI(url);
        $('#mainContent').load(encodedUrl);
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

    //ajax call to get the song ids for a table playlist
    function setTempPlayList(table) {
        $.ajaxSetup({ async: false }); //execute synchronously
        var returnData = null;
        if (table == 'albums') {
            $.post(
                '/sandbox/spoticlone/public/index.php?action=albumplaylist',
                {
                    albumId: albumId,
                },
                function (data) {
                    data = JSON.parse(data);
                    songIds = [];
                    data.forEach((element) => {
                        element = parseInt(element);
                        songIds.push(element);
                    });
                    returnData = songIds;
                }
            );
        } else {
            $.post(
                '/sandbox/spoticlone/public/index.php?action=artistplaylist',
                {
                    artistId: artistId,
                },
                function (data) {
                    data = JSON.parse(data);
                    songIds = [];
                    data.forEach((element) => {
                        element = parseInt(element);
                        songIds.push(element);
                    });
                    returnData = songIds;
                }
            );
        }

        $.ajaxSetup({ async: true }); //return to default setting
        return returnData;
    }

    //ajax call to get the song ids for the single album page playlist
    function setArtistPlayList(albumId) {
        $.ajaxSetup({ async: false }); //execute synchronously
        var returnData = null;
        $.post(
            '/sandbox/spoticlone/public/index.php?action=artistplaylist',
            {
                albumId: albumId,
            },
            function (data) {
                data = JSON.parse(data);
                songIds = [];
                data.forEach((element) => {
                    element = parseInt(element);
                    songIds.push(element);
                });
                returnData = songIds;
            }
        );
        $.ajaxSetup({ async: true }); //return to default setting
        return returnData;
    }

    function setUserLoggedIn() {
        $.ajaxSetup({ async: false }); //execute synchronously
        var returnData = null;
        $.post(
            '/sandbox/spoticlone/public/index.php?action=userloggedin',
            {},
            function (data) {
                returnData = data;
            }
        );
        $.ajaxSetup({ async: true }); //return to default setting
        return returnData;
    }
});
