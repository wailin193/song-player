<?php 
ob_start(); // Start output buffering

include_once '../layout/sidebar.php';
include_once '../controller/typesController.php';

$types = new TypesController();

if(isset($_POST['add'])){
    $error = false;
    if(!empty($_POST['type'])){
        $type = $_POST['type'];
    }
    else {
        $error = true;
        echo "add music type";
    }

    if(!$error){
        $status = $types->addTypes($type);
        if($status){
            $message = "success";
            header('Location: types.php?status=' . $message);
            ob_end_flush(); // Flush output buffer
            exit(); // Ensure no further code is executed
        }
    }
}
?>

<div class="container-fluid pt-3">
    <div class="row" style="padding-top: 50px;">
        <div class="col-md-2"><a href="../admin/types.php" class="btn btn-success">Back</a></div>
    </div>
    <div class="row">
        <form action="" method="post">
            <div class="row"> 
                <div class="">
                    <label for="" class="form-label">Song Type</label>
                    <input type="text" class="form-control" name="type">
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
