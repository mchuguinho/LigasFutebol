<!-- Página para buscar os clubes de uma liga específica( não esta a funcionar ) -->
<?php
include('connection.php');

if (isset($_GET['liga_id'])) {
    $liga_id = $_GET['liga_id'];
    $query = "SELECT * FROM clubes WHERE liga_id = $liga_id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-striped align-middle">';
        echo '<thead><tr><th>Id</th><th>Logo</th><th>Nome</th><th>Cidade</th><th>Fundação</th><th>Editar</th><th>Eliminar</th></tr></thead><tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<th class="align-middle">' . $row['id_clube'] . '</th>';
            echo '<td class="align-middle"><img id="imagemAdmin" class="img-fluid logocircular" src="img/clubs/' . $row['logotipo'] . '"></td>';
            echo '<td class="align-middle">' . $row['nome'] . '</td>';
            echo '<td class="align-middle">' . $row['cidade'] . '</td>';
            echo '<td class="align-middle">' . $row['fundacao'] . '</td>';
            echo '<td class="align-middle"><button type="button" class="btn btn-primary btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalEditClube" data-id="' . $row['id_clube'] . '" data-nome="' . $row['nome'] . '" data-logo="' . $row['logotipo'] . '" data-cidade="' . $row['cidade'] . '" data-fundacao="' . $row['fundacao'] . '" data-liga-id="' . $row['liga_id'] . '">Editar</button></td>';
            echo '<td class="align-middle"><form action="admin.php" method="post" onsubmit="return confirm(\'Tem certeza que deseja deletar este clube?\')"><input type="hidden" name="action" value="deleteClube"><input type="hidden" name="id" value="' . $row['id_clube'] . '"><button type="submit" class="btn btn-danger btn-outline-light">Eliminar</button></form></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>Não há clubes nesta liga.</p>';
    }
}
?>
