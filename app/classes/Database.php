<?php


namespace App\classes;


class Database{
    public function dbConnection(){
        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $dbName ="login_registration_system";
        $link = mysqli_connect($hostName,$userName,$password,$dbName);
        return $link;
    }
}