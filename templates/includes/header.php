<?php
require_once '../core/init.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spoticlone</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

</head>

<body>
    <div id="mainContainer">

        <div id="topContainer">
            <div id="navBarContainer">
                <nav class="navBar">
                    <span role="link" tabindex="0" onclick="openPage('index.php')" class="logo">
                        <img src="assets/images/icons/logo.png" alt="logo">
                    </span>
                    <div class="group">
                        <div class="navItem">
                            <span role="link" tabindex="0" onclick="openPage('search.php')" class="navItemLink">Search <img src="assets/images/icons/search.png" alt="search" class="icon"></span>
                        </div>
                    </div>
                    <div class="group">
                        <div class="navItem">
                            <span role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink">Browse</span>
                        </div>
                        <div class="navItem">
                            <span role="link" tabindex="0" onclick="openPage('your_music.php')" class="navItemLink">Your Music</span>
                        </div>
                        <div class="navItem">
                            <span role="link" tabindex="0" onclick="openPage('profile.php')" class="navItemLink">Paul Shaw</span>
                        </div>
                    </div>
                </nav>
            </div> <!-- End of navBarContainer -->
        </div><!-- End of navBarContainer -->

        <div id="mainViewContainer">
            <div id="mainContent">