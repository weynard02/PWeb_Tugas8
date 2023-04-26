<?php

session_start();
include('config.php');

if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($res) === 1){
        $row = mysqli_fetch_assoc($res);
        if ($password == $row['password']){
            $_SESSION['login'] = true;
            header('Location: index.php');
            exit;
        }
    }
    
    header('Location: login-form.php');
}

?>