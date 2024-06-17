<?php 
    session_start();
    include ('connection.php');
    $user_id = $_SESSION['user_id'];

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $nome = mysqli_real_escape_string($con, $_POST['nome']);

        $query = "UPDATE user SET email = '$email', password = '$password', nome = '$nome' WHERE id_user = '$user_id'";

        $result = mysqli_query($con, $query);
        
        if(mysqli_query($con, $query)) {

            session_destroy();
            
            header("Location: login.php");
            exit();
        } else {
            header("Location: dados.php");
        }
    }
    mysqli_close($con);
?>