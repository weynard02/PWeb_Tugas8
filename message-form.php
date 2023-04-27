<?php
    session_start();
    if (!isset($_SESSION['user_id'])){
        header('Location: login-form.php');
        exit;
    }

    include('config.php');

    $uid = $_SESSION['user_id'];
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$uid'"));
    $rid = $row['role_id'];
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM roles WHERE id = '$rid'"));
    if ($row['nama'] == "pejabat"){
        header('Location: index.php');
        exit;
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messsage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
</head>

<body>
    <div class="container index position-absolute top-50 start-50 translate-middle">
        <h1 align="center">Add Message</h1>
        <form action="proses-message.php" method="post">
            <?php
                include('config.php');
                $pej = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM roles WHERE nama LIKE 'pejabat'"));
                $pejabat_id = $pej['id'];
                $res = mysqli_query($conn, "SELECT * FROM users WHERE role_id = '$pejabat_id'");
                echo '<div class="row mb-3 justify-content-center align-items-center">
                <div class="col-sm-4">';
                echo '<label for="penerima_user_id" class="form-label">Penerima </label>';
                echo '<select name="penerima_user_id" class="form-select">';
                while ($row = $res->fetch_assoc()){
                    echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                }
                echo '</select>';
                echo '</div>
                </div>';

                $res = mysqli_query($conn, "SELECT * FROM types");
                echo '<div class="row mb-3 justify-content-center align-items-center">
                <div class="col-sm-4">';
                echo '<label for="type_id" class="form-label">Tipe Pesan </label>';
                echo '<select name="type_id" class="form-select">';
                while ($row = $res->fetch_assoc()){
                    echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                }
                echo '</select>';
                echo '</div>
                </div>';
            ?>

            <div class="row mb-3 justify-content-center align-items-center">
                <div class="col-sm-4">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject">
                </div>
            </div>
            <div class="row mb-3 justify-content-center align-items-center">
                <div class="col-sm-4">
                    <label for="description" class="form-label">Body</label>
                    <textarea class="form-control" name="description" id="description" style="height: 100px"></textarea>
                </div>
            </div>
            <div class="row mb-3 justify-content-center align-items-center">
                <div class="col-sm-4">
                    <a class="btn btn-info" href="index.php" role="button">Back</a>
                    <button type="submit" class="btn btn-success" name="message">Send</button>
                </div>
            </div>
            <div class="row mb-3 justify-content-center align-items-center">
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
