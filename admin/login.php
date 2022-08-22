<?php
include 'config/db.php';

if(isset($_COOKIE['admin_id'])){
    header("location: /admin");
}

if (isset($_POST['login']) && isset($_POST['password'])) {
    $sql = "SELECT * from admins WHERE login LIKE '" . $_POST['login'] . "' AND password LIKE '" . $_POST['password'] . "'";

    $result = mysqli_query($conn_db, $sql);

    if($result !=false) {
        $user = mysqli_fetch_assoc($result);
        setcookie("admin_id", $user['id'], time()+60*60*24);

        header("location: /admin");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
    <link rel="stylesheet" href="media/style.css">
    <title>Hello World</title>
</head>
<body>
<div class="login-page">
    <div class="form">
        <form class="login-form" method="post">
            <input type="text" name="login" placeholder="username"/>
            <input type="password" name="password" placeholder="password"/>
            <button>login</button>
        </form>
    </div>
</div>

</body>
</html>