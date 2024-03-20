<?php
require_once '../../../db_connection.php';

$comment_id = $_GET['id'];

$query = "DELETE FROM comments WHERE id = $1";
$result = pg_query_params($db_connection, $query, array($comment_id));

if ($result) {
    header("Location: index.php");
    exit();
} else {
    echo "Ошибка при удалении комментария.";
}

pg_close($db_connection);
?>
