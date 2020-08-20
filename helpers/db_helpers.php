<?php
function getSingleRecord($table, $id)
{
    $db = new Database();

    $sql = "SELECT *
        FROM $table
        WHERE id = :id";
    $db->query($sql);
    $db->bind(':id', $id);
    $record = $db->single();
    $record = (array) $record;
    return json_encode($record);
}

function getRecordsBySearchTerm($table, $field, $term)
{
    $db = new Database();

    $sql = "SELECT *
            FROM `$table`
            WHERE `$field`
            LIKE '%$term%'";
    $db->query($sql);
    // $db->bind(':term', $term);
    $records = $db->resultset();
    return $records;
}

function getSongsBySearchTerm($term)
{
    $db = new Database();

    $sql = "SELECT id
            FROM `songs`
            WHERE `title`
            LIKE '%$term%'";
    $db->query($sql);
    // $db->bind(':term', $term);
    $records = $db->resultset();
    return $records;
}
