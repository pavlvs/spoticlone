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
