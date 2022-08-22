<?php
include '../admin/config/db.php';

if(isset($_GET['page'])) {
    switch ($_GET['page']) {
        case "get":

        if(isset($_GET['user_id_1']) &&
            isset($_GET['user_id_2']) &&
            $_GET['user_id_1'] != "" &&
            $_GET['user_id_2'] != ""
        ) {
            $sql = "SELECT * FROM messages WHERE to_user_id=" . $_GET['user_id_1'] . " AND from_user_id=" . $_GET['user_id_2'] . " OR to_user_id=" . $_GET['user_id_2'] . " AND from_user_id=" . $_GET['user_id_1'];
            $result = mysqli_query($conn_db, $sql);
            $messages = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $sql = "SELECT avatar, login FROM users WHERE id=" . $row['from_user_id'];
                $resultGetUser = mysqli_query($conn_db, $sql);
                $user = mysqli_fetch_assoc($resultGetUser);
                $messages[] = [
                    'content' => $row['content'],
                    'avatar' => "../admin/media/uploads/" . $user['avatar'],
                    'login' => $user['login']
                ];
            }
            echo json_encode(["messages" => $messages]);
        }
        break;

        case "send":
var_dump(1);
            if(isset($_POST['user_id_1']) &&
                isset($_POST['user_id_2']) &&
                $_POST['user_id_1'] != "" &&
                $_POST['user_id_2'] != ""
            ) {
                $sql = "INSERT INTO messages (content, to_user_id, from_ussr_id) VALUES ('" . $_POST['content'] . "', '" . $_POST['user_id_1'] . "' , '" . $_POST['user_id_2'] . "');";
                var_dump($sql);
                if( mysqli_query($conn_db, $sql)) {
                    $result = mysqli_query($conn_db, $sql);
                }
            }
            break;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>
    <link rel="stylesheet" href="../admin/media/style.css">
</head>
<body>
<div class="login-page">
    <div class="form">
        <form class="login-form" method="post">
    <textarea name="content" id="" cols="30" rows="10"></textarea>
    <input type="text" name="user_id_1">
    <input type="text" name="user_id_2">
    <button>SEND</button>
        </form>
    </div>
</div>
</form>
</body>
</html>
