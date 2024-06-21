<?php
session_start();
include('connection.php');

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 0) {
    header("Location: index.php");
    exit();
}

$query1 = "SELECT * FROM liga";
$result1 = mysqli_query($con, $query1);

if (isset($_GET['id_liga'])) {
    $idliga = $_GET['id_liga'];

    $query3 = "DELETE FROM `liga` WHERE `id_liga` = $idliga";
    $result3 = mysqli_query($con, $query3);

    if ($result3) {
        echo "<script>
            Toastify({
                text: 'Dados eliminados com sucesso!',
                duration: 1500,
                close: true,
                gravity: 'top',
                backgroundColor: 'linear-gradient(to right, #ff0000, #ff0000)',
            }).showToast();
        </script>";
    } else {
        echo "<script>
            Toastify({
                text: 'Erro ao eliminar dados!',
                duration: 1500,
                close: true,
                gravity: 'top',
                backgroundColor: 'linear-gradient(to right, #ff0000, #ff0000)',
            }).showToast();
        </script>";
    }
    header("Location: admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'createLiga') {
        $nome = $_POST['nome'];
        $logo = $_POST['logo'];
        $query = "INSERT INTO liga (nome, logotipo) VALUES ('$nome', '$logo')";
        mysqli_query($con, $query);
    } elseif ($action == 'updateLiga') {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $logo = $_POST['logo'];
        $query = "UPDATE liga SET nome='$nome', logotipo='$logo' WHERE id_liga=$id";
        mysqli_query($con, $query);
    }
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ligas de futebol</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="jquery/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
<div class="maskBlack" style="height: -webkit-fill-available">
    <nav class="navbar navbar-expand-sm bg-info navbar-dark bg-dark">
        <div class="container-fluid">
            <h4 class="text-white">DASHBOARD</h4>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="admin.php" role="button">Ligas</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="uadmin.php" role="button">Users</a>
                </li>
            </ul>
            <li class="nav-item">
                <a class="btn btn-outline-light" href="index.php" role="button">Sair</a>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Gerir Ligas</h3>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Logo</th>
                                <th>Nome da Liga</th>
                                <th>Editar Liga</th>
                                <th>Editar Clubes da Liga</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="leagues">
                        <?php
                        if (mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                echo '<tr>';
                                echo '<th class="align-middle">' . $row['id_liga'] . '</th>';
                                echo '<td class="align-middle"><img id="imagemAdmin" class="img-fluid logocircular" src="img/leagues/' . $row['logotipo'] . '"></td>';
                                echo '<td class="align-middle">' . $row['nome'] . '</td>';
                                echo '<td class="align-middle"><button type="button" class="btn btn-primary btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalLiga" data-id="' . $row['id_liga'] . '" data-nome="' . $row['nome'] . '" data-logo="' . $row['logotipo'] . '">Editar</button></td>';
                                echo '<td class="align-middle"><a role="button" class="btn btn-primary btn-outline-light" href="editar.php?id_liga=' . $row['id_liga'] .'">Editar Clubes</a></td>';
                                echo '<td class="align-middle"><a class="btn btn-danger btn-outline-light" onclick="return confirm(\'Tem certeza que deseja deletar esta liga?\')" href="admin.php?id_liga=' . $row['id_liga'] . '" role="button">Eliminar</a></td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-dark btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalLiga" data-id="" data-nome="" data-logo="">Adicionar</button>
            </div>
        </div>
    </div>

    <!-- MODAL LIGAS-->
    <div class="modal fade modal-dialog-scrollable" id="modalLiga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gerir Liga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                    <form action="admin.php" method="post">
                        <input type="hidden" name="action" id="ligaAction">
                        <input type="hidden" name="id" id="ligaId">
                        <table class="table table-striped align-middle table-responsive table-sm">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="text" class="form-control" name="nome" id="ligaNome" placeholder="Nome"></th>
                                    <th scope="col"><input type="text" class="form-control" name="logo" id="ligaLogo" placeholder="Logo"></th>
                                </tr>
                            </thead>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success" onclick="showAlertGuardado()">Guardar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CLUBES -->
    <div class="modal fade modal-dialog-scrollable" id="modalClub" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gerir Clubes da Liga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                    <div class="container-fluid">
                        <div id="clubesTabela"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="admin.php" method="post">
                        <input type="hidden" name="action" value="createClube">
                        <input type="hidden" name="liga_id" id="clubLigaId">
                        <table class="table table-striped align-middle table-responsive table-sm">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="text" class="form-control" name="nome" placeholder="Nome"></th>
                                    <th scope="col"><input type="text" class="form-control" name="logo" placeholder="Logo"></th>
                                    <th scope="col"><input type="text" class="form-control" name="cidade" placeholder="Cidade"></th>
                                    <th scope="col"><input type="number" class="form-control" name="fundacao" placeholder="Ano de Fundação"></th>
                                </tr>
                            </thead>
                        </table>
                        <button type="submit" class="btn btn-success" onclick="showAlertGuardado()">Adicionar Clube</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="js/admin.js"></script>

</body>
</html>

