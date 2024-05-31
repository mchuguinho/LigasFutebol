<?php 
    session_start();
    include ('connection.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";

        $result = mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id_user'];

            header("Location: index.html");
            exit();
        } else {
            header("location.html");

        }
    }
    mysqli_close($con);
?>