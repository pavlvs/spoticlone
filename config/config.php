<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'slotify');
define('SITE_TITLE', 'Welcome to Slotify!');


//Paths
define('BASE_URI', 'http://' . $_SERVER["SERVER_NAME"] . '/sandbox/spoticlone/');
define('IMG_FOLDER', BASE_URI . 'public/assets/images/');
define('AJAX_DIR', BASE_URI . 'templates/includes/handlers/ajax/');
define('CORE_DIR', BASE_URI . 'core/');

$timezone = date_default_timezone_set("Europe/London");
