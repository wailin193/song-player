<?php 

include_once '../layout/sidebar.php';
include_once '../controller/tracksController.php';
include_once '../controller/artistsController.php';
include_once '../controller/albumsController.php';
include_once '../controller/typesController.php';

$track_controller = new TracksController();
$tracks = $track_controller->getTracks();


if(isset($_GET['status']))
{
    $status = $_GET['status'];
    if($status == 'success')
    {
        echo "<div class='alert alert-success'>Successfully Updated.</div>";
    }
    else if($status=='fail')
    {
        echo "<div class='alert alert-danger'>Cannot Delete</div>";
    }
}
?>

<style>
        .circular-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
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

<div class="container-fluid">
    <div class="row my-3">
        <div class="col-md-3">
            <a href="add-song.php" class="btn btn-success">Add New Song</a>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-12">
            <table class="table table-striped dktable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Song Title</th>
                        <th>Mp-3 File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($tracks as $track){
                            if($track['delete_status']==null){
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
                                    track-typeId='{$track['type_name']}''>View</button>
                                        <a href='../edit/editTrack.php?id=".$track['track_id']."' class='btn btn-warning m-1'>Edit</a>
                                        <a href='../delete/deleteTrack.php?id=".$track['track_id']."' class='btn btn-danger m-1'>Delete</a></td>";
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
                document.getElementById('trackTitle').innerText = trackTitle;
                document.getElementById('url').innerText = trackURL;
                document.getElementById('arId').innerText = trackArname;
                document.getElementById('alId').innerText = trackAlname;
                document.getElementById('type').innerText = trackType;

                document.getElementById('modalbody').classList.add('dkmodel');

                // Update the download button href
                var downloadButton = document.getElementById('downloadButton');
                downloadButton.href = trackURL;
                downloadButton.download = trackTitle;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var delayTime = 3000;

        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, delayTime);
    });
</script>

<?php 

include_once '../layout/footer.php';

?>