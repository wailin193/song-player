<?php 
include_once '../include/db.php';


class ArtistModel{

    public $statement,$con;

    function getArtists(){
        $this->con = Database::connect();
        $sql = "select * from artists";
        $this->statement = $this->con->prepare($sql);
        if($this->statement->execute()){
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    function addArtists($aname,$acountry,$aphoto){
        $this->con = Database::connect();
        $sql = "insert into artists(artist_name, artist_country, artist_photo) values (:artist, :location, :image)";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(':artist',$aname);
        $this->statement->bindParam(':location',$acountry);
        $this->statement->bindParam(':image',$aphoto);
        return $this->statement->execute();
    }

    function getName($name){
        $this->con = Database::connect();
        $sql = "select count(*) as total from artists where artist_name =:caption";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(':caption',$name);
        if($this->statement->execute()){
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function editArtist($id)
    {
        $this->con = Database::connect();
        $sql="select * from artists where artist_id=:id";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":id",$id);
        if($this->statement->execute())
        {
            $result = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function updateArtist($id, $name, $country, $photo)
    {
        $this->con = Database::connect();
        $sql = "update artists set artist_name=:name, artist_country=:country, artist_photo=:photo where artist_id=:id";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":id", $id);
        $this->statement->bindParam(":name", $name);
        $this->statement->bindParam(":country", $country);
        $this->statement->bindParam(":photo", $photo);
        return $this->statement->execute();
    }

    public function deleteArtist($id) {
        $status = "deleted";
        $this->con = Database::connect();
        $sql1 = "select * from tracks where type_id=:id";
        $statement1 = $this->con->prepare($sql1);
        $statement1->bindParam(":id", $id);
        if ($statement1->execute()) {
            $tracks = $statement1->fetchAll(PDO::FETCH_ASSOC);
            if (sizeof($tracks) == 0) {
                $sql = "update artists set delete_status=:status where artist_id=:id";
                $this->statement = $this->con->prepare($sql);
                $this->statement->bindParam(":id", $id);
                $this->statement->bindParam(":status", $status);
                return $this->statement->execute();
            }
            return false;
        }
    }

    public function getAlbum($id)
    {
        $this->con = Database::connect();
        $sql = 'select distinct tracks.album_id, albums.album_name, albums.release_date, albums.album_photo
        from tracks 
        join artists on tracks.artist_id=artists.artist_id 
        join albums on tracks.album_id=albums.album_id 
        where artists.artist_id=:id';
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":id",$id);
        if($this->statement->execute())
        {
            $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

}

?>