<?php
require_once '../../../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note_content = $_POST['note_content'];

    $query = "INSERT INTO notes (content) VALUES ($1)";
    $result = pg_query_params($db_connection, $query, array($note_content));

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Ошибка при добавлении заметки.";
    }
}

pg_close($db_connection);
?>
