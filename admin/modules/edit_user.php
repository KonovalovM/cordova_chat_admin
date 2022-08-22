<?php
include '../config/db.php';

if(isset($_GET['id'])) {
    $sql = "SELECT * FROM users WHERE id=" . $_GET['id'];
    $result = mysqli_query($conn_db, $sql);
    $count = mysqli_num_rows($result);
    if($count == 1) {
        $user = mysqli_fetch_assoc($result);
    } else {
        header("Location: ../users.php");
    }
}else{
    header("Location: ../users.php");
}
if (isset($_POST['login']) &&isset($_POST['phone'])) {
    $sql = "UPDATE users SET login='" . $_POST['login'] . "', phone ='" . $_POST['phone'] . "' WHERE id='" . $_GET['id'] . "'";
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
        <title>Edit user</title>
        <link rel="stylesheet" href="../media/style.css">
    </head>
    <body>
    <div class="login-page">
        <div class="form">
            <form class="login-form" method="post" enctype="multipart/form-data">
                <input value="<?php echo $user['login'] ?>" type="text" name="login" placeholder="username"/>
                <input value="<?php echo $user['phone'] ?>" type="text" name="phone" placeholder="phone"/>
                <button>EDIT</button>
            </form>
        </div>
    </div>
    </body>
</html>