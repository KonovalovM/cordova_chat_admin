<?php
if((!empty( $_SERVER['HTTP_X_FORWARDED_HOST'])) || (!empty( $_SERVER['HTTP_X_FORWARDED_FOR'])) ) {
    $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
    $_SERVER['HTTPS'] = 'on';
}
header('Access-Control-Allow-Origin: *');
$host = 'localhost';
$database = "chat_api";
$user = "root";
$password = "";

$conn_db = mysqli_connect($host, $user, $password, $database) or die("error" . mysqli_error($conn_db));