<?php

function getSong($id)
{
    $db = new Database();

    $sql = "SELECT *
        FROM songs
        WHERE id = :id";
    $db->query($sql);
    $db->bind(':id', $id);
    $song = $db->single();
    $song = (array) $song;
    return json_encode($song);
}
