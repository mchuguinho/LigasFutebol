<?php
session_start();
include ('connection.php');

$query = "SELECT * FROM liga";
$result = mysqli_query($con, $query);

?>  

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ligas de futebol</title>
  <link rel="icon" type="image/x-icon" href="img/logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
  <div class="maskBlack">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand"><img src="img/logo.png" id="logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <?php
            if (isset($_SESSION['tipo'])) {
              if ($_SESSION['tipo'] == 0) {
                echo '<li class="nav-item">
                <a class="nav-link" href="admin.php">Dashboard</a>
              </li>';
              }
            }
            ?>
            <?php if(isset($_SESSION['user_id'])){
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="clubes_fav.php">Clubes Favoritos</a>';
              echo '</li>';
            }
            
            ?>
            <li class="nav-item">
              <?php if (isset($_SESSION['user_id'])) {
                echo '<div class="dropdown">';
                echo '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bem vindo, ' . $_SESSION['username'] . '</button>';
                echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-top: 2%;">';
                echo '<a class="dropdown-item" href="dados.php">Dados de Perfil</a>';
                echo '<a class="dropdown-item" href="logout.php">Logout</a>';
                echo '</div>';
                echo '</div>';
              } else {
                echo '<a class="nav-link" href="login.php">Login</a>';
              }
              ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <h1 class="header">Bem-vindo à Ligas de Futebol</h1>
    <div class="container">
      <div class="row" id="leagues">
        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $ligas[] = $row;
            echo '<div class="col-md-3">';
            echo '<div class="card">';
            echo '<img src="img/leagues/' . $row['logotipo'] . '" class="card-img-top" alt="' . $row['nome'] . '">';
            echo '<div class="card-body">';
            echo '<h3 class="card-title">' . $row['nome'] . '</h3>';
            echo '<p class="card-text">Clique no botão abaixo para ver os clubes que estão nesta liga!</p>';
            echo '<a class="btn btn-dark btn-card" onclick="showTeams(' . $row['nome'] . ')" href="clubes.php?id_liga=' . $row['id_liga'] . '&nome_liga='.$row['nome'].'" role="button" >Ver clubes</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
        }
        ?>
      </div>

    </div>
  </div>
  </div>
</body>
<script src="js/index.js"></script>

</html>