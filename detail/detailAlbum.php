<?php
include_once '../layout/sidebar.php';
include_once '../controller/albumsController.php';

$album_controller = new AlbumsController;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $albums = $album_controller->getAlbums();
    $tracks = $album_controller->detailTrack($id);
}

?>

<style>
    .album {
        padding-top: 250px;
    }
    .album_detail {
        background-color: #f8f8f8;
        border-radius: 10px;
        box-shadow: 
            0 0 10px rgba(0, 0, 0, 0.1), 
            inset 0 0 5px rgba(15, 1, 29, 0.2); 
        margin: 20px;
    }
    .dark-mode .album_detail{
        background-color: #2e2e2e;
    }

    .circular-image {
            width: 150px; /* Adjust width as needed */
            height: 150px; /* Adjust height as needed */
            border-radius: 50%; /* Make it circular */
            overflow: hidden; /* Hide overflow */
    }
    .text-center-modal .modal-header,
        .text-center-modal .modal-body,
        .text-center-modal .modal-footer {
            text-align: center;
        }

        .text-center-modal .modal-body p {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .text-center-modal .modal-body img {
            margin-top: 10px;
        }

        .dark-mode .dkmodel{
            background-color: #2e2e2e;
            color: #ccc;
        }
</style>

<div class="container-fluid album" style="margin-top: -220px;">
    <div class="row"  style="padding-top: 50px;">
        <div class="col-md-2"><a href="../admin/albums.php" class="btn btn-success">Back</a></div>
    </div>
    <h2 class="text-center">Album Details</h2>
    <div class="row ">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-3 album_detail text-center">
                    <?php
                    foreach ($albums as $album) {
                        if ($album['album_id'] == $id) {
                            $new = $album;
                        }
                    }   
                    echo "<img src='../album_photo/".$new['album_photo']."' class='text-center' style='width: 150px; height: 150px; border-radius: 50%; object-fit: cover;' />";
                    echo "<h3>".$new['album_name']."</h3>";
                    ?>
                </div>
                <div class="col-md-8" style="padding-left: 20px;">
                    <div class="row album_detail d-flex justify-content-center" style="padding: 30px;">
                        <?php
                        echo "<h3>Artist : ".$new['artist_name']."</h3>";
                        ?>
                    </div>
                    <div class="row album_detail" style="padding: 30px;">
                        <?php
                        echo "<h3>Release Date : ".$new['release_date']."</h3>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h3 class="text-center">Tracks</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped dktable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Song Title</th>
                        <th>Mp-3 File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($tracks as $track) {
                        if ($track['delete_status'] == null) {
                            echo "<tr>";
                            echo "<td>{$track['track_id']}</td>";
                            echo "<td>{$track['track_title']}</td>";
                            echo "<td>{$track['url']}</td>";
                            echo "<td><button type='button' class='btn btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#trackModal' 
                                    track-id='{$track['track_id']}' 
                                    track-name='{$track['track_title']}' 
                                    track-url='{$track['url']}' 
                                    track-artistId='{$track['artist_name']}' 
                                    track-albumId='{$track['album_name']}' 
                                    track-alphoto='{$track['album_photo']}' 
                                    track-typeId='{$track['type_name']}''>View</button></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-center-modal" id="modalbody">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="trackModalLabel">Song Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Album Photo:</strong> <img src="" alt="" id="albumPhoto" class="circular-image"></p>
                <!-- <p><strong>ID:</strong> <span id="trackId"></span></p> -->
                <p><strong>Title:</strong> <span id="trackTitle"></span></p>
                <p><strong>URL:</strong> <span id="url"></span></p>
                <p><strong>Artist Name:</strong> <span id="arId"></span></p>
                <p><strong>Album Name:</strong> <span id="alId"></span></p>
                <p><strong>Type:</strong> <span id="type"></span></p>
            </div>
            <div class="modal-footer">
                <a id="downloadButton" class="btn btn-secondary">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log();
        var viewButtons = document.querySelectorAll('.view-btn');
        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var trackTitle = button.getAttribute('track-name');
                var trackURL = button.getAttribute('track-url');
                var trackArname = button.getAttribute('track-artistId');
                var trackAlname = button.getAttribute('track-albumId');
                var trackAlphoto = button.getAttribute('track-alphoto');
                var trackType = button.getAttribute('track-typeId');
                
                document.getElementById('albumPhoto').src = `../album_photo/${trackAlphoto}`;
                // document.getElementById('trackId').innerText = trackId;
                document.getElementById('trackTitle').innerText = trackTitle;
                document.getElementById('url').innerText = trackURL;
                document.getElementById('arId').innerText = trackArname;
                document.getElementById('alId').innerText = trackAlname;
                document.getElementById('albumPhoto').innerText = trackAlphoto;
                document.getElementById('type').innerText = trackType;
                document.getElementById('modalbody').classList.add('dkmodel');

                var downloadButton = document.getElementById('downloadButton');
                downloadButton.href = trackURL;
                downloadButton.download = trackTitle;
            });
        });
    });
</script>

<?php
include_once '../layout/footer.php';
?>
