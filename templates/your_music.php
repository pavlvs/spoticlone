<?php
include 'includes/includedFiles.php';
?>

<div class="playlistsContainer">
    <div class="gridViewContainer">
        <h2>PLAYLISTS</h2>

        <div class="buttonItems">
            <button id="newPlaylist" class="button spoticlone">NEW PLAYLIST</button>
        </div>

        <?php
        $username = $userLoggedIn->getUsername();

        $playlistsQuery = mysqli_query($db, "SELECT * FROM playlists WHERE owner = '$username'");
        ?>

        <?php if (mysqli_num_rows($playlistsQuery) == 0) : ?>
            echo "<span class='noResults'>You do not have any playlists yet</span>";
        <?php endif; ?>

        <?php foreach ($foos as $foo) :

            $playlist = new Playlist($db, $row);
        ?>

            <div class="gridViewItem" role="link" tabindex="0">
                <div class="playlistImage">
                    <image src="<?= IMG_FOLDER ?>icons/playlist.png">
                </div>
                <div class="gridViewInfo">
                    . $playlist->getName() .
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>