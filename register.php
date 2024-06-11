<?php 
session_start();

	include("connection.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

    $nome= mysqli_real_escape_string($con, $_POST['nome']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
//    $apelido = $nome + mysqli_real_escape_string($con, $_POST['apelido']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
    $passwordC = mysqli_real_escape_string($con, $_POST['passwordC']);

    $query = "INSERT INTO user (nome,email,password,tipo) VALUES ('$nome','$email','$password',1)";
    
    if(mysqli_query($con,$query)){

      echo "deu";

      header("Location: index.html");

    }else{

      echo "burro";
    }

  }
    


  /*

        if($nome ==="" || $email === "" || $apelido === "" || $password === " "  || $passwordC === "" )
        {
    
            if($password === $passwordC){

              $query = "insert into user (nome,email,password,tipo) values ('$apelido ','$email','$password',1)";
    
              mysqli_query($con, $query);
        
              header("Location: login.php");

            }else{

              echo "<script>Toastify({
                text: 'Passwords diferentes!!',
                duration: 3000,
                close: true,
                gravity: 'top',
                backgroundColor: 'linear-gradient(to right, #ff0000, #ff0000)'
            }).showToast();</script>";

            }

        }else
        {

          echo "<script>Toastify({
            text: 'Dados Inválidos!!',
            duration: 3000,
            close: true,
            gravity: 'top',
            backgroundColor: 'linear-gradient(to right, #ff0000, #ff0000)'
        }).showToast();</script>";

        }
      }

  */


session_write_close();





?>