<?php 
ob_start(); // Start output buffering

include_once '../layout/sidebar.php';
include_once '../controller/typesController.php';

$types = new TypesController();
$results = $types->getTypes();

if(isset($_GET['status'])) {
    $status = $_GET['status'];
    if($status == 'success') {
        echo "<div class='alert alert-success'>Successfully Updated.</div>";
    }
    else if($status == 'fail') {
        echo "<div class='alert alert-danger'>Cannot Delete</div>";
    }
}
?>

<div class="container-fluid">
    <div class="row my-3">
        <div class="col-md-3">
            <a href="add-type.php" class="btn btn-success">Add New Type</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-row">
            <table class="table table-striped dktable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Music Types</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($results as $type){
                        if($type['delete_status'] == null) {
                            echo "<tr>";
                            echo "<td>{$type['type_id']}</td>";
                            echo "<td>{$type['type_name']}</td>";
                            echo "<td><a href='../delete/deleteType.php?id={$type['type_id']}' class='btn btn-danger m-1'>Delete</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var viewButtons = document.querySelectorAll('.view-button');
    viewButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var name = this.getAttribute('data-name');
            document.querySelector('.modal-title').innerText = 'Details for ' + name;
            document.querySelector('.modal-body').innerText = 'ID: ' + id + '\nName: ' + name;
        });
    });
});
</script>

<?php 
include_once '../layout/footer.php';
ob_end_flush(); // Flush output buffer if necessary
?>
