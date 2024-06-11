<?php 
session_start();

	include("connection.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

    $nome= mysqli_real_escape_string($con, $_POST['nome']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $apelido = $nome . ' ' . mysqli_real_escape_string($con, $_POST['apelido']);
	  $password = mysqli_real_escape_string($con, $_POST['password']);
    $passwordC = mysqli_real_escape_string($con, $_POST['passwordC']);

    if($nome ==="" || $email === "" || $apelido === "" || $password === " "  || $passwordC === "" )
    {

      echo "<script>Toastify({
        text: 'Erro de introdução nos dados!!',
        duration: 3000,
        close: true,
        gravity: 'top',
        backgroundColor: 'linear-gradient(to right, #ff0000, #ff0000)'
    }).showToast();</script>";

    }else{

        if($password === $passwordC){


          $query = "INSERT INTO user (nome,email,password,tipo) VALUES ('$nome','$email','$password',1)";
    
          if(mysqli_query($con,$query)){
      
      
            header("Location: login.php");
      
          }else{
      
            echo "burro";
          }

        }else{

          echo "<script>Toastify({
            text: 'Passwords diferentes!!',
            duration: 3000,
            close: true,
            gravity: 'top',
            backgroundColor: 'linear-gradient(to right, #ff0000, #ff0000)'
        }).showToast();</script>";

        }

    }
  }
    

session_write_close();





?>