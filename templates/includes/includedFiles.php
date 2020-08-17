<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    //include __DIR__ . "/../../core/init.php";

    /* if (isset($_GET['userLoggedIn'])) {
        $userLoggedIn = new User($_GET['userLoggedIn']);
    } else {
        echo "Username variable was not passed into page. Check the openPage JS function";
        //exit();
    } */
} else {
    include __DIR__ . "/header.php";
    include __DIR__ . "/footer.php";
    exit;
}
