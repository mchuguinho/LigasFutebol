<?php
session_start();
include ('connection.php');

$userid = $_SESSION['user_id'];

$query = "SELECT * FROM user WHERE id_user = $userid";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ligas de futebol</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</head>

<body>

    <!-- Template modificado-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="img/logo.png" id="logo" /></a>
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
                    <li class="nav-item">
                        <?php if (isset($_SESSION['user_id'])) {
                            echo '<div class="dropdown">';
                            echo '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bem vindo, ' . $_SESSION['username'] . '</button>';
                            echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-top: 2%;">';
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
    </nav>

    <div class="mask d-flex align-items-center h-100 maskBlack">

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <form class="col-12 col-md-8 col-lg-6 col-xl-5" id="login-form" action="datachanges.php" method="POST">
                    <div class="card bg-dark text-white redonda">

                        <!-- Até aqui, levou algumas alterações, para baixo não é template -->

                        <div class="card-title d-flex justify-content-center mt-2">
                            <a class="btn btn-outline-light col-md-6 mt-md-2" href="index.php" role="button">Voltar</a>
                        </div>

                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4">

                                <h2 class="fw-bold">Dados de Perfil</h2>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $dados[] = $row;
                                        echo '<div class="form-outline form-white mb-4 form-floating">';
                                        echo '<input type="text" class="form-control form-control-lg" id="nome" name="nome" value="' . $row['nome'] . '">';
                                        echo '<label for="floatingInput">Nome</label>';
                                        echo '</div>';
                                        echo '<div class="form-outline form-white mb-4 form-floating">';
                                        echo '<input type="email" class="form-control form-control-lg" id="email" name="email" value="' . $row['email'] . '">';
                                        echo '<label for="floatingInput">Email</label>';
                                        echo '</div>';

                                        echo '<div class="form-outline form-white mb-4 form-floating">';
                                        echo '<input type="password" class="form-control form-control-lg" id="password" name="password" value="' . $row['password'] . '">';
                                        echo '<label for="floatingPassword">Password</label>';
                                        echo '</div>';

                                        echo '<button class="btn btn-outline-light btn-lg mb-4" type="submit">Alterar dados</button>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function () {
    $('#login-form').submit(function (e) {
      e.preventDefault(); // Evita a submissão normal do formulário

      // Obtém os dados do formulário
      var formData = $(this).serialize();
      function showToast(options) {
        Toastify({
          text: options.text,
          duration: options.duration || 1500,
          close: options.close === undefined ? true : options.close,
          position: options.position || 'top-right', // Combinação correta para a posição
          className: options.className || ''
        }).showToast();
      }
      // Envia a requisição AJAX
      $.ajax({
        type: 'POST',
        url: 'datachanges.php', // Arquivo PHP onde o formulário será submetido
        data: formData,
        success: function (response) {
          // Processa a resposta do servidor
          if (response.trim() === 'success') {
            showToast({
              text: 'Dados atualizados com sucesso!',
              duration: 1500,
              position: 'top-right', // Certifique-se de que está definido corretamente
              close: true // Mostrar o botão de fechar
            });
            setTimeout(function () {
              window.location.href = 'login.php';
            }, 1500)
          } else if (response.trim() === 'error') {
            // Mostra mensagem de erro ou executa ação para login falhou
            showToast({
              text: 'Não deu para atualizar os dados!',
              duration: 1500,
              position: 'top-right', // Certifique-se de que está definido corretamente
              close: true // Mostrar o botão de fechar
            });
          } else if (response.trim() === 'missing') {
            showToast({
              text: 'Todos os campos são de preenchimento obrigatório!',
              duration: 1500,
              position: 'top-right', // Certifique-se de que está definido corretamente
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