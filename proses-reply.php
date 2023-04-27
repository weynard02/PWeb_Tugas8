<?php

session_start();
include('config.php');

if (isset($_POST['reply'])){
    $pengirim_user_id = $_SESSION['user_id'];
    $penerima_user_id = $_POST['penerima_user_id'];
    $type_id = $_POST['type_id'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $message_ref_id = $_POST['message_ref_id'];

    if ($penerima_user_id == '' || $type_id == '' || $subject == '' || $description == '' || $message_ref_id == ''){
        $_SESSION['failed'] = "Data tidak lengkap!";
        header('Location: reply-form.php?message_id=' . $message_ref_id);
        exit;
    }
    
    mysqli_query($conn, "INSERT INTO messages VALUES ('', '$pengirim_user_id', '$penerima_user_id', '$type_id', '$subject', '$description', '$message_ref_id')");
    $_SESSION['sukses'] = "Pesan berhasil disampaikan";
    header('Location: index.php');
}

?>