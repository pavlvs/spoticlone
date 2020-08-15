<?php
/* echo $_SERVER['REQUEST_URI'];
exit; */

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    require_once  __DIR__ . '/../../core/init.php';

    if (isset($_GET['userLoggedIn'])) {
        //$userLoggedIn = new User($con, $_GET['userLoggedIn']);
    } else {
        //echo "Username variable was not passed into page. Check the openPage JS function";
        //exit();
    }
} else {
    if ($_SERVER['REQUEST_URI'] != '/sandbox/spoticlone/public/') {
        include __DIR__ . '/header.php';
        include __DIR__ . '/footer.php';
        $url = $_SERVER['REQUEST_URI'];
        echo "<script>openPage('$url')</script>";
        exit();
    } else {
        require_once  __DIR__ . '/../../core/init.php';
        //exit;
    }
}
