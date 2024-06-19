<?php
session_start();
include('connection.php');

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
$query = "DELETE FROM clubes_favoritos WHERE user = ? AND clube = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 'ii', $iduser, $idclube);
mysqli_stmt_execute($stmt);

// Verifica se a query foi executada com sucesso
if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo 'success';
} else {
    echo 'error: Não foi possível remover o clube dos favoritos.'; 
}

// Fecha a declaração e a conexão com o banco de dados
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
