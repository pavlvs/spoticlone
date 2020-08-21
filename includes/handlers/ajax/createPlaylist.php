<?php
require_once __DIR__ . '/../../../core/init.php';

if (isset($_POST['name']) && isset($_POST['owner'])) {

    $name = $_POST['name'];
    $owner = $_POST['owner'];
    //echo $name . ' ' . $owner;
    //exit;
    $date = date("Y-m-d H:i:s");

    $db = new Database();

    $sql = "INSERT INTO playlists
            VALUES ('', '$name', '$owner', '$date')";
    $db->query($sql);
    $db->execute();
} else {
    echo "Name or owner not passed nto file";
    exit;
}
