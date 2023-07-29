<?php

require_once("config.php");

// Its a code to make a connection with database

try{
    $pdo = new PDO("mysql:dbname=$database;host=$host;charset=utf8","$user","$password");

}
catch(Exception $e){
    echo 'Error in the Connection with database!'.$e;
}
?>