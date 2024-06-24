<?php
ob_start();
include_once '../layout/sidebar.php';
include_once '../controller/artistsController.php';

$artists = new ArtistController();
$errorMessages = [];

if (isset($_POST['add'])) {
    $error = false;
    $filename = $_FILES['aphoto']['name'];
    $fileError = $_FILES['aphoto']['error'];
    $filesize = $_FILES['aphoto']['size'];
    $fileinfo = explode('.', $filename);
    $filetype = end($fileinfo);
    $allowtype = ['jpg', 'jpeg', 'png', 'webp', 'jiff'];

    if (!empty($_POST['aname'])) {
        $name = $_POST['aname'];
    } else {
        $error = true;
        $errorMessages[] = "Retype artist name!";
    }

    if (!empty($_POST['acountry'])) {
        $country = $_POST['acountry'];
    } else {
        $error = true;
        $errorMessages[] = "Retype country name!";
    }

    if (isset($_FILES['aphoto'])) {
        if ($fileError == 0) {
            if ($filesize < 2000000) {
                if (in_array($filetype, $allowtype)) {
                    $photo = move_uploaded_file($_FILES['aphoto']['tmp_name'], '../artist_photo/' . $filename);
                    if (!$photo) {
                        $error = true;
                        $errorMessages[] = "Failed to upload photo.";
                    }
                } else {
                    $error = true;
                    $errorMessages[] = "File type is not allowed.";
                }
            } else {
                $error = true;
                $errorMessages[] = "Insufficient file size.";
            }
        } else {
            $error = true;
            $errorMessages[] = "Error in file upload.";
        }
    } else {
        $error = true;
        $errorMessages[] = "No file uploaded.";
    }

    if (!$error) {
        $aname = $artists->getName($name);
        if ($aname['total'] == 0) {
            $status = $artists->addArtists($name, $country, $filename);
            if ($status) {
                $message = 'success';
                header('Location: artists.php?status=' . $message);
                exit;
            } else {
                $errorMessages[] = "Failed to add artist.";
            }
        } else {
            $errorMessages[] = "Artist already exists.";
        }
    }
}
?>

<div class="container-fluid pt-3">
    <div class="row" style="padding-top: 50px;">
        <div class="col-md-2"><a href="../admin/artists.php" class="btn btn-success">Back</a></div>
    </div>
    <div class="row">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="row">
                <div class="">
                    <label for="" class="form-label">Artist Name</label>
                    <input type="text" class="form-control" name="aname">
                </div>
                <div class="">
                    <label for="" class="form-label">Artist Country</label>
                    <input type="text" class="form-control" name="acountry">
                </div>
                <div class="">
                    <label for="file" class="form-label">Artist Photo</label>
                    <input type="file" class="form-control" name="aphoto">
                </div>
                <div class="">
                    <button class="btn btn-success mt-4" name="add">Add Artist</button>
                </div>
            </div>
        </form>
    </div>
    <?php 
    if (!empty($errorMessages)) {
        foreach ($errorMessages as $message) {
            echo "<div class='alert alert-danger'>$message</div>";
        }
    }
    ?>
</div>

<?php 
include_once '../layout/footer.php';
ob_end_flush();
?>
