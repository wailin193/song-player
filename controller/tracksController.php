<?php 

include_once '../model/tracksModel.php';

class TracksController{

    public $track;

    public function __construct()
    {
        $this->track = new TracksModel();
    }

    function getTracks(){
        return $this->track->getTracks();
    }

    function addTracks($title,$url,$artist_id,$album_id,$track_id){
        return $this->track->addTracks($title,$url,$artist_id,$album_id,$track_id);
    }

    function getSong($title){
        return $this->track->getSong($title);
    }

    public function editTrack($id)
    {
        return $this->track->editTrack($id);
    }

    public function updateTrack($id, $title, $url, $album, $type, $artist)
    {
        return $this->track->updateTrack($id, $title, $url, $album, $type, $artist);
    }

    public function deleteTrack($id)
    {
        return $this->track->deleteTrack($id);
    }
}

?>