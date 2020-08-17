<?php
require_once __DIR__ . '/../../../core/init.php';

$db = new Database();
$sql = "SELECT id
            FROM songs
            ORDER BY rand()
            LIMIT 10";

$db->query($sql);
$playlist = $db->resultset();

$songsArray = [];

foreach ($playlist as $song) {
    array_push($songsArray, $song->id);
}

$jsonArray = json_encode($songsArray);

echo $jsonArray;
