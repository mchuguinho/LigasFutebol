<?php
session_start();
include ('connection.php');

$idliga = $_POST['id_ligaInp'];
$nome = $_POST['clubeNomeA'];
$cidade = $_POST['clubeCidadeA'];
$logo = $_POST['clubeLogoA'];
$fundacao = $_POST['clubeFundacaoA'];

if (!empty($nome) && !empty($cidade) && !empty($logo) && !empty($fundacao)) {
    // Prevenir SQL injection
    $nome = mysqli_real_escape_string($con, $nome);
    $cidade = mysqli_real_escape_string($con, $cidade);
    $logo = mysqli_real_escape_string($con, $logo);
    $fundacao = mysqli_real_escape_string($con, $fundacao);

    $query = "INSERT INTO clubes (liga, nome, cidade, logotipo, fundacao) VALUES ('$idliga', '$nome', '$cidade', '$logo', '$fundacao')";
    if (mysqli_query($con, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
