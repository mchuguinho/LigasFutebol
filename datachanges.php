<?php
session_start();
include ("connection.php");

$id = $_SESSION['user_id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$pass = $_POST['password'];

if (!empty($nome) && !empty($email) && !empty($pass)) {
    // Juntar os nomes

    // Prevenir SQL injection
    $id = mysqli_real_escape_string($con, $id);
    $nome = mysqli_real_escape_string($con, $nome);
    $email = mysqli_real_escape_string($con, $email);
    $pass = mysqli_real_escape_string($con, $pass);

    $query = "UPDATE `user` SET `nome`='$nome', `email`='$email', `password`='$pass' WHERE `id_user` = $id";

    $result = mysqli_query($con, $query);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'missing';
}

mysqli_close($con);



?>