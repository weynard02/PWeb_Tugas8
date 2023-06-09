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
    if ($row['nama'] == "reguler"){
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
    <div class="form-container">
        
        <form action="proses-reply.php" method="post">
            <h3>Add Reply</h3>
            <?php
                include('config.php');
                $message_id = $_GET['message_id'];
                $message = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM messages WHERE id = '$message_id'"));
                $penerima_id = $message['pengirim_user_id'];
                $penerima = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$penerima_id'"));

                echo '<input type="hidden" name="penerima_user_id" value="'. $penerima_id . '">
                <input type="hidden" name="message_ref_id" value="' . $message_id . '">';

                echo '<label for="description" class="form-label">Pesan yang direply: </label>';
                echo '<input class="form-control" type="text" value='.$message['description'].' readonly>' ;

                echo '<label for="penerima" class="form-label">Penerima: </label>';
                echo '<input class="form-control" type="text" value='.$penerima['nama'].' readonly>' ;

                $res = mysqli_query($conn, "SELECT * FROM types");

                echo '<label for="type_id" class="form-label">Tipe Pesan </label>';
                echo '<select name="type_id" class="form-select">';
                while ($row = $res->fetch_assoc()){
                    echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                }
                echo '</select>';
            ?>

            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" name="subject" id="subject" >
               
            <label for="description" class="form-label">Body</label>
            <textarea class="form-control" name="description" id="description" style="height: 100px"></textarea>
            <br>
            <a class="btn btn-secondary" href="index.php" role="button">Back</a>    
            <button type="submit" class="btn btn-success" name="reply">Send</button>

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