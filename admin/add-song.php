<?php

ob_start(); // Start output buffering

include_once '../layout/sidebar.php';
include_once '../controller/tracksController.php';
include_once '../controller/albumsController.php';
include_once '../controller/typesController.php';
include_once '../controller/artistsController.php';

$tracks = new TracksController();

$artists = new ArtistController();
$artist_lists = $artists->getArtists();

$albums = new AlbumsController();
$album_lists = $albums->getAlbums();

$types = new TypesController();
$type_lists = $types->getTypes();

if (isset($_POST['add'])) {
    $error = false;
    $title = $album = $mtype = '';

    $filename = $_FILES['mp-3']['name'];
    $fileError = $_FILES['mp-3']['error'];
    $filesize = $_FILES['mp-3']['size'];
    $fileinfo = explode('.', $filename);
    $filetype = end($fileinfo);
    $allowtype = ['mp3'];

    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
    } else {
        $error = true;
        echo "Retype song name!";
    }

    if (!empty($_FILES['mp-3'])) {
        if ($fileError == 0) {
            if ($filesize < 8000000) {
                if (in_array($filetype, $allowtype)) {
                    if (move_uploaded_file($_FILES['mp-3']['tmp_name'], '../tracks/' . $filename)) {
                        $uploadSuccess = true;
                    } else {
                        echo "failed";
                    }
                } else {
                    echo "file type is not allowed";
                }
            } else {
                echo "insufficient file size";
            }
        }
    }

    if (!empty($_POST['artist_id'])) {
        $artist_id = $_POST['artist_id'];
    } else {
        $error = true;
        echo "Retype the Artist Name!";
    }

    if (!empty($_POST['album_id'])) {
        $album_id = $_POST['album_id'];
    } else {
        $error = true;
        echo "Retype the Album Name!";
    }

    if (!empty($_POST['mtype'])) {
        $mtype = $_POST['mtype'];
    } else {
        $error = true;
        echo "Retype the Music Type!";
    }

    $song = $tracks->getSong($title);

    if (!$error) {
        if ($song['total'] == 0) {
            $status = $tracks->addTracks($title, $filename, $artist_id, $album_id, $mtype);
            if ($status && isset($uploadSuccess)) {
                $message = 'success';
                header('Location: tracks.php?status=' . $message);
                ob_end_flush(); // Send the output buffer
                exit(); // Ensure no further code is executed
            }
        }
    }
}
?>

<div class="container-fluid pt-3">
    <div class="row" style="padding-top: 50px;">
        <div class="col-md-2"><a href="../admin/tracks.php" class="btn btn-success">Back</a></div>
    </div>
    <div class="row">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="row">
                <div class="">
                    <label for="" class="form-label">Song Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="">
                    <label for="" class="form-label">Mp-3 File</label>
                    <input type="file" class="form-control" name="mp-3" required>
                </div>
                <div>
                    <label for="" class="form-label">Choose Artist</label>
                    <select name="artist_id" id="" class="form-select">
                        <option value="" disabled selected>Select an Artist</option>
                        <?php 
                            foreach ($artist_lists as $artist) {
                                echo "<option value='{$artist['artist_id']}' required>{$artist['artist_name']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Choose Album</label>
                    <select name="album_id" id="" class="form-select">
                        <option value="" disabled selected>Select an Album</option>
                        <?php 
                            foreach ($album_lists as $album) {
                                echo "<option value='{$album['album_id']}' required>{$album['album_name']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Select Music Type</label>
                    <select name="mtype" id="" class="form-select">
                        <option value="" disabled selected>Select a music type</option>
                        <?php 
                            foreach ($type_lists as $mtype) {
                                echo "<option value='{$mtype['type_id']}' required>{$mtype['type_name']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="">
                    <button class="btn btn-success mt-4" name="add">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php 
include_once '../layout/footer.php';
?>

