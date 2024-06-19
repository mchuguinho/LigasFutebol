<?php
    session_start();
    include ('connection.php');

    // Verifica se o usuário está logado
    if (!isset($_SESSION['user_id'])) {
        die('error: Usuário não está logado.');
    }

    // Obtém o ID do usuário da sessão e o ID do clube a ser removido dos favoritos
    $iduser = $_SESSION['user_id'];
    $idclube = isset($_GET['id_clube']) ? $_GET['id_clube'] : '';

    // Verifica se o ID do clube é válido
    if (empty($idclube)) {
        die('error: ID do clube não foi fornecido.');
    }

    // Prepara e executa a query de deleção
    $query = "DELETE FROM clubes_favoritos WHERE user = '$iduser' AND clube = '$idclube'";
    $result = mysqli_query($con, $query);

    // Verifica se a query foi executada com sucesso
    if ($result) {
        echo 'success';
    } else {
        echo 'error: ' . mysqli_error($con); // Exibe o erro MySQL, se houver
    }

// Fecha a conexão com o banco de dados
    mysqli_close($con);
?>