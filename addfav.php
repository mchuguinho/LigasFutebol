<?php 
    session_start();
    include ('connection.php');

    $idclube = $_GET['id_clube'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO clubes_favoritos (user, clube) VALUES ($user_id, $idclube)";

    if (mysqli_query($con, $query)){
        header("Location: clubes_fav.php");
    } else {
        header("Location: clubes.php");
    }
    mysqli_close($con);
?>