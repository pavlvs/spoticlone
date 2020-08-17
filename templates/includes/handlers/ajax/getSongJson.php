<?php
require_once '../../../../core/init.php';


if (isset($_POST['songId'])) {
    $songId = $_POST['songId'];
    $song = getSong($songId);
    echo $song;
}
