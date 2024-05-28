<?php 
    session_start();
    include ('connection.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id_user'];


            header("Location: index.html");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    }
    mysqli_close($con);
?>