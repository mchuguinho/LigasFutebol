<?php 
session_start();
include ('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_user = $_POST['id_userInp'];
    $nome = $_POST['nomeUp'];
    $apelido = $_POST['apelidoUp'];
    $email = $_POST['emailUp'];
    $pass = $_POST['passUp'];


    // Juntar os nomes
    $nomeCompleto = $nome . ' ' . $apelido;

    // Prevenir SQL injection
    $id_user = mysqli_real_escape_string($con, $id_user);
    $nomeCompleto = mysqli_real_escape_string($con, $nomeCompleto);
    $email = mysqli_real_escape_string($con, $email);
    $pass = mysqli_real_escape_string($con, $pass);

    $query2 = "UPDATE `user` SET `nome`='$nomeCompleto', `email`='$email', `password`='$pass' WHERE `id_user` = $id_user";


    $result= mysqli_query($con,$query2);

    if ($result) {
        header("Location: uadmin.php");
        exit();
    } else {
        echo "Deu errado amigo, tente a seguir!!";
    }
}
mysqli_close($con);
?>
