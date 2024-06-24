<?php
session_start();

include_once '../controller/tracksController.php';
include_once '../controller/albumsController.php';
include_once '../controller/artistsController.php';
include_once '../controller/typesController.php';

$track_controller = new TracksController();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $track = $track_controller->editTrack($id);
}

$album_controller = new AlbumsController();
$albums = $album_controller->getAlbums();

$artist_controller = new ArtistController();
$artists = $artist_controller->getArtists();

$type_controller = new TypesController();
$types = $type_controller->getTypes();

if (isset($_POST['update'])) {
    $title = !empty($_POST['track_title']) ? $_POST['track_title'] : $track['track_title'];
    $url = $track['url'];

    $artist_id = isset($_POST['artist_id']) ? $_POST['artist_id'] : $track['artist_id'];
    $album_id = isset($_POST['album_id']) ? $_POST['album_id'] : $track['album_id'];
    $type_id = isset($_POST['type_id']) ? $_POST['type_id'] : $track['type_id'];

    if (!empty($_FILES['url']['name'])) {
        $target_dir = "../tracks/";
        $target_file = $target_dir . basename($_FILES["url"]["name"]);
        if (move_uploaded_file($_FILES["url"]["tmp_name"], $target_file)) {
            $url = $target_file;
        }
    }

    $status = $track_controller->updateTrack($id, $title, $url, $album_id, $type_id, $artist_id);
    if ($status) {
        header('location:../admin/tracks.php?status=success');
        exit();
    }
}

include_once '../layout/sidebar.php';
?>

<div class="main">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="m-4">
                    <label for="track_title" class="form-label">Song Name</label>
                    <input type="text" name="track_title" class="form-control" id="track_title" value="<?php echo htmlspecialchars($track['track_title']); ?>">
                </div>
                <div class="m-4">
                    <label for="url" class="form-label">URL</label>
                    <input type="file" name="url" class="form-control" id="url">
                    <small>Current file: <?php echo htmlspecialchars($track['url']); ?></small>
                </div>
                <div class="m-4">
                    <label for="artist_id" class="form-label">Artist</label>
                    <select name="artist_id" id="artist_id" class="form-select">
                        <option value="<?php echo $track['artist_id']; ?>" selected><?php echo $track['artist_name']; ?></option>
                        <?php foreach ($artists as $artist) {
                            echo "<option value='{$artist['artist_id']}'>{$artist['artist_name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="m-4">
                    <label for="album_id" class="form-label">Album</label>
                    <select name="album_id" id="album_id" class="form-select">
                        <option value="<?php echo $track['album_id']; ?>" selected><?php echo $track['album_name']; ?></option>
                        <?php foreach ($albums as $album) {
                            echo "<option value='{$album['album_id']}'>{$album['album_name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="m-4">
                    <label for="type_id" class="form-label">Type</label>
                    <select name="type_id" id="type_id" class="form-select">
                        <option value="<?php echo $track['type_id']; ?>" selected><?php echo $track['type_name']; ?></option>
                        <?php foreach ($types as $type) {
                            echo "<option value='{$type['type_id']}'>{$type['type_name']}</option>";
                        } ?>
                    </select>
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
