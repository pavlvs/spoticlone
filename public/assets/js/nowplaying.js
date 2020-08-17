$(function () {
    currentPlaylist = setPlaylist();
    console.log(currentPlaylist);
    audioElement = new Audio();
    track = parseInt(currentPlaylist[0]);
    console.log(track);
    setTrack(track, currentPlaylist, false);
    //audioElement.play();
});

function setTrack(trackId, newPlaylist, play) {
    $.post(
        '../includes/handlers/ajax/getSongJson.php',
        {
            songId: trackId,
        },
        function (data) {
            console.log(data);
            let track = JSON.parse(data);
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
        console.log(data);
        returnData = data;
    });
    $.ajaxSetup({ async: true }); //return to default setting
    return returnData;
}
