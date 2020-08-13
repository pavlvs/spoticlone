<?php
session_start();

require_once '../config/config.php';


// require_once 'helpers/system_helper.php';
// require_once 'helpers/format_helper.php';
// require_once 'helpers/db_helper.php';

function autoloader($className)
{
    $fileName = str_replace('\\', '/', $className) . '.php';

    $file = __DIR__ . '/../classes/' . $fileName;

    include $file;
}

spl_autoload_register('autoloader');
