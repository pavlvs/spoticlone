
<?php
require_once __DIR__ . '/../../../core/init.php';

if (isset($_POST['songId'])) {
    $songId = $_POST['songId'];

    $db = new Database();

    $sql = "UPDATE songs
    SET plays = plays + 1
    WHERE id = :id";

    $db->query($sql);
    $db->bind(':id', $songId);
    $db->execute();
}
