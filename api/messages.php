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
                $sql = "SELECT id, avatar, login FROM users WHERE id=" . $row['from_user_id'];
                $resultGetUser = mysqli_query($conn_db, $sql);
                $user = mysqli_fetch_assoc($resultGetUser);
                $messages[] = [
                    'content' => $row['content'],
                    'avatar' => "../admin/media/uploads/" . $user['avatar'],
                    'login' => $user['login'],
                    "from_user" => $_GET['user_id_1'] == $user['id'] ? "me" : "you"
                ];
            }
            echo json_encode(["messages" => $messages]);
        }
        break;

        case "send":
            if(isset($_POST)) {
                $sql = "INSERT INTO messages (content, to_user_id, from_user_id) VALUES ('" . $_POST['content'] . "', '" . $_POST['user_id_1'] . "' , '" . $_POST['user_id_2'] . "');";
                if (isset($_FILES)) {
                    $uploaddir = '../admin/media/uploads/';
                    $filename = rand(1000000, 99999991) . basename($_FILES['file']['name']);
                    $uploadfile = $uploaddir . $filename;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

                    } else {
                        echo "ERROR";
                    }
                    $sql = "INSERT INTO messages (content, to_user_id, from_user_id, file) VALUES ('" . $_POST['content'] . "', '" . $_POST['user_id_1'] . "' , '" . $_POST['user_id_2'] . "', '" . $uploadfile . "');";
var_dump($sql);
                    if (mysqli_query($conn_db, $sql)) {
                        header("Location: ../users.php");
                    } else {
                        echo "ERROR";
                    };
                }
            }
//            if(isset($_POST['user_id_1']) &&
//                isset($_POST['user_id_2']) &&
//                $_POST['user_id_1'] != "" &&
//                $_POST['user_id_2'] != ""
//            ) {
//                $sql = "INSERT INTO messages (content, to_user_id, from_ussr_id) VALUES ('" . $_POST['content'] . "', '" . $_POST['user_id_1'] . "' , '" . $_POST['user_id_2'] . "');";
//                var_dump($sql);
//                if( mysqli_query($conn_db, $sql)) {
//                    $result = mysqli_query($conn_db, $sql);
//                }
//            }
            break;
    }
}
