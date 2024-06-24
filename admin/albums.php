<?php 

include_once '../layout/sidebar.php';
include_once '../controller/albumsController.php';

$albums = new AlbumsController();
$results = $albums->getAlbums();

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
        <h2 class="d-flex justify-content-center">Albums</h2>
    </div>

    <div class="row">
        <div class="row">
            <div class="col-md-3 mb-3 btn">
                <div class="card h-100 d-flex justify-content-center align-items-center dkcolor" id="add_album">
                    <a href="add-album.php" class="bi bi-plus-square-fill text-success fs-1 d-flex justify-content-center align-items-center" ></a>
                </div>
            </div>

        <?php
                foreach($results as $data) {
                    if($data['delete_status']==null)
                    {
                        echo "<div class='col-md-3 mb-3'>";
                        echo "<div class='card dkcolor'>";
                        echo "<div class='d-flex justify-content-center'>";
                        echo "<img src='../album_photo/{$data['album_photo']}' class='card-img-top text-center' alt='...' width='200px' height='200px' style='width: 200px; height: 200px; border-radius: 50%;object-fit: cover;'>";
                        echo "</div>";
                        echo "<div class='card-body d-flex justify-content-center'>";
                        echo "<table style='border:0;'>";
                        echo "<tr>";
                        echo "<td><label>Name : {$data['album_name']}</label></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td><label>Country : {$data['release_date']}</label></td>";
                        echo "</tr>";
                        echo "<tr class='d-flex justify-content-center'>";
                        echo "<td><a href='../detail/detailAlbum.php?id=".$data['album_id']."' class='btn btn-info'>Detail</a></td>";
                        echo "<td><a href='../edit/editAlbum.php?id=".$data['album_id']."' class='btn btn-warning'>Edit</a></td>";
                        echo "<td><a href='../delete/deleteAlbum.php?id=".$data['album_id']."' class='btn btn-danger'>Delete</a></td>";
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
    document.getElementById('add_album').addEventListener('click', function() {
        window.location.href = 'add-album.php';
    });
</script>
<?php 

include_once '../layout/footer.php';

?>