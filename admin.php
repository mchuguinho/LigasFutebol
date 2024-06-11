<?php

  session_start();
  include ('connection.php');

  $query1 = "SELECT * FROM liga";
  $result1 = mysqli_query($con, $query1);

  $query2 = "SELECT * FROM clubes";
  $result2 = mysqli_query($con, $query2);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ligas de futebol</title>
  <link rel="icon" type="image/x-icon" href="img/logo.png">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <script src="jquery/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>
  <div class="maskBlack">

    <nav class="navbar navbar-expand-sm bg-info navbar-dark bg-dark ">

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
                  <th>Editar Clubs da Liga</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody id="leagues">

              <?php
                if (mysqli_num_rows($result1) > 0) {
                  while ($row = mysqli_fetch_assoc($result1)) {
                    $ligas[] = $row;

                    echo '<tr>';
                    echo '<th class="align-middle">' . $row['id_liga'] .'</th>';
                    echo '<td class="align-middle"><img id="imagemAdmin"class="img-fluid logocircular" src="img/leagues/' . $row['logotipo'] . '"></td>';
                    echo '<td class="align-middle">' . $row['nome'] . '</td>';
                    echo '<td class="align-middle"><button type="button" class="btn btn-primary btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalLiga" data-bs-whatever="' . $row['nome'] . '">Editar</button></td>';
                    echo '<td class="align-middle"><button type="button" class="btn btn-primary btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalClub" data-bs-whatever="${league.name}">Editar Clubes</button></td>';
                    echo '<td class="align-middle"><a class="btn btn-danger btn-outline-light" onclick="showAlertEliminado()" role="button">Eliminar</a></td>';
                    echo '</tr>';
                  }
                }
        ?>

            </tbody>

            </table>
          </div>

          </div>
          <div class="card-footer">
            <a class="btn btn-dark btn-outline-light" role="button">Adicionar</a>
          </div>
        </div>
    
</div>  

    <!-- MODAL LIGAS-->
    <div class="modal fade modal-dialog-scrollable" id="modalLiga" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal Liga</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body table-responsive">

            <table class="table table-striped align-middle table-responsive table-sm">
              <thead>
                <tr>
                  <th scope="col"><input type="nome" class="form-control" id="idUser" placeholder="Nome"></th>
                  <th scope="col"><input type="nome" class="form-control" id="idUser" placeholder="Logo (??)"></th>
                </tr>
              </thead>
              <tbody id="mLiga">
              </tbody>
            </table>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-success btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalV2" onclick="showAlertGuardado()">Guardar Alterações</button>
            </div>
          </div>
        </div>
      </div>

    <!-------------------------------------------------------------------------------- MODAL VARIOS Clubes -------------------------------------------------------------------------------------------->
    <div class="modal fade" id="modalClub" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal Clubes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body table-responsive">

            <table class="table table-striped align-middle table-responsive table-sm">
              <thead>
                <tr>
                  <th scope="col">Logo</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Cidade</th>
                  <th scope="col">Fundação</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody id="mClub">
              </tbody>
            </table>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-success" onclick="showAlertGuardado()">Guardar Alterações</button>
            </div>
          </div>
        </div>
      </div>

    <!-------------------------------------------------------------------------------- MODAL CLUBE SOLO-------------------------------------------------------------------------------------------->
    <div class="modal fade modal-dialog-scrollable" id="modalClubSolo" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal Clube</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body table-responsive">

            <table class="table table-striped align-middle table-responsive table-sm">
              <thead>
                <tr>
                  <th scope="col"><input type="nome" class="form-control" id="idUser" placeholder="Logo (??)"></th>
                  <th scope="col"><input type="nome" class="form-control" id="idUser" placeholder="Nome"></th>
                  <th scope="col"><input type="nome" class="form-control" id="idUser" placeholder="Cidade"></th>
                  <th scope="col"><input type="nome" class="form-control" id="idUser" placeholder="Fundação"></th>
                </tr>
              </thead>
              <tbody id="mClubSolo">
              </tbody>
            </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalV2" onclick="showAlertGuardado()">Guardar Alterações</button>
      </div>
    </div>
  </div>
</div>

  </div>
  </div>

  <!-- <script src="js/admin.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>