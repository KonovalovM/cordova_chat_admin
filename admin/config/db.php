<?php

$host = 'localhost';
$database = "chat_api";
$user = "root";
$password = "";

$conn_db = mysqli_connect($host, $user, $password, $database) or die("error" . mysqli_error($conn_db));