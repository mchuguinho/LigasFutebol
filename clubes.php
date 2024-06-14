<?php 

  session_start();
  include ('connection.php');

  $idliga = $_GET['id_liga'];

  $query = "SELECT * FROM clubes WHERE liga = $idliga";
  $result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                echo '<a class="nav-link" href="login.html">Login</a>';
              }
              ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <a href="index.php"><img src="img/backarrow.png" id="backarrow"></a>
    <h1 class="h1" id="header"></h1>
    <div class="container">
      <div class="row" id="clubs">
      <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $clubes[] = $row;
            echo '<div class="col-md-3">';
            echo '<div class="card">';
              echo '<img src="img/clubs/'.$row['logotipo'].'" class="card-img-top" alt="'.$row['nome'].'">';
              echo '<div class="card-body">';
                echo '<h3 class="card-title">'.$row['nome'].'</h3>';
                echo '<p class="card-text">Clique no botão abaixo para ver mais detalhes sobre este clube!</p>';
                echo '<div class="container info-fav">';
                echo '<button class="btn btn-dark btn-card" data-club="'.$row['id_clube'].'" data-nome="'.$row['nome'].'" data-cidade="'.$row['cidade'].'" onclick="requestMeteoApi("'.$row['cidade'].'");requestFlickrApi("'.$row['nome'].'")" data-toggle="modal" data-target="#modalInfo">Ver mais detalhes</button>';
                echo '<a href="addfav.php?id_clube='.$row['id_clube'].'"><img src="img/heart.png" class="icon-fav"></a>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
          }
        }
        ?>
      </div>
    </div>
    </nav>
    <h1 class="h1" id="header"></h1>
    <div class="container">
      <div class="row" id="clubs"></div>
    </div>
    <div id="modalInfo" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
          <div class="modal-header">
            <h2 id="nomeClube" class="modal-title text-center"></h2>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-danger">
              Fechar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="js/clubes.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>