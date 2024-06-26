<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ligas de futebol</title>
  <link rel="icon" type="image/x-icon" href="img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="js/registo.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body>
  <!-- Template modificado-->
  <div class="mask d-flex align-items-center h-100 maskBlack">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <form class="col-12 col-md-8 col-lg-6 col-xl-5" id="registo-form" action="register.php" method="POST">
          <div class="card bg-dark text-white redonda">
            <!-- Até aqui, levou algumas alterações, para baixo não é template -->
            <div class="card-title d-flex justify-content-center mt-2">
              <a class="btn btn-outline-light col-md-6 mt-md-2 " href="login.php" role="button">Voltar</a>
            </div>
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4">
                <h2 class="fw-bold mb-5">Registo de Conta</h2>
                <div class="form-row">
                  <div class="row mb-5">
                    <div class="form-group col-6">
                      <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required>
                    </div>
                    <div class="form-group col-6">
                      <input type="text" class="form-control" id="apelido" placeholder="Apelido" name="apelido"
                        required>
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                  </div>
                  <div class="form-group mb-3">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password"
                      required>
                  </div>
                  <div class="form-group mb-4">
                    <input type="password" class="form-control" id="passwordC" placeholder="Confirmar Password"
                      name="passwordC" required>
                  </div>
                </div>
                <button class="btn btn-outline-light btn-lg mb-4" type="submit">Criar Conta</button>
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
      $('#registo-form').submit(function (e) {
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
          url: 'register.php', // Arquivo PHP onde o formulário será submetido
          data: formData,
          success: function (response) {
            // Processa a resposta do servidor
            if (response.trim() === 'success') {
              showToast({
                text: 'Conta criada com sucesso!',
                className: 'acertou',
                duration: 1500,
                position: 'top-right', // Certifique-se de que está definido corretamente
                close: true // Mostrar o botão de fechar
              });
              setTimeout(function () {
                window.location.href = 'login.php';
              }, 1500);
            } else if (response.trim() === 'error') {
              showToast({
                text: 'Erro ao criar conta!',
                className: 'errou',
                duration: 1500,
                position: 'top-right', // Certifique-se de que está definido corretamente
                close: true // Mostrar o botão de fechar
              });
            } else {
              showToast({
                text: 'Erro desconhecido. Tente novamente mais tarde.',
                className: 'errou',
                duration: 1500,
                position: 'top-right', // Certifique-se de que está definido corretamente
                close: true // Mostrar o botão de fechar
              });
            }
          },
          error: function () {
            showToast({
              text: 'Erro na comunicação com o servidor. Tente novamente mais tarde.',
              className: 'errou',
              duration: 1500,
              position: 'top-right', // Certifique-se de que está definido corretamente
              close: true // Mostrar o botão de fechar
            });
          }
        });
      });
    });
  </script>


</body>
</body>

</html>