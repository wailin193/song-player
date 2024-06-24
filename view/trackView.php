

<?php
include_once '../layout/sidebar.php';
include_once '../controller/tracksController.php';

$id = $_GET['id'];
$trackController = new TracksController();
$results = $trackController->getTracks();

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
                    foreach($results as $track)
                    {
                        if($track['track_id']==$id)
                        {
                            $show = $track;
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
                    echo "<h2>Song Name : ".$show['track_title']."</h2>";
                    echo "<h2>Singer : ".$show['artist_id']."</h2>";
                    echo "<h2>Album : ".$show['album_id']."</h2>";
                    echo "<h2>Music Type : ".$show['type_id']."</h2>";
                ?>
                
            </div>
        </div>
    </div>
</div>

<?php
include_once '../layout/footer.php';
?>
