<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_user = $_POST['id_userInp'];
    $nome = $_POST['nomeUp'];
    $apelido = $_POST['apelidoUp'];
    $email = $_POST['emailUp'];
    $pass = $_POST['passUp'];
    $tipouser = $_POST['tipouser'];

    // Check if any of the required fields are empty
    if (!empty($id_user) && !empty($nome) && !empty($email) && !empty($pass)) {
        // Join first name and last name
        $nomeCompleto = $nome . ' ' . $apelido;

        // Prevent SQL injection
        $id_user = mysqli_real_escape_string($con, $id_user);
        $nomeCompleto = mysqli_real_escape_string($con, $nomeCompleto);
        $email = mysqli_real_escape_string($con, $email);
        $pass = mysqli_real_escape_string($con, $pass);
        $tipouser = mysqli_real_escape_string($con, $tipouser);

        $query2 = "UPDATE `user` SET `nome`='$nomeCompleto', `email`='$email', `password`='$pass', `tipo`='$tipouser' WHERE `id_user` = $id_user";

        $result = mysqli_query($con, $query2);

        if ($result) {
            echo 'success';
        } else {
            // Log the error for debugging purposes
            error_log("Database update error: " . mysqli_error($con));
            echo 'error';
        }
    } else {
        echo 'missing';
    }
}

mysqli_close($con);
?>
