<?php
include_once '../controller/typesController.php';

$id=$_GET['id'];
$type_controller = new TypesController;
$status= $type_controller->deleteType($id);

if($status)
{
    header('location:../admin/types.php?status=success');
}
else{
    header('location:../admin/types.php?status=fail');
}
?>