<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$nome = $_POST['nome'];
    $email = $_POST['email'];
    $apelido = $_POST['apelido'];
		$password = $_POST['password'];
    $passwordC = $_POST['passwordC'];
/*
    if(!empty($password) && !is_numeric($passwordC) && !empty($email) && !empty($apelido)){
    if ( $password != $passwordC && !empty($nome)){

      echo "<script>Toastify({
        text: 'Passwords diferentes!!',
        duration: 3000,
        close: true,
        gravity: 'top',
        backgroundColor: 'linear-gradient(to right, #ff0000, #ff0000)'
    }).showToast();</script>";
    }else{

      $query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
          echo "<script>Toastify({
            text: 'Já existe um utilizador com esse email! Tente dar login!',
            duration: 3000,
            close: true,
            gravity: 'top',
            backgroundColor: 'linear-gradient(to right, #ff0000, #ff0000)'
        }).showToast();</script>";


        }
      }else
      {

        //save to database
        $query = "insert into users (nome,email,password) values ('$nome + $apelido','$password')";

        mysqli_query($con, $query);

        header("Location: ./login.php");
        die;
      }
	  }
  }
}*/

//session_write_close();




		if(!empty($password) && !is_numeric($passwordC) && !empty($email) && !empty($apelido))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (nome,email,password) values ('$nome + $apelido','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
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
</head>

<body>
  <!-- Template modificado-->

  <div class="mask d-flex align-items-center h-100 maskBlack">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <form class="col-12 col-md-8 col-lg-6 col-xl-5" id="registo-form">
          <div class="card bg-dark text-white redonda">

            <!-- Até aqui, levou algumas alterações, para baixo não é template -->

            <div class="card-title d-flex justify-content-center mt-2">

              <a class="btn btn-outline-light col-md-6 mt-md-2 " href="./login.php" role="button">Voltar</a>

            </div>

            <div class="card-body p-5 text-center">

              <div class="mb-5">

                <h2 class="fw-bold mb-5">Registo de Conta</h2>

                <div class="form-row">
                  <div class="row mb-5">

                    <div class="form-group col-6">

                      <input type="nome" class="form-control" id="nome" placeholder="Nome" required>

                    </div>

                    <div class="form-group col-6">

                      <input type="apelido" class="form-control" id="apelido" placeholder="Apelido" required>

                    </div>
                  </div>




                  <div class="form-group mb-3">

                    <input type="email" class="form-control" id="email" placeholder="Email" required>

                  </div>

                  <div class="form-group mb-3">

                    <input type="password" class="form-control" id="password" placeholder="Password" required>

                  </div>

                  <div class="form-group mb-4">

                    <input type="password" class="form-control" id="passwordC" placeholder="Confirmar Password"
                      required>

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
</body>

</html>