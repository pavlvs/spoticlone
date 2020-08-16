<?php
require_once '../core/init.php';

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'register';
    }
}

if ($action == 'register') {
    require_once '../core/init.php';
    $database = new Database();
    $account = new Account();
    require_once '../helpers/form_helpers.php';

    $template = new Template('../templates/register.html.php');
    $template->account = $account;
    echo $template;
    exit;
}
require_once '../helpers/form_helpers.php';

$database = new Database();
$account = new Account();

switch ($action) {
    case 'browse':
        $sql = "SELECT *
			FROM albums
			ORDER BY rand()
            LIMIT 10";

        $database->query($sql);
        $albums = $database->resultset();
        $template = new Template('../templates/browse.php');
        $template->albums = $albums;
        break;
    case 'showAlbum':
        $template = new Template('../templates/album.php');
        break;
    case 'logout':
        $account->logout();
        $template = new Template('../templates/register.html.php');
        break;
    default:
        # code...
        break;
}
echo $template;
exit;
