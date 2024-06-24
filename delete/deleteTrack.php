<?php
include_once '../controller/tracksController.php';

$id=$_GET['id'];
$track_controller = new TracksController;
$status= $track_controller->deleteTrack($id);

if($status)
{
    header('location:../admin/tracks.php?status=success');
}
else{
    header('location:../admin/tracks.php?status=fail');
}
?>