<?php 
include_once '../layout/sidebar.php';
include_once '../controller/artistsController.php';

$artists = new artistController();
$results = $artists->getArtists();

if(isset($_GET['status']))
{
    $status = $_GET['status'];
    if($status == 'success')
    {
        echo "<div class='alert alert-success'>Successfully Updated.</div>";
    }
    else if($status=='fail')
    {
        echo "<div class='alert alert-danger'>Cannot Delete</div>";
    }
}
?>

<div class="container-fluid">
    <div class="row my-3 d-flex justify-content-center">
        <h2 class="d-flex justify-content-center">Artists</h2>
    </div>
            

    <div class="row">
        <div class="row">
            <div class="col-md-3 mb-2 btn">
                    <div class="card h-100 d-flex justify-content-center align-items-center dkcolor" id="add_artist">
                        <a href="add-artist.php" class="bi bi-plus-square-fill text-success fs-1 d-flex justify-content-center align-items-center"></a>
                    </div>
            </div>
            <?php
                foreach($results as $data) {
                    if($data['delete_status']==null)
                    {
                        echo "<div class='col-md-3 mb-3'>";
                        echo "<div class='card dkcolor' id=''>";
                        echo "<div class='d-flex justify-content-center'>";
                        echo "<img src='../artist_photo/{$data['artist_photo']}' class='card-img-top text-center' alt='...' style='width: 200px; height: 200px; border-radius: 50%; object-fit: cover;'>";
                        echo "</div>";
                        echo "<div class='card-body d-flex justify-content-center'>";
                        echo "<table style='border-0'>";
                        echo "<tr>";
                        echo "<td><label>Artist Name : {$data['artist_name']}</label></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td><label>Country : {$data['artist_country']}</label></td>";
                        echo "</tr>";
                        echo "<tr class='d-flex justify-content-center'>";
                        echo "<td><a href='../detail/detailArtist.php?id=".$data['artist_id']."' class='btn btn-info'>Detail</a></td>";
                        echo "<td><a href='../edit/editArtist.php?id=".$data['artist_id']."' class='btn btn-warning'>Edit</a></td>";
                        echo "<td><a href='../delete/deleteArtist.php?id=".$data['artist_id']."' class='btn btn-danger'>Delete</a></td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }            
            ?>        
        </div>
    </div>
</div>
<script>
    document.getElementsById('add_artist').addEventListener('click', function() {
        window.location.href = 'add-artist.php';
    });
</script>
<?php include_once '../layout/footer.php'; ?>
