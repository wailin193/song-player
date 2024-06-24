<?php
include_once '../include/db.php';

class UsersModel{
    public $statement,$con;

    function getUsers(){
        $this->con = Database::connect();
        $sql = "select * from users";
        $this->statement = $this->con->prepare($sql);
        if($this->statement->execute()){
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}

?>