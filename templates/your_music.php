<?php
include 'includes/includedFiles.php';
?>

<div class="playlistsContainer">
    <div class="gridViewContainer">
        <h2>PLAYLISTS</h2>

        <div class="buttonItems">
            <button id="newPlaylist" class="button spoticlone">NEW PLAYLIST</button>
            <div id="newPlaylistModal" class="newPlaylistModal">
                <input type="text" id="playlistName" class="playlistName" placeholder="My Playlist#7">
                <button id="addPlaylistBtn" class="addPlaylistBtn button button-small spoticlone">Add</button>
                <button id="cancelPlaylistBtn" class="cancelPlaylistBtn">X</button>
            </div>
        </div>

        <?php
        $username = $user->getUsername();
        ?>

        <?php if (count($playlists) == 0) : ?>
            echo "<span class='noResults'>You do not have any playlists yet</span>";
        <?php endif; ?>

        <?php foreach ($playlists as $playlist) :
            $playlist = new Playlist($playlist);
        ?>

            <div class="gridViewItem" role="link" tabindex="0">
                <div class="playlistImage">
                    <image src="<?= IMG_FOLDER ?>icons/playlist.png">
                </div>
                <div class="gridViewInfo">
                    <?= $playlist->getName() ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>