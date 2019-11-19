<?php
include "includes/config.php";
include "includes/classes/Artist.php";
if (isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
} else {
	header("Location: register.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spoticlone</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div id="mainContainer">
        <div id="topContainer">
            <?php include "includes/navBarContainer.php"?>
            <div id="mainViewContainer">
                <div id="mainContent">