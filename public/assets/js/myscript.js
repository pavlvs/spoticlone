let currentPlaylist = [];
let audioElement;

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

function playSong() {
    audioElement.play();
}

function pauseSong() {
    audioElement.pause();
}

$(function () {
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
