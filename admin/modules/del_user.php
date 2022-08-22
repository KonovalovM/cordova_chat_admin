<?php
include '../config/db.php';

if(isset($_GET['id'])) {
    $sql = "DELETE FROM users WHERE id=" . $_GET['id'];
    $result = mysqli_query($conn_db, $sql);
    mysqli_query($conn_db, $sql);
    header("Location: ../users.php");
}