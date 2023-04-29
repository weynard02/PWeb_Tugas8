<?php
    session_start();
    if (isset($_SESSION['user_id'])){
        header('Location: index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>

    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
</head>
<body>
   
<div class="form-container">
    <form action="proses-register.php" method="post">
        <img src="0.webp">
        <h3>register now</h3>

        <p>Email<sup>*</sup></p>
        <input type="text" class="form-control" name="email" id="email" required placeholder="enter your email">
        <p>Password<sup>*</sup></p>
        <input type="password" class="form-control" name="password" id="password" required placeholder="enter your password">   
        <p>Nama<sup>*</sup></p>
        <input type="text" class="form-control" name="nama" id="nama" required placeholder="enter your name">
        <p>Alamat<sup>*</sup></p>
        <input type="text" class="form-control" name="alamat" id="alamat" required placeholder="enter your address">
        <p>Tanggal Lahir<sup>*</sup></p>
        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required placeholder="enter your date of birth">
        <p>Nomor Telepon<sup>*</sup></p>
        <input type="text" class="form-control" name="no_telp" id="no_telp" required placeholder="enter your phone number">
        <p>Jenis Kelamin<sup>*</sup></p>
            <select name="jenis_kelamin" class="form-select">
                <option value="L">L</option>
                <option value="P">P</option>
            </select>
        <p>Agama<sup>*</sup></p>
            <select name="agama" class="form-select">
                <option>Islam</option>
                <option>Kristen</option>
                <option>Katolik</option>
                <option>Hindu</option>
                <option>Buddha</option>
                <option>Atheis</option>
            </select>
        <p>Role<sup>*</sup></p>
            <select name="role_id" class="form-select">
                <option value="2">Pejabat</option>
                <option value="3">Reguler</option>
            </select>

        <input type="submit" name="register" value="register" class="form-btn">
        <p>already have an account? <a href="login-form.php">login now</a></p>

        <?php
            if (isset($_SESSION['failed'])) {
                echo "<div class='alert alert-danger' role='alert'>".$_SESSION['failed']."</div>";
                unset($_SESSION['failed']);
            }
        ?>
    </form>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>