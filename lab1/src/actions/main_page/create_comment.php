<?php
require_once '../../../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note_id = $_POST['note_id'];
    $comment_content = $_POST['comment_content'];

    $query = "INSERT INTO comments (note_id, content) VALUES ($1, $2)";
    $result = pg_query_params($db_connection, $query, array($note_id, $comment_content));

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Ошибка при добавлении комментария.";
    }
}

pg_close($db_connection);
?>
