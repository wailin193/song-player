<?php 

include_once '../model/artistsModel.php';

class ArtistController{
    public $artist;
    function __construct()
    {
        $this->artist = new artistModel();
    }

    public function getArtists(){
        return $this->artist->getArtists();
    }

    public function addArtists($aname,$acountry,$aphoto){
        return $this->artist->addArtists($aname,$acountry,$aphoto);
    }

    public function getName($id)
    {
        return $this->artist->getName($id);
    }

    public function editArtist($id)
    {
        return $this->artist->editArtist($id);
    }

    public function updateArtist($id,$name,$country,$photo)
    {
        return $this->artist->updateArtist($id,$name,$country,$photo);
    }

    public function deleteArtist($id)
    {
        return $this->artist->deleteArtist($id);
    }

    public function getAlbum($id)
    {
        return $this->artist->getAlbum($id);
    }
}

?>