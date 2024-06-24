<?php
include_once '../layout/sidebar.php';
include_once '../controller/artistsController.php';

$artist_controller = new ArtistController;
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $albums = $artist_controller->getAlbum($id);
    $artists = $artist_controller->getArtists();
    
}

?>
<style>
    .info-table {
        width: 100%;
        border-collapse: collapse;
    }
    .info-table th, .info-table td {
        padding: 8px 10px;
        text-align: left;
    }
    .info-table th {
        width: 150px;
        font-weight: bold;
    }
    .info-table td:first-child {
        text-align: left;
        padding-right: 10px;
    }
    .detail { 
        background-color: #f8f8f8; 
        border-radius: 10px; 
        box-shadow: 
            0 0 10px rgba(7, 32, 1, 0.7), 
            inset 0 0 5px rgba(15, 1, 29, 0.2); 
        margin: 20px; 
    } 
    .album_detail{
        background-color: #f8f8f8; 
        border-radius: 10px; 
        box-shadow: 
            0 0 10px rgba(red, green, blue, alpha), 
            inset 0 0 5px rgba(15, 1, 29, 0.2); 
        margin: 20px; 
    }
    .dark-mode .album_detail{
        background-color: #2e2e2e;
    }
    .data-body{
        display: flex;
        justify-content: center;
        align-items: flex-start;
        /* min-height: 50vh; */
        padding-top: 20px;
    }
    .album-body{
        display: flex;
        justify-content: center;
        align-items: flex-start;
        /* min-height: 100vh; */
        /* padding-top: 20px; */
    }
</style>
<div class="container-fluid">
    <div class="row" style="padding-top: 50px;">
        <div class="col-md-2"><a href="../admin/artists.php" class="btn btn-success">Back</a></div>
    </div>
    <div class="row d-flex data-body">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row"><h3 class="d-flex justify-content-center">Artist Details</h3></div>
            <div class="row detail dkcolor" style="padding-top: 30px;padding-bottom: 30px;">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <?php
                    foreach($artists as $artist)
                    {
                        if($artist['artist_id'] == $id)
                        {
                            $new = $artist;
                        }
                    }
                    echo "<img src='../artist_photo/".$new['artist_photo']."' class='text-center' style='width: 150px; height: 150px; border-radius: 50%; object-fit: cover;' />";
                    ?>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-8 d-flex justify-content-center align-items-center">
                    <div class="col-md-12">
                        <table class="info-table">
                            <tr>
                                <th><h5>Name</h5></th>
                                <td><h5>:</h5></td>
                                <?php 
                                echo "<td><h5>".$new['artist_name']."</h5></td>";
                                ?>
                            </tr>
                            <tr>
                                <th><h5>Country</h5></th>
                                <td><h5>:</h5></td>
                                <?php 
                                echo "<td><h5>".$new['artist_country']."</h5></td>";
                                ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row"><h3 class="d-flex justify-content-center">Released Albums</h3></div>
    <div class="row d-flex album-body">
        <div class="col-md-1"></div>
            <div class="com-md-10">
                <div class="row album_detail">
                    <?php
                        foreach($albums as $album){
                            echo "<div class='col-md-3' style='padding:20px'>";
                            echo "<a href='detailalbum.php?id=".$album['album_id']."' class='text-decoration-none text-dark'>";
                            echo "<div class='card dkcolor' id='detail_artist'>";
                            echo "<div class='d-flex justify-content-center'>";
                            echo "<img src='../album_photo/".$album['album_photo']."' alt='' class='card-img-top text-center' style='width: 150px; height: 150px; border-radius: 50%;object-fit: cover;'>";
                            echo "</div>";
                            echo "<div class='card-body d-flex justify-content-center'>";
                            echo "<table style='border:0;'>";
                            echo "<tr>";
                            echo "<td><label for=''>Name - ".$album['album_name']."</label></td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td><label for=''>Release Date - ".$album['release_date']."</label></td>";
                            echo "</tr>";
                            echo "</table>";
                            echo "</div>";
                            echo "</div>";
                            echo "</a>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
    </div>
</div>

<?php
include_once '../layout/footer.php';
?>
