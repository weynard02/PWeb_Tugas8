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
</head>

<body>
    <h1>Add Message</h1>
    <form action="proses-message.php" method="post">
        <ul>
            <?php
                include('config.php');
                $pej = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM roles WHERE nama LIKE 'pejabat'"));
                $pejabat_id = $pej['id'];
                $res = mysqli_query($conn, "SELECT * FROM users WHERE id = '$pejabat_id'");
                echo '<li>';
                echo '<label for="penerima_user_id">Penerima </label>';
                echo '<select name="penerima_user_id">';
                while ($row = $res->fetch_assoc()){
                    echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                }
                echo '</select>';
                echo '</li>';

                $res = mysqli_query($conn, "SELECT * FROM types");
                echo '<li>';
                echo '<label for="type_id">Tipe Pesan </label>';
                echo '<select name="type_id">';
                while ($row = $res->fetch_assoc()){
                    echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                }
                echo '</select>';
                echo '</li>';
            ?>

            <li>
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject">
            </li>
            <li>
                <label for="description">Description</label>
                <input type="text" name="description" id="description">
            </li>

            <button type="submit" class="btn btn-primary" name="message">Send</button>
        </ul>
    </form>
    <?php
        if (isset($_SESSION['failed'])) {
            echo "<div class='alert alert-danger' role='alert'>".$_SESSION['failed']."</div>";
            unset($_SESSION['failed']);
        }
    ?>
    <a class="btn btn-info" href="index.php" role="button">Back</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>