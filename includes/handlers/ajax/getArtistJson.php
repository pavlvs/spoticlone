<?php
require_once __DIR__ . '/../../../core/init.php';
if (isset($_POST['artistId'])) {
    $artistId = $_POST['artistId'];
    if (isset($_POST['table'])) {
        $table = $_POST['table'];
        $artist = getSingleRecord($table, $artistId);
        echo $artist;
    }
    /*
    $db = new Database();

    $sql = "SELECT *
        FROM artists
        WHERE id = :id";
    $db->query($sql);
    $db->bind(':id', $artistId);
    $artist = $db->single();
    echo $artist; */
}
