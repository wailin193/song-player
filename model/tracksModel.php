<?php 

include_once '../include/db.php';

class TracksModel{

    public $con,$statement;

    function getTracks(){
        $this->con = Database::connect();
        $sql = "select 
        tracks.track_id,
        tracks.track_title,
        tracks.url,
        artists.artist_name,
        albums.album_name,
        albums.album_photo,
        music_types.type_name,
        tracks.delete_status
        from 
            tracks
        join 
            artists ON tracks.artist_id = artists.artist_id
        join 
            albums ON tracks.album_id = albums.album_id
        join 
        music_types ON tracks.type_id = music_types.type_id
        order by tracks.track_id ASC";
        $this->statement = $this->con->prepare($sql);
        if($this->statement->execute()){
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    function addTracks($title,$url,$artist_id,$album_id,$type_id){
        $this->con = Database::connect();
        $sql = "insert into tracks (track_title, url,artist_id, album_id, type_id) values (:name, :link,:artist_id, :album_id, :tid)";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(':name',$title);
        $this->statement->bindParam(':link',$url);
        $this->statement->bindParam(':artist_id',$artist_id);
        $this->statement->bindParam(':album_id',$album_id);
        $this->statement->bindParam(':tid',$type_id);
        return $this->statement->execute();
    }

    function getSong($title){
        $this->con = Database::connect();
        $sql = "select count(*) as total from tracks where track_title =:caption";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(':caption',$title);
        if($this->statement->execute()){
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function editTrack($id)
    {
        $this->con = Database::connect();
        $sql="select * from tracks 
        join 
            artists ON tracks.artist_id = artists.artist_id
        join 
            albums ON tracks.album_id = albums.album_id
        join 
        music_types ON tracks.type_id = music_types.type_id
        where track_id=:id";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":id",$id);
        if($this->statement->execute())
        {
            $result = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function updateTrack($id, $title, $url, $album, $type, $artist)
    {
        $this->con = Database::connect();
        $sql = "update tracks 
            set track_title=:title, 
                url=:url, 
                album_id=:album, 
                type_id=:type, 
                artist_id=:artist 
            where track_id=:id";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":id", $id);
        $this->statement->bindParam(":title", $title);
        $this->statement->bindParam(":url", $url);
        $this->statement->bindParam(":album", $album);
        $this->statement->bindParam(":type", $type);
        $this->statement->bindParam(":artist", $artist);
        return $this->statement->execute();
    }

    public function deleteTrack($id) {
        $status = "deleted";
        $this->con = Database::connect();
        $sql = "update tracks set delete_status=:status where track_id=:id";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":id", $id);
        $this->statement->bindParam(":status", $status);
        return $this->statement->execute();
    }

    
}

?>