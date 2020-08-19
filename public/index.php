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

//get the action passed by GET or by POST if none default to register
$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'register';
    }
}
// initialize objects
$database = new Database();
$account = new Account();
$album = new Album($albumId);
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
    case 'logout':
        $account->logout();
        //$template = new Template('../templates/register.html.php');
        break;
    case 'search':
        $template = new Template('../templates/search.php');
        break;
    case 'tempplaylist':
        $playlist = json_encode($album->getSongIds());
        echo $playlist;
        break;
    default:
        # code...
        break;
}
if (isset($template)) {
    echo $template;
}
exit;
