<?php
require_once __DIR__ . '/../../../core/init.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (isset($_POST['table'])) {
        $table = $_POST['table'];

        $db = new Database();

        $sql = "SELECT *
                FROM $table
                WHERE id = :id";
        $db->query($sql);
        $db->bind(':id', $id);
        $record = $db->single();
        $record = (array) $record;
        echo json_encode($record);
    }
}
