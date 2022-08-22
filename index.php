<?php
header('Access-Control-Allow-Origin: *');

$host = 'localhost';
$database = "chat_api";
$user = "root";
$password = "";

$conn_db = mysqli_connect($host, $user, $password, $database) or die("error" . mysqli_error($conn_db));

if (isset($_GET["page"]) && $_GET["page"] == "users") {
    $sql = "SELECT * from users";

    $result = mysqli_query($conn_db, $sql);

    $users = [];
    while ($user = mysqli_fetch_assoc($result)) {
        $users[] = [
            "id" => $user["id"],
            "login" => $user["login"],
            "avatar" => "http://chatapi.local/admin/media/uploads/" . $user["avatar"]
        ];
    }
    echo json_encode(["users" => $users]);
} else if (isset($_GET["page"]) && $_GET["page"] == "messages") {
    $sql = "SELECT * from messages";

    $result = mysqli_query($conn_db, $sql);

    $messages = [];

    while ($user = mysqli_fetch_assoc($result)) {
        $messages[] = [
            "id" => $user["id"],
            "content" => $user["content"],
            "from_user_id" => $user["to_user_id"],
            "to_user_id" => $user["from_user_id"],
            "created" => $user["created"]
        ];
    }
    echo json_encode(["users" => $messages]);
}  else if (isset($_GET["page"]) && $_GET["page"] == "messages1&from_user_id=1&to_user_id=2") {
    $sql = "SELECT * from messages";

    $result = mysqli_query($conn_db, $sql);

    $messages = [];

    while ($messages = mysqli_fetch_assoc($result)) {
        $messages[] = [
            "id" => $user["id"],
            "content" => $user["content"],
            "from_user_id" => $user["from_user_id"],
            "to_user_id" => $user["to_user_id"],
            "created" => $user["created"]
        ];
    }
    echo json_encode(["users" => $messages]);
}else {
    echo "<h2>404 page not found </h2>";
}