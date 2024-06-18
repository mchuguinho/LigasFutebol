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

          $verifica = "SELECT * FROM user WHERE email = '$email'";
          $result = mysqli_query($con,$verifica);
          $jaexiste = false;

          if(mysqli_num_rows($result) > 0){
            $jaexiste = true;
            header("Location: registo.php");
            exit();
          }

          $query = "INSERT INTO user (nome,email,password,tipo) VALUES ('$nome','$email','$password',1)";
          $criada = false;

          if(mysqli_query($con,$query)){
      
            $criada = true;
            echo 'success';
          }else{
      
            echo "error";
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