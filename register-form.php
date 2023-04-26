<?php
    session_start();
    if (isset($_SESSION['user_id'])){
        header('Location: index.php');
        exit;
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <h1>Register</h1>
    <form action="proses-register.php" method="post">
        <ul>
            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat">
            </li>
            <li>
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir">
            </li>
            <li>
                <label for="no_telp">no_telp</label>
                <input type="text" name="no_telp" id="no_telp">
            </li>
            <li>
                <label for="jenis_kelamin">Jenis Kelamin</label></label>
                <select name="jenis_kelamin">
                    <option value="L">L</option>
                    <option value="P">P</option>
                </select>
            </li>
            <li>
                <label for="agama">Password</label>
                <select name="agama">
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katolik</option>
                    <option>Hindu</option>
                    <option>Buddha</option>
                    <option>Atheis</option>
                </select>
            </li>
            <li>
                <label for="role_id">Role</label>
                <select name="role_id">
                    <option value="2">Pejabat</option>
                    <option value="3">Reguler</option>
                </select>
            </li>
            
            <button type="submit" class="btn btn-primary" name="register">Register</button>
        </ul>
    </form>
    <a class="btn btn-info" href="login-form.php" role="button">Back</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>