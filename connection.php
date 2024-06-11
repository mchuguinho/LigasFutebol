<?php 
    $dbhost = "localhost";
    $dbuser = "root";
    
    $dbpass = "";
    $dbname = "ligasdefutebol";
    
    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if (!$con) {
        $dbpass = "root";
        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    }
    
    if (!$con) {
        die("Failed to connect!");
    }
?>
