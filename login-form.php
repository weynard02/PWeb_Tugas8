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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
</head>

<body>
    <div class="container index position-absolute top-50 start-50 translate-middle">
        <h1 class="welcome" align="center">Selamat Datang!</h1>
        <form action="proses-login.php" method="post">
            <div class="row mb-3 justify-content-center align-items-center">
                <div class="col-sm-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
            </div>
            <div class="row mb-3 justify-content-center align-items-center">
                <div class="col-sm-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control col-sm-2" name="password" id="password">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                    <a class="btn btn-danger" href="register-form.php" role="button">Register</a>
                </div>
                
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-sm-4">
                <?php
                    if (isset($_SESSION['failed'])) {
                        echo "<div class='alert alert-danger' role='alert'>".$_SESSION['failed']."</div>";
                        unset($_SESSION['failed']);
                    }
                ?>
                </div>
            </div>
        </form>        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>