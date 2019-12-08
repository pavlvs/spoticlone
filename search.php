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
    <input type="text" name="" value="<?php echo $term; ?>" placeholder="Start typing..." class="searchInput" onfocus="this.selectionStart = this.selectionEnd = this.value.length;">
</div>

<script type="text/javascript">
    $('.searchInput').focus();
    $(function(){
        var timer;

        $('.searchInput').keyup(function () {
            clearTimeout(timer);

            timer = setTimeout(function () {
                var val = $('.searchInput').val();
                openPage("search.php?term=" + val);
            }, 2000);
        })
    })
</script>