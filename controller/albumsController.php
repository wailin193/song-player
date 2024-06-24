<?php 

include_once '../model/albumsModel.php';

class AlbumsController{

    public $album;

    function __construct()
    {
        $this->album = new AlbumsModel();
    }

    function getAlbums(){
        return $this->album->getAlbums();
    }

    function addAlbums($name,$rdate,$photo){
        return $this->album->addAlbums($name,$rdate,$photo);
    }

    function getName($id)
    {
        return $this->album->getName($id);
    }

    function editAlbum($id)
    {
        return $this->album->editalbum($id);
    }

    function updateAlbum($id,$name,$rdate,$photo)
    {
        return $this->album->updateAlbum($id,$name,$rdate,$photo);
    }

    public function deleteAlbum($id)
    {
        return $this->album->deleteAlbum($id);
    }

    public function detailTrack($album_id){
        return $this->album->detailTrack($album_id);
    }
}

?>