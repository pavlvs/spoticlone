<?php
require_once __DIR__ . '/../../../core/init.php';

if (isset($_POST['songId'])) {
    $songId = $_POST['songId'];
    if (isset($_POST['table'])) {
        $table = $_POST['table'];
        $song = getSingleRecord($table, $songId);
        echo $song;
    }
}
