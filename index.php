<?php
    session_start();
    if (!isset($_SESSION['user_id'])){
        header('Location: login-form.php');
        exit;
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Silaturahmi Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <h1>Hello, ini landing page</h1>
    <a class="btn btn-danger" href="proses-logout.php" role="button">Log out</a>

    <?php
        include('config.php');
        $uid = $_SESSION['user_id'];
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$uid'"));
        $rid = $user['role_id'];
        $role = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM roles WHERE id = '$rid'"));
        if ($role['nama'] != "pejabat"){
            echo '<a class="btn btn-primary" href="message-form.php" role="button">Add Message</a>';
        }

        $msg = mysqli_query($conn, "SELECT * FROM messages WHERE pengirim_user_id = '$uid' OR penerima_user_id = '$uid'");
        if (mysqli_num_rows($msg) > 0){
            echo '<table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">pengirim</th>
                    <th scope="col">penerima</th>
                    <th scope="col">type</th>
                    <th scope="col">subject</th>
                    <th scope="col">description</th>
                </tr>
                </thead>
                <tbody>';
            
            while ($row = $msg->fetch_assoc()){
                $pengirim_id = $row['pengirim_user_id'];
                $penerima_id = $row['penerima_user_id'];
                $type_id = $row['type_id'];

                $pengirim = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$pengirim_id'"));
                $penerima = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$penerima_id'"));
                $type = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM types WHERE id = '$type_id'"));

                echo '<tr>
                        <th scope="row">' . $row['id'] . '</th>
                        <td>' . $pengirim['nama'] . '</td>
                        <td>' . $penerima['nama'] . '</td>
                        <td>' . $type['nama'] . '</td>
                        <td>' . $row['subject'] . '</td>
                        <td>' . $row['description'] . '</td>';

                if ($role['nama'] != "reguler" && $pengirim_id != $_SESSION['user_id']){
                    echo '<td><a class="btn btn-info" href="reply-form.php?message_id=' . $row['id'] . '" role="button">Reply Message</a></td>';
                }
                

                echo '</tr>';
            }
            echo '</tbody>
                </table>';
        }
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
