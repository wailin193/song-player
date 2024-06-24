

<?php
include_once '../layout/sidebar.php';
include_once '../controller/albumsController.php';

$id = $_GET['id'];
$albumController = new AlbumsController();
$results = $albumController->getAlbums();

?>
<style>
    .circular-image {
            width: 150px; /* Adjust width as needed */
            height: 150px; /* Adjust height as needed */
            border-radius: 50%; /* Make it circular */
            overflow: hidden; /* Hide overflow */
        }
</style>

<div class="container">
    <div class="main">
        <div class="row">
            <div class="col-md-12">
                <?php
                    foreach($results as $album)
                    {
                        if($album['album_id']==$id)
                        {
                            $show = $album;
                            break;
                        }
                    }
                ?>
                <div class="circular-image">
                    <?php
                    echo '<img src="../album_photo/'.$show['album_photo'].'" alt="'.$show['album_name'].'" style="width: 150px; height: auto;">';
                    ?>
                </div>
                <?php
                    echo "<h2>Name : ".$show['album_name']."</h2>";
                    echo "<h2>Country : ".$show['release_date']."</h2>";
                ?>
                
            </div>
        </div>
    </div>
</div>

<?php
include_once '../layout/footer.php';
?>
