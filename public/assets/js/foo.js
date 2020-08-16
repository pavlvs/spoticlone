var userLoggedIn;
var timer;
console.log('foo in da house');

function foo() {
    console.log('fuck you');
}

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
