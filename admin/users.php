<?php
include 'config/db.php';

$count_users_for_page = 10;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$sql = "SELECT * from users";
$result = mysqli_query($conn_db, $sql);
$count_users = mysqli_num_rows($result);
$total_pages = intval(($count_users - 1) / $count_users_for_page) + 1;

$limit = intval(($count_users - 1)/ $count_users_for_page) + 1;
$offset = ($page - 1) * $count_users_for_page;

$sql = "SELECT * FROM users LIMIT " . $count_users_for_page . " OFFSET " . $offset;

$result = mysqli_query($conn_db, $sql);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Users</title>
        <link rel="stylesheet" href="media/style.css">
    </head>
    <body>
    <?php include "header.php"?>

    <div class="content">
        <a href="modules/add_user.php" class="btn_add_user">Add user</a>
        <table id="customers">
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Phone</th>
                <th>To do</th>
            </tr>
            <?php
            while ($user = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $user['id']?></td>
                    <td><?php echo $user['login']?></td>
                    <td><?php echo $user['phone']?></td>
                    <td>
                        <button><a href="modules/edit_user.php?id=<?php echo $user['id'] ?>" class="btn_edit_user">Edit</a></button>
                        <button><a href="modules/del_user.php?id=<?php echo $user['id'] ?>" class="btn_edit_user">Delete</a></button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div>
            <ul>
                <?php
                $i = 1;
                while ( $i <= $total_pages) {
                    ?>
                <li><a href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php
                    $i++;
                }
                ?>
            </ul>
        </div>
    </div>
    </body>
</html>