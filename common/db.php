<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $databse = "discuss";

    $conn = new mysqli($host,$username,$password,$databse);

    if($conn->connect_error){
        die("Error While Connecting Database!!!");
    }
?>