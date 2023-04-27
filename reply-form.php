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
</head>

<body>
    <h1>Add Reply</h1>

    <form action="proses-reply.php" method="post">
        <ul>
            <?php
                include('config.php');
                $message_id = $_GET['message_id'];
                $message = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM messages WHERE id = '$message_id'"));
                $penerima_id = $message['pengirim_user_id'];
                $penerima = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$penerima_id'"));

                echo '<input type="hidden" name="penerima_user_id" value="'. $penerima_id . '">
                <input type="hidden" name="message_ref_id" value="' . $message_id . '">';

                echo '<li>Pesan yang direply: ' . $message['description'] . '</li>';
                echo '<li>Penerima: ' . $penerima['nama'] . '</li>';

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

            <button type="submit" class="btn btn-primary" name="reply">Send</button>
        </ul>
    </form>
    <a class="btn btn-info" href="index.php" role="button">Back</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>