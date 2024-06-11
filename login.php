<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ligas de futebol</title>
  <link rel="icon" type="image/x-icon" href="img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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
                  <input type="email" class="form-control form-control-lg" id="email" name="user_email">
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
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>