<?php
include_once '../controller/artistsController.php';

$id=$_GET['id'];
$artist_controller = new ArtistController;
$status= $artist_controller->deleteArtist($id);

if($status)
{
    header('location:../admin/artists.php?status=success');
}
else{
    header('location:../admin/artists.php?status=fail');
}
?>