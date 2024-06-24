<?php
include_once '../layout/sidebar.php';
include_once '../controller/usersController.php';

$users = new UsersController();
$results = $users->getUsers();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-row">
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User_Id</th>
                            <th>User_Name</th>
                            <th>User_Email</th>
                            <th>User_Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($results as $user){
                            echo "<tr>";
                            echo "<td>{$user['user_id']}</td>";
                            echo "<td>{$user['user_name']}</td>";
                            echo "<td>{$user['user_email']}</td>";
                            echo "<td>{$user['user_password']}</td>";
                            echo "<td><a href='' class='btn btn-primary m-1'>View</a><a href='' class='btn btn-primary m-1'>Edit</a><a href='' class='btn btn-danger m-1'>Delete</a></td>";
                            echo "</tr>";
                        }
                        ?>
            </tbody>
        </div>
    </div>
</div>


<?php
include_once '../layout/footer.php';
?>