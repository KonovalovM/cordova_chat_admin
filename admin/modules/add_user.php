<?php
include '../config/db.php';

if (isset($_FILES['avatar']) && isset($_POST['login']) && isset($_POST['password']) &&isset($_POST['phone'])) {
    $uploaddir = '../media/uploads/';
    $filename = rand(1000000, 9999999999999) . basename($_FILES['avatar']['name']);
    $uploadfile = $uploaddir . $filename;
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)) {

    } else {
        echo "ERROR";
    }
    $sql = "INSERT INTO users (login, avatar, phone, password) VALUES ('" . $_POST['login'] . "', '" . $filename . "', '" . $_POST['phone'] . "', ' " . $_POST['password'] . " ');";
    if( mysqli_query($conn_db, $sql)) {
        header("Location: ../users.php");
    } else {
        echo "ERROR";
    };
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add user</title>
        <link rel="stylesheet" href="../media/style.css">
    </head>
    <body>
    <div class="login-page">
        <div class="form">
            <form class="login-form" method="post" enctype="multipart/form-data">
                <input type="text" name="login" placeholder="username"/>
                <input type="text" name="phone" placeholder="phoner"/>
                <input type="password" name="password" placeholder="password"/>
                <input type="file" name="avatar"/>
                <button>ADD</button>
            </form>
        </div>
    </div>
    </body>
</html>