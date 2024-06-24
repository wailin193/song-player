<?php
include_once '../model/usersModel.php';

class UsersController{
    public $user;
    function __construct()
    {
        $this->user = new UsersModel();
    }
    function getUsers(){
        return $this->user->getUsers();
    }
}

?>