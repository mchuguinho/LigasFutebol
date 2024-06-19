<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_clube = $_POST['id_clubeInp'];
    $nome = $_POST['clubeNome'];
    $cidade = $_POST['clubeCidade'];
    $logo = $_POST['clubeLogo'];

    // Verificar se algum dos campos obrigatórios está vazio
    if (!empty($nome) && !empty($cidade) && !empty($logo)) {
        // Prevenir SQL injection
        $id_clube = mysqli_real_escape_string($con, $id_clube);
        $nome = mysqli_real_escape_string($con, $nome);
        $cidade = mysqli_real_escape_string($con, $cidade);
        $logo = mysqli_real_escape_string($con, $logo);

        $query = "UPDATE `clubes` SET `nome`='$nome', `cidade`='$cidade', `logotipo`='$logo' WHERE `id_clube` = $id_clube";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        error_log("Campos vazios: id_clube=$id_clube, nome=$nome, cidade=$cidade, logo=$logo");
        echo 'missing';
    }
}

mysqli_close($con);
?>