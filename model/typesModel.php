<?php 
include_once '../include/db.php';


class TypesModel{

    public $statement,$con;

    function getTypes(){
        $this->con = Database::connect();
        // print_r($this->con);
        $sql = "select * from music_types";
        $this->statement = $this->con->prepare($sql);
        if($this->statement->execute()){
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    function addTypes($type){
        $this->con = Database::connect();
        $sql = "insert into music_types(type_name) values(:typename)";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(':typename',$type);
        return $this->statement->execute();
    }

    function getType($id){
        $this->con = Database::connect();
        $sql = "select * types where type_id =:id";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(':id',$id);
        if($this->statement->execute()){
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function deleteType($id) {
        $status = "deleted";
        $this->con = Database::connect();
        $sql1 = "select * from tracks where type_id=:id";
        $statement1 = $this->con->prepare($sql1);
        $statement1->bindParam(":id", $id);
        if ($statement1->execute()) {
            $tracks = $statement1->fetchAll(PDO::FETCH_ASSOC);
            if (sizeof($tracks) == 0) {
                $sql = "update music_types set delete_status=:status where type_id=:id";
                $this->statement = $this->con->prepare($sql);
                $this->statement->bindParam(":id", $id);
                $this->statement->bindParam(":status", $status);
                return $this->statement->execute();
            }
            return false;
        }
    }
}

?>