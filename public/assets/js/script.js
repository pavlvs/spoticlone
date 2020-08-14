$(function () {
  console.log("It is alive!");
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

  $(".albumLink").click(function () {
    console.log($(this).attr("data-link"));
    openPage($(this).attr("data-link"));
  });

  function openPage(url) {
    if (timer != null) {
      clearTimeout(timer);
    }

    if (url.indexOf("?") == -1) {
      url = url + "?";
    }
    var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    $("#mainContent").load(encodedUrl);
    $("body").scrollTop(0);
    history.pushState(null, null, url);
  }

  function createPlaylist() {
    var alert = prompt("Please enter the name of your playlist");

    if (alert != null) {
      $.post("includes/handlers/ajax/createPlaylist.php", {
        name: alert,
        username: userLoggedIn,
      }).done(function () {
        //do somethin when ajax returns
        openPage("your_music.php");
      });
    }
  }

  function formatTime(seconds) {
    var time = Math.round(seconds);
    var minutes = Math.floor(time / 60); // Rounds the minutes down
    var seconds = time - minutes * 60;
    var extraZero = seconds < 10 ? "0" : "";

    return minutes + ":" + extraZero + seconds;
  }

  function updateTimeProgressBar(audio) {
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(
      formatTime(audio.duration - audio.currentTime)
    );

    var progress = (audio.currentTime / audio.duration) * 100;
    $(".playbackBar .progress").css("width", progress + "%");
  }

  function updateVolumeProgressBar(audio) {
    var volume = audio.volume * 100;
    $(".volumeBar .progress").css("width", volume + "%");
  }

  function playFirstSong() {
    setTrack(tempPlaylist[0], tempPlaylist, true);
  }

  function Audio() {
    this.currentlyPlaying;
    this.audio = document.createElement("audio");

    this.audio.addEventListener("ended", function () {
      nextSong();
    });

    this.audio.addEventListener(
      "canplay",
      function () {
        $(".progressTime.remaining").text(formatTime(this.duration));
      },
      false
    );

    this.audio.addEventListener(
      "timeupdate",
      function () {
        if (this.duration) {
          updateTimeProgressBar(this);
        }
      },
      false
    );

    this.audio.addEventListener("volumechange", function () {
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
});
