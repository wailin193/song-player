<?php 

class Database {

 public static $dbname = "song_project";
 public static $password = "";
 public static $host = "localhost";
 public static $username = "root";
 public static $connection;

 public static function connect(){
    try{
        self::$connection = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname.";",self::$username,self::$password);
        return self::$connection; 
    }
    catch(PDOException $e){
        return $e->getMessage();
    }
 }

 public static function disconnect(){
    return    self::$connection = null;
 }


}

?>