<?php
if(!isset($_COOKIE['admin_id'])){
    header("location: /admin/login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin panel</title>
        <link rel="stylesheet" href="media/style.css">
    </head>
    <body>
    <?php include "header.php"?>
    </body>
</html>