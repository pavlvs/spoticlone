<?php
include 'includes/includedFiles.php';

if(isset($_GET['term'])){
    $term = urldecode($_GET['term']);
} else {
    $term = "";
}
?>

<div class="searchContainer">
    <h4>Search for an album, artist or song</h4>
    <input type="text" name="" value="<?php echo $term; ?>" placeholder="Start typing..." class="searchInput">
</div>