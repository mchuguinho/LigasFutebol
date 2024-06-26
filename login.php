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
  <script src="js/login.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body>

  <!-- Template modificado-->

  <div class="mask d-flex align-items-center h-100 maskBlack">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <form class="col-12 col-md-8 col-lg-6 col-xl-5" id="login-form" action="entrar.php" method="POST">
          <div class="card bg-dark text-white redonda">

            <!-- Até aqui, levou algumas alterações, para baixo não é template -->
            <div class="card-title d-flex justify-content-center mt-2">
              <a class="btn btn-outline-light col-md-6 mt-md-2" href="index.php" role="button">Voltar</a>
            </div>
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4">
                <h2 class="fw-bold">LOGIN</h2>
                <p class="text-white-50 mb-5">Por favor introduza o seu email e palavra-passe</p>
                <div class="form-outline form-white mb-4 form-floating">
                  <input type="email" class="form-control form-control-lg" id="email" name="email">
                  <label for="floatingInput">Email</label>
                </div>
                <div class="form-outline form-white mb-4 form-floating">
                  <input type="password" class="form-control form-control-lg" id="password" name="password">
                  <label for="floatingPassword">Password</label>
                </div>
                <button class="btn btn-outline-light btn-lg mb-4" type="submit">Login</button>
                <p> Não tens conta? <a href="registo.php" class="text-white-50 fw-bold">Efetua o registo!</a></p>
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
          url: 'entrar.php', // Arquivo PHP onde o formulário será submetido
          data: formData,
          success: function (response) {
            // Processa a resposta do servidor
            if (response.trim() === 'success') {
              showToast({
                text: 'Login efetuado com sucesso!',
                className: 'acertou',
                duration: 1500,
                position: 'top-right', // Certifique-se de que está definido corretamente
                close: true // Mostrar o botão de fechar
              });
              setTimeout(function () {
                window.location.href = 'index.php';
              }, 1500)
            } else {
              // Mostra mensagem de erro ou executa ação para login falhou
              showToast({
                text: 'Dados incorretos ou conta inexistente!',
                duration: 1500,
                className: 'errou',
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