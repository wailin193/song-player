<?php 
ob_start(); // Start output buffering

include_once '../layout/sidebar.php';
include_once '../controller/albumsController.php';

$albums = new AlbumsController();

if (isset($_POST['add'])) {
    $error = false;
    $errorMessages = [];

    if (isset($_FILES['album_photo'])) {
        $filename = $_FILES['album_photo']['name'];
        $fileError = $_FILES['album_photo']['error'];
        $filesize = $_FILES['album_photo']['size'];
        $fileinfo = explode('.', $filename);
        $filetype = end($fileinfo);
        $allowtype = ['jpg', 'jpeg', 'png', 'webp', 'jiff'];

        if (!empty($_POST['album'])) {
            $album = $_POST['album'];
        } else {
            $error = true;
            $errorMessages[] = "Type album name!";
        }

        if (!empty($_POST['date'])) {
            $date = $_POST['date'];
        } else {
            $error = true;
            $errorMessages[] = "Type release date!";
        }

        if ($fileError == 0) {
            if ($filesize < 2000000) {
                if (in_array($filetype, $allowtype)) {
                    $photo = move_uploaded_file($_FILES['album_photo']['tmp_name'], '../album_photo/' . $filename);
                    if ($photo) {
                        echo "success uploading";
                    } else {
                        $error = true;
                        $errorMessages[] = "Failed to upload photo";
                    }
                } else {
                    $error = true;
                    $errorMessages[] = "File type is not allowed";
                }
            } else {
                $error = true;
                $errorMessages[] = "Insufficient file size";
            }
        } else {
            $error = true;
            $errorMessages[] = "File upload error: " . $fileError;
        }
    } else {
        $error = true;
        $errorMessages[] = "No file uploaded";
    }

    if (!$error) {
        if ($albums->addAlbums($album, $date, $filename)) {
            $message = "success";
            header('Location: albums.php?status=' . $message);
            exit();
        } else {
            $errorMessages[] = "Failed to add album to the database";
        }
    }

    // Display error messages
    foreach ($errorMessages as $message) {
        echo '<div class="alert alert-danger">' . $message . '</div>';
    }
}

ob_end_flush(); // End output buffering and flush the output
?>

<div class="container-fluid pt-3">
    <div class="row" style="padding-top: 50px;">
        <div class="col-md-2"><a href="../admin/albums.php" class="btn btn-success">Back</a></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="" class="form-label">Album Name</label>
                    <input type="text" class="form-control" name="album">
                </div>
                <div>
                    <label for="" class="form-label">Release Date</label>
                    <input type="date" class="form-control" name="date">
                </div>
                <div>
                    <label for="file" class="form-label">Album Photo</label>
                    <input type="file" class="form-control" name="album_photo">
                </div>
                <div>
                    <button class="btn btn-success mt-3" name="add">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
include_once '../layout/footer.php';
?>
