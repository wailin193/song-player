<?php 
include_once '../include/db.php';


class AlbumsModel{

    public $statement,$con;

    function albumsFromTrack() {
        $this->con = Database::connect();
        $sql = "SELECT distinct albums.album_id, albums.album_name, albums.album_photo, albums.release_date, albums.delete_status, artists.artist_name
                FROM tracks
                JOIN artists ON tracks.artist_id=artists.artist_id 
                JOIN albums ON tracks.album_id=albums.album_id";
        $this->statement = $this->con->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        return false;
    }

    function getAlbums() {
        $this->con = Database::connect();
        $sql = "SELECT * from albums";
        $this->statement = $this->con->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        return false;
    }

    function addAlbums($title, $rdate, $photo) {
        $this->con = Database::connect();
        $sql = "INSERT INTO albums (album_name, release_date, album_photo) VALUES (:name, :release, :photo)";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(':name', $title);
        $this->statement->bindParam(':release', $rdate);
        $this->statement->bindParam(':photo', $photo);
        return $this->statement->execute();
    }
    

    function getName($name) {
        $this->con = Database::connect();
        $sql = "SELECT count(*) as total FROM albums WHERE album_name = :caption";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(':caption', $name);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        } else {
            return false;
        }
    }

    public function editAlbum($id)
    {
        $this->con = Database::connect();
        $sql="select * from albums where album_id=:id";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":id",$id);
        if($this->statement->execute())
        {
            $result = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function updateAlbum($id, $name, $rdate, $photo)
    {
        $this->con = Database::connect();
        $sql = "update albums set album_name=:name,release_date=:rdate,album_photo=:photo where album_id=:id";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":id", $id);
        $this->statement->bindParam(":name", $name);
        $this->statement->bindParam(":rdate", $rdate);
        $this->statement->bindParam(":photo", $photo);
        return $this->statement->execute();
    }

    public function deleteAlbum($id) {
        $status = "deleted";
        $this->con = Database::connect();
        $sql1 = "SELECT * FROM tracks WHERE album_id = :id";
        $statement1 = $this->con->prepare($sql1);
        $statement1->bindParam(":id", $id);
        if ($statement1->execute()) {
            $tracks = $statement1->fetchAll(PDO::FETCH_ASSOC);
            if (sizeof($tracks) == 0) {
                $sql = "UPDATE albums SET delete_status = :status WHERE album_id = :id";
                $this->statement = $this->con->prepare($sql);
                $this->statement->bindParam(":id", $id);
                $this->statement->bindParam(":status", $status);
                return $this->statement->execute();
            }
            return false;
        }
    }

    public function detailTrack($album_id){
        $this->con = Database::connect();
        $sql = "select * 
            FROM tracks 
            join albums on tracks.album_id=albums.album_id
            join artists on tracks.artist_id=artists.artist_id
            join music_types on tracks.type_id=music_types.type_id
            where albums.album_id=:id";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":id", $album_id);
        if($this->statement->execute()){
            $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}

?>