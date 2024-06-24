<?php
include_once '../controller/albumsController.php';

$id=$_GET['id'];
$artist_controller = new AlbumsController;
$status= $artist_controller->deleteAlbum($id);

if($status)
{
    header('location:../admin/albums.php?status=success');
}
else{
    header('location:../admin/albums.php?status=fail');
}
?>