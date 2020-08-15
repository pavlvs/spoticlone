<?php
include '../templates/includes/includedFiles.php';

$database = new Database();
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
    case 'logout':
        $account->logout();
        $template = new Template('../templates/register.html.php');
        break;
    default:
        # code...
        break;
}
echo $template;
include __DIR__ . '/../templates/includes/footer.php';
