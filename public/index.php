<?php
require_once '../core/init.php';

$database = new Database();

$title = 'Welcome to TalkingSpace';

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'browse';
    }
}

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

    default:
        # code...
        break;
}
echo $template;
