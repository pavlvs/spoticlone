<?php

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: index.php");
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="assets/js/jquery-3.4.1.js"></script>
    <script src="assets/js/script.js"></script>

</head>

<body>
    <div id="mainContainer">

        <div id="topContainer">
            <?php include 'navBar.php' ?>

        </div><!-- End of topContainer -->

        <div id="mainViewContainer">
            <div id="mainContent">