<div id="navBarContainer">
    <nav class="navBar">
        <span id="homeLink" role="link" tabindex="0" data-link="<?= BASE_URI ?>public/index.php?action=browse&ajax=true" class="logo">
            <img src="<?= IMG_FOLDER ?>icons/logo.png" alt="logo">
        </span>
        <div class="group">
            <div class="navItem">
                <span id="searchLink" role="link" tabindex="0" data-link="<?= BASE_URI ?>/public/index.php?action=search" class="navItemLink">
                    Search <img src="<?= IMG_FOLDER ?>icons/search.png" alt="search" class="icon">
                </span>
            </div>
        </div>
        <div class="group">
            <div class="navItem">
                <span id="browseLink" role="link" tabindex="0" data-link="<?= BASE_URI ?>public/index.php?action=browse&ajax=true" class="navItemLink">Browse</span>
            </div>
            <div class="navItem">
                <span id="musicLink" role="link" tabindex="0" data-link="<?= BASE_URI ?>templates/your_music.php" class="navItemLink">Your Music</span>
            </div>
            <div class="navItem">
                <span id="profileLink" role="link" tabindex="0" data-link="<?= BASE_URI ?>templates/profile.php" class="navItemLink">Paul Shaw</span>
            </div>
            <div class="navItem">
                <a role="link" tabindex="0" href="index.php?action=logout" class="navItemLink">Logout</a>
            </div>
        </div>
    </nav>
</div> <!-- End of navBarContainer -->