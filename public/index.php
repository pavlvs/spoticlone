<?php
require_once '../core/init.php';

//get the albumId if passed by GET or by POST
$albumId = filter_input(INPUT_POST, 'albumId');
if ($albumId == NULL) {
    $albumId = filter_input(INPUT_GET, 'albumId');
    if ($albumId == NULL) {
        $albumId = '';
    }
}

//get the artistId if passed by GET or by POST
$artistId = filter_input(INPUT_POST, 'artistId');
if ($artistId == NULL) {
    $artistId = filter_input(INPUT_GET, 'artistId');
    if ($artistId == NULL) {
        $artistId = '';
    }
}

//get the playlistId if passed by GET or by POST
$playlistId = filter_input(INPUT_POST, 'playlistId');
if ($playlistId == NULL) {
    $playlistId = filter_input(INPUT_GET, 'playlistId');
    if ($playlistId == NULL) {
        $playlistId = '';
    }
}

//get the action passed by GET or by POST if none default to register
$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'register';
    }
}

if (isset($_SESSION['userLoggedIn'])) {
    $user = new User($_SESSION['userLoggedIn']);
} else {
    $user = '';
}
// initialize objects
$database = new Database();
$account = new Account();
$album = new Album($albumId);
$artist = new Artist($artistId);
if (isset($playlistId) && $playlistId != '') {
    $playlist = new Playlist($playlistId);
}
//$song = new Song($id);

switch ($action) {
    case 'register':
        require_once '../helpers/form_helpers.php';
        $template = new Template('../templates/register.html.php');
        $template->account = $account;
        break;

    case 'browse':
        $albums = $album->getRandomAlbums(10);
        $template = new Template('../templates/browse.php');
        $template->albums = $albums;
        break;

    case 'showalbum':
        $artist = $album->getArtist();
        $template = new Template('../templates/singleAlbum.php');
        $template->album = $album;
        $template->artist = $artist;
        break;

    case 'showartist':
        $template = new Template('../templates/singleArtist.php');
        $template->albums = $artist->getAlbums();
        $template->artist = $artist;
        break;

    case 'showplaylist':
        $template = new Template('../templates/singlePlaylist.php');
        $template->playlist = $playlist;
        break;

    case 'logout':
        $account->logout();
        //$template = new Template('../templates/register.html.php');
        break;

    case 'search':
        //get the search term if passed by GET or by POST
        $term = filter_input(INPUT_POST, 'term');
        if ($term == NULL) {
            $term = filter_input(INPUT_GET, 'term');
            if ($term == NULL) {
                $term = '';
            }
        }
        $term = urldecode($term);
        $template = new Template('../templates/search.php');
        $template->songs = getRecordsBySearchTerm('songs', 'title', $term);
        $template->albums = getRecordsBySearchTerm('albums', 'title', $term);
        $template->artists = getRecordsBySearchTerm('artists', 'name', $term);
        $template->term = $term;
        break;

    case 'albumplaylist':
        $playlist = json_encode($album->getSongIds());
        echo $playlist;
        break;

    case 'artistplaylist':
        $playlist = json_encode($artist->getSongIds());
        echo $playlist;
        break;

    case 'playlistplaylist':
        $playlist = json_encode($playlist->getSongIds());
        echo $playlist;
        break;

    case 'searchplaylist':
        //get the search term if passed by GET or by POST
        $term = filter_input(INPUT_POST, 'term');
        if ($term == NULL) {
            $term = filter_input(INPUT_GET, 'term');
            if ($term == NULL) {
                $term = '';
            }
        }
        $term = urldecode($term);
        $playlist = json_encode(getSongsBySearchTerm($term));
        echo $playlist;
        break;

    case 'userloggedin':
        if (isset($_SESSION['userLoggedIn'])) {
            $userLoggedIn = $_SESSION['userLoggedIn'];
        } else {
            $userLoggedIn = '';
        }
        echo $userLoggedIn;
        break;

    case 'yourmusic':
        $template = new Template('../templates/your_music.php');
        $template->playlists = getPlaylistsByOwner($user->getUsername());
        $template->user = $user;
        break;

    default:
        break;
}
if (isset($template)) {
    echo $template;
}
exit;
