<?php

session_start();
include('config.php');

if (isset($_POST['register'])){
    $email = $_POST['email'];
    if (strpos($email, '@') == true) {
        $res = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($res) === 1){
            $_SESSION['failed'] = "Email not available!";
            header('Location: register-form.php');
            exit;
        }
    } else {
        $_SESSION['failed'] = "Format email tidak tepat!";
        header('Location: register-form.php');
        exit;
    }

    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $no_telp = $_POST['no_telp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $role_id = $_POST['role_id'];

    if ($password == '' || $nama == '' || $alamat == '' || $tgl_lahir == '' || $no_telp == '' || $jenis_kelamin == '' || $agama == '' || $role_id == ''){
        $_SESSION['failed'] = "Data tidak lengkap!";
        header('Location: register-form.php');
        exit;
    }

    mysqli_query($conn, "INSERT INTO users VALUES ('', '$email', '$password', '$nama', '$alamat', '$tgl_lahir', '$no_telp', '$jenis_kelamin', '$agama', '$role_id')");
    $_SESSION['sukses'] = "Pengguna sudah terdaftar! Silakan login!";
    header('Location: login-form.php');
}

?>