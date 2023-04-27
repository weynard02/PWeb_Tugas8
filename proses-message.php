<?php

session_start();
include('config.php');

if (isset($_POST['message'])){
    $pengirim_user_id = $_SESSION['user_id'];
    $penerima_user_id = $_POST['penerima_user_id'];
    $type_id = $_POST['type_id'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];

    if ($subject == '' || $description == ''){
        header('Location: message-form.php');
        exit;
    }
    
    mysqli_query($conn, "INSERT INTO messages VALUES ('', '$pengirim_user_id', '$penerima_user_id', '$type_id', '$subject', '$description', NULL)");
    header('Location: index.php');
}

?>
