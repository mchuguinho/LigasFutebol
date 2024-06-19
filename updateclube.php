<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_clube = $_POST['id_clubeInp'];
    $nome = $_POST['clubeNome'];
    $cidade = $_POST['clubeCidade'];
    $logo = $_POST['clubeLogo'];
    $fundacao = $_POST['clubeFund'];
    $action = $_POST['action'];


    // Verificar se algum dos campos obrigatórios está vazio
    if (!empty($nome) && !empty($cidade) && !empty($logo) && !empty($fundacao)) {
        // Prevenir SQL injection
        $id_clube = mysqli_real_escape_string($con, $id_clube);
        $nome = mysqli_real_escape_string($con, $nome);
        $cidade = mysqli_real_escape_string($con, $cidade);
        $logo = mysqli_real_escape_string($con, $logo);
        $fundacao =mysqli_real_escape_string($con, $fundacao);

        if ($action == 'criarClube') {
        
            echo $idliga;
    
            $nome = $_POST['clubeNome'];
            $logo = $_POST['clubeLogo'];
            $cidade = $_POST['clubeCidade'];
            $fundacao = $_POST['clubeFund'];
            $query = "INSERT INTO clubes (nome, logotipo, cidade, fundacao, liga) VALUES ('$nome', '$logo', '$cidade', '$fundacao', '$idliga')";
            mysqli_query($con, $query);
            header("Location:editar.php?id_liga=$idliga");
    
        }{
    

        $query = "UPDATE `clubes` SET `nome`='$nome', `cidade`='$cidade', `logotipo`='$logo', `fundacao`='$fundacao' WHERE `id_clube` = $id_clube";
        $result = mysqli_query($con, $query);
        header("Location:editar.php?id_liga=$idliga");

        if ($result) {
            echo 'success';

        } else {
            echo 'error';
        }}
        
    } else {
        // Debugging message
        error_log("Campos vazios: id_clube=$id_clube, nome=$nome, cidade=$cidade, logo=$logo");
        echo 'missing';
    }
}

mysqli_close($con);
?>