<?php

  session_start();
  include ('connection.php');

  $idliga = $_GET['id_liga'] ;

  $query = "SELECT clubes.*, liga.nome AS nome_liga FROM clubes INNER JOIN liga ON clubes.liga = liga.id_liga WHERE clubes.liga = $idliga";
  $result = mysqli_query($con, $query);
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body>
  <div class="maskBlack" style="height: -webkit-fill-available">

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
        </li>

      </div>
    </nav>

    <div class="container">

      <div class="card">
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col-md-1">
                <a href="admin.php">
                  <img src="img/backarrow.png" id="backarrow">
                </a>
              </div>
              <div class="col-md-11 content-yes">
                <h3 class="card-title">Gerir Clubes da Liga</h3>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped align-middle">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Logo</th>
                  <th scope="col">Liga</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Cidade</th>
                  <th scope="col">Fundação</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody id="userAdmin">
                <?php
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<th class="align-middle">' . $row['id_clube'] . '</th>';
                    echo '<td class="align-middle"><img id="imagemAdmin" class="img-fluid logocircular" src="img/clubs/' . $row['logotipo'] . '"></td>';
                  echo '<td class="align-middle">' . $row['nome_liga'] . '</td>';
                    echo '<td class="align-middle">' . $row['nome'] . '</td>';
                    echo '<td class="align-middle">' . $row['cidade'] . '</td>';
                    echo '<td class="align-middle">' . $row['fundacao'] . '</td>';
                    echo '<td class="align-middle"><button type="button" class="btn btn-primary btn-outline-light" data-bs-toggle="modal" data-logo="' . $row['logotipo'] . '" data-nome="' . $row['nome'] . '" data-cidade="' . $row['cidade'] . '" data-bs-target="#modalClube" data-bs-whatever="' . $row['id_clube'] . '">Editar Clube</button></td>';
                    echo '<td class="align-middle"><a class="btn btn-danger btn-outline-light" href="eliminarClube.php?id_liga=' . $row['liga'] . '&id_clube='. $row['id_clube'] . '" role="button">Eliminar</a></td>';
                    echo '</tr>';
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-footer">
          <button type="button" class="btn btn-dark btn-outline-light" data-bs-toggle="modal"
            data-bs-target="#modalClube">Adicionar</button>
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
                                    <th scope="col"><input type="text" class="form-control" name="logo" id="ligaLogo" placeholder="Cidade"></th>
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



    <!-- MODAL Clube -->
    <div class="modal fade" id="modalClube" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal Clube</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="updateclube.php" method="POST" id="updateClubForm">
            <div class="modal-body table-responsive form-group">
              <input type="hidden" id="id_clubeInp" name="id_clubeInp">
              <table class="table table-striped align-middle table-responsive table-sm">
                <thead>
                  <tr>
                    <th scope="col"><input type="text" class="form-control" id="clubeNome" name="clubeNome"
                        placeholder="Nome"></th>
                    <th scope="col"><input type="text" class="form-control" id="clubeCidade" name="clubeCidade"
                        placeholder="Cidade"></th>
                    <th scope="col"><input type="text" class="form-control" id="clubeLogo" name="clubeLogo"
                        placeholder="Logo"></th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-success">Guardar Alterações</button>
            </div>
          </form>
          

        </div>
      </div>
    </div>
  </div>

  <script>

    document.addEventListener('DOMContentLoaded', function () {
      var modalClube = document.getElementById('modalClube');
      modalClube.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-bs-whatever');
        var nome = button.getAttribute('data-nome');
        var logo = button.getAttribute('data-logo');
        var cidade = button.getAttribute('data-cidade');

        var modalTitle = modalClube.querySelector('.modal-title');
        var clubeId = modalClube.querySelector('#id_clubeInp');
        var clubeNome = modalClube.querySelector('#clubeNome');
        var clubeLogo = modalClube.querySelector('#clubeLogo');
        var clubeCidade = modalClube.querySelector('#clubeCidade');

        if (id) {
          modalTitle.textContent = 'Editar Clube';
          clubeId.value = id;
          clubeNome.value = nome;
          clubeLogo.value = logo;
          clubeCidade.value = cidade;
        } else {
          modalTitle.textContent = 'Adicionar Clube';
          clubeId.value = '';
          clubeNome.value = '';
          clubeLogo.value = '';
          clubeCidade.value = '';
        }
      });
    });

    $(document).ready(function () {
      $('#updateClubForm').submit(function (e) {
        e.preventDefault(); // Evita a submissão normal do formulário

        // Obtém os dados do formulário
        var formData = $(this).serialize();
        console.log("Dados do formulário: ", formData);  // Adicione esta linha

        // Função para mostrar notificações
        function showToast(options) {
          Toastify({
            text: options.text,
            duration: options.duration || 3000,
            close: options.close === undefined ? true : options.close,
            position: options.position || 'top-right',
            className: options.className || ''
          }).showToast();
        }

        // Envia a requisição AJAX
        $.ajax({
          type: 'POST',
          url: 'updateclube.php', // Arquivo PHP onde o formulário será submetido
          data: formData,
          success: function (response) {
            // Processa a resposta do servidor
            if (response.trim() === 'success') {
              showToast({
                text: 'Clube atualizado com sucesso!',
                duration: 3000,
                position: 'top-right',
                close: true // Mostrar o botão de fechar
              });
              setTimeout(function () {
                window.location.href = 'admin.php';
              }, 3000);
            } else if (response.trim() === 'error') {
              showToast({
                text: 'Não deu para atualizar os dados!',
                duration: 3000,
                position: 'top-right',
                close: true // Mostrar o botão de fechar
              });
            }
          }
        });
      });
    });

  </script>
</body>

</html>