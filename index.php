<?php
    session_start();
    if (!isset($_SESSION['user_id'])){
        header('Location: login-form.php');
        exit;
    }

    include('config.php');
        $uid = $_SESSION['user_id'];
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$uid'"));
        $rid = $user['role_id'];
        $role = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM roles WHERE id = '$rid'"));
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Silaturahmi Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
</head>

<body>
    <div class="container">
        <h1 align="center" class="mt-5">Halo <?php echo $user['nama'];?></h1>

        <?php
            if (isset($_SESSION['sukses'])) {
                echo "<div class='alert alert-success' role='alert'>".$_SESSION['sukses']."</div>";
                unset($_SESSION['sukses']);
            }
        ?>
        <a class="btn btn-danger mb-3" href="proses-logout.php" role="button">Log out</a>

        <?php
            
            if ($role['nama'] == "reguler"){
                echo '<a class="btn btn-primary mb-3" href="message-form.php" role="button">+ Add Message</a>';
            }

            if ($role['nama'] == "admin") {
                $msg = mysqli_query($conn, "SELECT * FROM messages WHERE message_ref_id IS NULL");
            }
            else {
                $msg = mysqli_query($conn, "SELECT * FROM messages WHERE pengirim_user_id = '$uid' OR penerima_user_id = '$uid' AND message_ref_id IS NULL");
            }
            if (mysqli_num_rows($msg) > 0){
                echo '<h2>History</h2>';
                echo '<table class="table table-light">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">pengirim</th>
                        <th scope="col">penerima</th>
                        <th scope="col">type</th>
                        <th scope="col">subject</th>
                        <th scope="col">description</th>
                        <th scope="col"></th>
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
                    

                    if (($role['nama'] != "reguler" && $pengirim_id != $_SESSION['user_id']) || $role['nama'] == "admin"){
                        echo '<td><a class="btn btn-info" href="reply-form.php?message_id=' . $row['id'] . '" role="button">Reply Message</a></td>';
                    }
                    
                    else {
                        echo '<td></td>';
                    }
                    

                    echo '</tr>';
                    $theid = $row['id'];
                    $reply = mysqli_query($conn, "SELECT * from messages WHERE message_ref_id = ".$row['id']);

                    if (!isset($reply)) continue;
                    while ($row2 = $reply->fetch_assoc()) {
                        $pengirim_id = $row2['pengirim_user_id'];
                        $penerima_id = $row2['penerima_user_id'];
                        $type_id = $row2['type_id'];

                        $pengirim = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$pengirim_id'"));
                        $penerima = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$penerima_id'"));
                        $type = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM types WHERE id = '$type_id'"));

                        echo '<tr>
                        <th scope="row"> > '.$row2['id'].' </th>
                        <td>' . $pengirim['nama'] . '</td>
                        <td>' . $penerima['nama'] . '</td>
                        <td>' . $type['nama'] . '</td>
                        <td>' . $row2['subject'] . '</td>
                        <td>' . $row2['description'] . '</td>
                        <td></td>';   
                        echo '</tr>';
                    }
                }
                echo '</tbody>
                    </table>';
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>
