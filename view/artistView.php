

<?php
include_once '../layout/sidebar.php';
include_once '../controller/artistsController.php';

$id = $_GET['id'];
$artistController = new ArtistController();
$results = $artistController->getArtists();

?>
<style>
    .circular-image {
            width: 150px; /* Adjust width as needed */
            height: 150px; /* Adjust height as needed */
            border-radius: 50%; /* Make it circular */
            overflow: hidden; /* Hide overflow */
        }
</style>

<div class="main">
    <div class="row">
        <div class="col-md-12">
            <?php
                foreach($results as $artist)
                {
                    if($artist['artist_id']==$id)
                    {
                        $new = $artist;
                        break;
                    }
                }
            ?>
            <div class="circular-image">
                <?php
                echo '<img src="../artist_photo/'.$new['artist_photo'].'" alt="'.$new['artist_name'].'" style="width: 150px; height: auto;">';
                ?>
            </div>
            <?php
                echo "<h2>Name : ".$new['artist_name']."</h2>";
                echo "<h2>Country : ".$new['artist_country']."</h2>";
            ?>
            
        </div>
    </div>
</div>

<?php
include_once '../layout/footer.php';
?>
