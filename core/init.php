<?php
ob_start();

session_start();


// require_once 'helpers/format_helper.php';

function autoloader($className)
{
    $fileName = str_replace('\\', '/', $className) . '.php';

    $file = __DIR__ . '/../classes/' . $fileName;

    include_once $file;
}

spl_autoload_register('autoloader');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helpers/system_helpers.php';

require_once __DIR__ . '/../helpers/db_helpers.php';
