<?php
session_start();

include_once '../controller/albumsController.php';
$album_controller = new AlbumsController;
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $album=$album_controller->editAlbum($id);
}

if(isset($_POST['update']))
{
    $error=false;
    if(!empty($_POST['album_name']))
    {
        $name =$_POST['album_name'];
    }
    else{
        $name = $album['album_name'];
    }
    if(!empty($_POST['release_date']))
    {
        $rdate =$_POST['release_date'];
    }
    else{
        $rdate = $album['release_date'];
    }
    if(!empty($_POST['album_photo']))
    {
        $photo =$_POST['album_photo'];
    }
    else{
        $photo = $album['album_photo'];
    }
    // var_dump($error);
    if(!$error)
    {
        $status = $album_controller->updateAlbum($id,$name,$rdate,$photo);
        if($status)
        {
            header('location:../admin/albums.php?status=success');
        }
    }
}
include_once '../layout/sidebar.php';
?>

<div class="main">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post">
                <div class="m-4">
                    <label for="" class="form-label">Album Name</label>
                    <input type="text" name="album_name" class="form-control" id="" value="<?php echo $album['album_name']; ?>">
                </div>
                <div class="m-4">
                    <label for="" class="form-label">Release Date</label>
                    <input type="date" name="release_date" class="form-control" id="" value="<?php echo $album['release_date']; ?>">
                </div>
                <div class="m-4">
                    <label for="" class="form-label">Current Photo</label><br>
                    <img src="<?php echo $album['album_photo']; ?>" alt="<?php echo $album['album_photo']; ?>" style="max-width: 200px;">
                </div>
                <div class="m-4">
                    <label for="album_photo" class="form-label">New Photo</label>
                    <input type="file" name="album_photo" class="form-control" id="album_photo">
                </div>
                <div class="m-4">
                    <button class="btn btn-warning" name="update">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
include_once '../layout/footer.php';
?>