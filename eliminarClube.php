<?php
    session_start();
    include ('connection.php');

    

    if (isset($_GET['id_liga']) && isset($_GET['id_clube'])) {

    $idclube = $_GET['id_clube'];
    $idliga= $_GET['id_liga'];


    $query= "SELECT liga FROM `clubes` WHERE id_clube = $idclube";
    $result = mysqli_query($con, $query);

    $query2 = "DELETE FROM `clubes_favoritos` WHERE `clube` = $idclube";
    $result2 = mysqli_query($con, $query2);

    $query3 = "DELETE FROM `clubes` WHERE `id_clube` = $idclube";
    $result3 = mysqli_query($con, $query3);    

    header("Location:editar.php?id_liga=$idliga");

    exit;
}
        
?>