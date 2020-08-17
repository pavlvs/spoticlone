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
        $('.controlButton.play').hide();
        $('.controlButton.pause').show();
        playSong();
    });

    $('#pauseBtn').click(function () {
        $('.controlButton.play').show();
        $('.controlButton.pause').hide();
        pauseSong();
    });
});
