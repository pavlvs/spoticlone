<?php
require_once __DIR__ . '/../../../core/init.php';

if (isset($_POST['playlistId'])) {

    $id = $_POST['playlistId'];

    $db = new Database();

    $sql = "DELETE FROM playlists
            WHERE id=$id";
    $db->query($sql);
    $db->execute();

    $sql = "DELETE FROM playlistsongs
            WHERE playlistId=$id";
    $db->query($sql);
    $db->execute();
}
