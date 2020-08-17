$(function () {
    $('#mainContent').load(encodeURI(window.location.href));
    var currentPlaylist = [];
    var shuffledPlaylist = [];
    var tempPlaylist = [];
    var audioElement;
    var mouseDown = false;
    var currentIndex = 0;
    var repeat = false;
    var shuffle = false;
    var userLoggedIn;
    var timer;

    $(document).on('click', '.albumLink', function () {
        console.log($(this).attr('data-link'));
        openPage($(this).attr('data-link'));
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

    $('#shuffleBtn').click(function () {
        setShuffle();
    });

    $('#repeatBtn').click(function () {
        setRepeat();
    });

    $('#previousBtn').click(function () {
        prevSong();
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

    $('#volumeBtn').click(function () {
        setMute();
    });

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

    function createPlaylist() {
        var alert = prompt('Please enter the name of your playlist');

        if (alert != null) {
            $.post('includes/handlers/ajax/createPlaylist.php', {
                name: alert,
                username: userLoggedIn,
            }).done(function () {
                //do somethin when ajax returns
                openPage('your_music.php');
            });
        }
    }

    function formatTime(seconds) {
        var time = Math.round(seconds);
        var minutes = Math.floor(time / 60); // Rounds the minutes down
        var seconds = time - minutes * 60;
        var extraZero = seconds < 10 ? '0' : '';

        return minutes + ':' + extraZero + seconds;
    }

    function updateTimeProgressBar(audio) {
        $('.progressTime.current').text(formatTime(audio.currentTime));
        $('.progressTime.remaining').text(
            formatTime(audio.duration - audio.currentTime)
        );

        var progress = (audio.currentTime / audio.duration) * 100;
        $('.playbackBar .progress').css('width', progress + '%');
    }

    function updateVolumeProgressBar(audio) {
        var volume = audio.volume * 100;
        $('.volumeBar .progress').css('width', volume + '%');
    }

    function playFirstSong() {
        setTrack(tempPlaylist[0], tempPlaylist, true);
    }

    function Audio() {
        this.currentlyPlaying;
        this.audio = document.createElement('audio');

        this.audio.addEventListener('ended', function () {
            nextSong();
        });

        this.audio.addEventListener(
            'canplay',
            function () {
                $('.progressTime.remaining').text(formatTime(this.duration));
            },
            false
        );

        this.audio.addEventListener(
            'timeupdate',
            function () {
                if (this.duration) {
                    updateTimeProgressBar(this);
                }
            },
            false
        );

        this.audio.addEventListener('volumechange', function () {
            updateVolumeProgressBar(this);
        });

        this.setTrack = function (track) {
            this.currentlyPlaying = track;
            this.audio.src = track.path;
        };

        this.play = function () {
            this.audio.play();
        };

        this.pause = function () {
            this.audio.pause();
        };

        this.setTime = function (seconds) {
            this.audio.currentTime = seconds;
        };
    }

    var newPlaylist = [];
    audioElement = new Audio();
    // setTrack(newPlaylist[0], newPlaylist, false);
    updateVolumeProgressBar(audioElement.audio);

    $('#nowPlayingBarContainer').on(
        'mousedown touchstart mousemove touchmove',
        function (e) {
            e.preventDefault();
        }
    );

    $('.playbackBar .progressBar').mousedown(function () {
        mouseDown = true;
    });

    $('.playbackBar .progressBar').mousemove(function (e) {
        if (mouseDown == true) {
            //Set time of song, depending on position of mouse
            timeFromOffset(e, this);
        }
    });

    $('.playbackBar .progressBar').mouseup(function (e) {
        timeFromOffset(e, this);
    });

    $('.volumeBar .progressBar').mousedown(function () {
        mouseDown = true;
    });

    $('.volumeBar .progressBar').mousemove(function (e) {
        if (mouseDown == true) {
            var percentage = e.offsetX / $(this).width();

            if (percentage >= 0 && percentage <= 1) {
                audioElement.audio.volume = percentage;
            }
        }
    });

    $('.volumeBar .progressBar').mouseup(function (e) {
        var percentage = e.offsetX / $(this).width();

        if (percentage >= 0 && percentage <= 1) {
            audioElement.audio.volume = percentage;
        }
    });

    $(document).mouseup(function () {
        mouseDown = false;
    });
});

function timeFromOffset(mouse, progressBar) {
    var percentage = (mouse.offsetX / $(progressBar).width()) * 100;
    var seconds = audioElement.audio.duration * (percentage / 100);
    audioElement.setTime(seconds);
}

function prevSong() {
    if (audioElement.audio.currentTime >= 3 || currentIndex == 0) {
        audioElement.setTime(0);
    } else {
        currentIndex = currentIndex - 1;
        setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
}

function nextSong() {
    if (repeat == true) {
        audioElement.setTime(0);
        playSong();
        return;
    }

    if (currentIndex == currentPlaylist.length - 1) {
        currentIndex = 0;
    } else {
        currentIndex++;
    }

    var trackToPlay = shuffle
        ? shufflePlaylist[currentIndex]
        : currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
}

function setRepeat() {
    repeat = !repeat;
    var imageName = repeat ? 'repeat-active.png' : 'repeat.png';
    $('.controlButton.repeat img').attr(
        'src',
        '<?= IMG_FOLDER ?>icons/' + imageName
    );
}

function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted;
    var imageName = audioElement.audio.muted ? 'volume-mute.png' : 'volume.png';
    $('.controlButton.volume img').attr(
        'src',
        '<?= IMG_FOLDER ?>icons/' + imageName
    );
}

function setShuffle() {
    shuffle = !shuffle;
    var imageName = shuffle ? 'shuffle-active.png' : 'shuffle.png';
    $('.controlButton.shuffle img').attr(
        'src',
        '<?= IMG_FOLDER ?>icons/' + imageName
    );

    if (shuffle == true) {
        //Randomize playlist
        shuffleArray(shufflePlaylist);
        currentIndex = shufflePlaylist.indexOf(
            audioElement.currentlyPlaying.id
        );
    } else {
        //shuffle has been deactivated
        //go back to regular playlist
        currentIndex = currentPlaylist.indexOf(
            audioElement.currentlyPlaying.id
        );
    }
}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}

/* function setTrack(trackId, newPlaylist, play) {
    if (newPlaylist != currentPlaylist) {
        currentPlaylist = newPlaylist;
        shufflePlaylist = currentPlaylist.slice();
        shuffleArray(shufflePlaylist);
    }

    if (shuffle == true) {
        currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
        currentIndex = currentPlaylist.indexOf(trackId);
    }
    pauseSong();

    $.post(
        'includes/handlers/ajax/getSongJson.php',
        { songId: trackId },
        function (data) {
            var track = JSON.parse(data);
            $('.trackName span').text(track.title);

            $.post(
                'includes/handlers/ajax/getArtistJson.php',
                { artistId: track.artist },
                function (data) {
                    var artist = JSON.parse(data);
                    $('.trackInfo .artistName span').text(artist.name);
                    $('.trackInfo .artistName span').attr(
                        'onclick',
                        "openPage('artist.php?id=" + artist.id + "')"
                    );
                }
            );

            $.post(
                'includes/handlers/ajax/getAlbumJson.php',
                { albumId: track.album },
                function (data) {
                    var album = JSON.parse(data);
                    $('.content .albumLink img').attr('src', album.artworkPath);
                    $('.content .albumLink img').attr(
                        'onclick',
                        "openPage('album.php?id=" + album.id + "')"
                    );
                    $('.trackInfo .trackName span').attr(
                        'onclick',
                        "openPage('album.php?id=" + album.id + "')"
                    );
                }
            );

            audioElement.setTrack(track);

            if (play == true) {
                playSong();
            }
        }
    );
}
 */
function playSong() {
    if (audioElement.audio.currentTime == 0) {
        $.post('includes/handlers/ajax/updatePlays.php', {
            songId: audioElement.currentlyPlaying.id,
        });
    }

    $('.controlButton.play').hide();
    $('.controlButton.pause').show();
    audioElement.play();
}

function pauseSong() {
    $('.controlButton.play').show();
    $('.controlButton.pause').hide();
    audioElement.pause();
}
