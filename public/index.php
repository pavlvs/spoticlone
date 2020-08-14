<?php
require_once '../core/init.php';

$database = new Database();
// $account = new Account();

$account = new Account();
require_once '../helpers/form_helpers.php';


$title = 'Welcome to Spoticlone';

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'register';
    }
}

switch ($action) {
    case 'register':
        $template = new Template('../templates/register.html.php');
        $template->account = $account;
        break;
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
    case 'test':
        $template = new Template('../templates/test.php');
        break;
    default:
        # code...
        break;
}
echo $template;
