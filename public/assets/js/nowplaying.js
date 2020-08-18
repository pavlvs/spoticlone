$(function () {
    currentPlaylist = setPlaylist();
    audioElement = new Audio();
    track = parseInt(currentPlaylist[0]);
    setTrack(track, currentPlaylist, false);
    //audioElement.play();
});

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
            audioElement.play();
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
