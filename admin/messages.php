<?php
include 'config/db.php';

$count_messages_for_page = 2;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$sql = "SELECT * from messages";
$result = mysqli_query($conn_db, $sql);
$count_messages = mysqli_num_rows($result);
$total_pages = intval(($count_messages - 1) / $count_messages_for_page) + 1;

$limit = intval(($count_messages - 1)/ $count_messages_for_page) + 1;
$offset = ($page - 1) * $count_messages_for_page;

$sql = "SELECT * FROM messages LIMIT " . $count_messages_for_page . " OFFSET " . $offset;

$result = mysqli_query($conn_db, $sql);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Messages</title>
        <link rel="stylesheet" href="media/style.css">
    </head>
    <body>
    <?php include "header.php"?>

    <div class="content">
        <table id="customers">
            <tr>
                <th>ID</th>
                <th>Content</th>
                <th>Created</th>
                <th>To do</th>
            </tr>
            <?php
            while ($messages = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $messages['id']?></td>
                    <td><?php echo $messages['content']?></td>
                    <td><?php echo $messages['created']?></td>
                    <td>
                        <button>Edit</button>
                        <button>Delete</button>
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