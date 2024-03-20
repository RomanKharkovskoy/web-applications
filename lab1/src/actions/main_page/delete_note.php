<?php
require_once '../../../db_connection.php';

$note_id = $_GET['id'];

$comment_query = "SELECT COUNT(*) FROM comments WHERE note_id = $1";
$comment_result = pg_query_params($db_connection, $comment_query, array($note_id));
$comment_count = pg_fetch_result($comment_result, 0);

if ($comment_count > 0) {
    $delete_comment_query = "DELETE FROM comments WHERE note_id = $1";
    $delete_comment_result = pg_query_params($db_connection, $delete_comment_query, array($note_id));

    if (!$delete_comment_result) {
        echo "Ошибка при удалении комментариев.";
        exit();
    }
}

$query = "DELETE FROM notes WHERE id = $1";
$result = pg_query_params($db_connection, $query, array($note_id));

if ($result) {
    header("Location: index.php");
    exit();
} else {
    echo "Ошибка при удалении заметки.";
}

pg_close($db_connection);
?>
