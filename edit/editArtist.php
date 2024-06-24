<?php
session_start();

include_once '../controller/artistsController.php';
$artist_controller = new ArtistController;
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $artist=$artist_controller->editArtist($id);
}

if(isset($_POST['update']))
{
    $error=false;
    if(!empty($_POST['artist_name']))
    {
        $name =$_POST['artist_name'];
    }
    else{
        $error=true;
    }
    if(!empty($_POST['artist_country']))
    {
        $country =$_POST['artist_country'];
    }
    else{
        $error=true;
    }
    if(!empty($_POST['artist_photo']))
    {
        $photo =$_POST['artist_photo'];
    }
    else{
        $photo = $artist['artist_photo'];
    }
    // var_dump($error);
    if(!$error)
    {
        $status = $artist_controller->updateArtist($id,$name,$country,$photo);
        if($status)
        {
            header('location:../admin/artists.php?status=success');
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
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="artist_name" class="form-control" id="" value="<?php echo $artist['artist_name']; ?>">
                </div>
                <div class="m-4">
                    <label for="" class="form-label">Country</label>
                    <input type="text" name="artist_country" class="form-control" id="" value="<?php echo $artist['artist_country']; ?>">
                </div>
                <div class="m-4">
                    <label for="" class="form-label">Current Photo</label><br>
                    <img src="<?php echo $artist['artist_photo']; ?>" alt="<?php echo $artist['artist_photo']; ?>" style="max-width: 200px;">
                </div>
                <div class="m-4">
                    <label for="artist_photo" class="form-label">New Photo</label>
                    <input type="file" name="artist_photo" class="form-control" id="artist_photo">
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