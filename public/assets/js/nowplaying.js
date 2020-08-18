$(function () {
    currentPlaylist = setPlaylist();
    audioElement = new Audio();
    track = parseInt(currentPlaylist[0]);
    setTrack(track, currentPlaylist, false);
    //audioElement.play();
    playSong(track);
    // event listeners

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
});

class Audio {
    audio;
    constructor() {
        this.audio = document.createElement('audio');
    }

    setTrack(src) {
        this.audio.src = src;
    }

    play() {
        this.audio.play();
    }

    pause() {
        this.audio.pause();
    }
}

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
            $('#artistName').text(track.artist);
            audioElement.setTrack(track.path);
        }
    );
    if (play) {
        audioElement.play();
    }
}

function setPlaylist() {
    $.ajaxSetup({ async: false }); //execute synchronously
    var returnData = null;
    $.post('../includes/handlers/ajax/getJsonArrayOfSongs.php', {}, function (
        data
    ) {
        data = JSON.parse(data);
        returnData = data;
    });
    $.ajaxSetup({ async: true }); //return to default setting
    return returnData;
}

function playSong(trackId) {
    if (audioElement.audio.currentTime == 0) {
        console.log('we are on track: ' + trackId);
        $.post(
            '../includes/handlers/ajax/updatePlays.php',
            {
                songId: trackId,
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
