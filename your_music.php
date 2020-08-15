<?php
include 'includes/includedFiles.php';
?>

<div class="playlistsContainer">
    <div class="gridViewContainer">
        <h2>PLAYLISTS</h2>

        <div class="buttonItems">
            <button class="button spoticlone" onclick="createPlaylist()">NEW PLAYLIST</button>
        </div>

        <?php
        $username = $userLoggedIn->getUsername();

        $playlistsQuery = mysqli_query($db, "SELECT * FROM playlists WHERE owner = '$username'");

        if (mysqli_num_rows($playlistsQuery) == 0) {
            echo "<span class='noResults'>You do not have any playlists yet</span>";
        }


        while ($row = mysqli_fetch_array($playlistsQuery)) {

            $playlist = new Playlist($db, $row);

            echo "<div class='gridViewItem' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>
                    <div class='playlistImage'>
                        <image src='<?= IMG_FOLDER ?>icons/playlist.png'>
                    </div>
                    <div class='gridViewInfo'>"
                . $playlist->getName() .
                "</div>
                </div>";
        }
        ?>



    </div>
</div>