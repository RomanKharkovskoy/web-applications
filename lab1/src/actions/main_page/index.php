<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="../../css/main_page_style.css">
</head>
<body>
    <div class='welcome'>
        <h1>Заметки</h1>
    </div>
    
    <form action="create_note.php" method="post">
        <textarea name="note_content" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Добавить заметку">
    </form>

    <div class="notes">
        <?php
        require_once '../../../db_connection.php';

        $query = "SELECT * FROM notes ORDER BY id DESC";
        $result = pg_query($db_connection, $query);

        while ($row = pg_fetch_assoc($result)) {
            echo "<div class='note'>";
            echo "<p>{$row['content']}</p>";
            echo "<a class='action-link' href='edit_note.php?id={$row['id']}'>Редактировать</a>";
            echo "<a class='action-link' href='delete_note.php?id={$row['id']}'>Удалить</a>";

            echo "<form action='create_comment.php' method='post'>";
            echo "<input type='hidden' name='note_id' value='{$row['id']}'>";
            echo "<textarea name='comment_content' rows='2' cols='30'></textarea><br>";
            echo "<input type='submit' value='Добавить комментарий'>";
            echo "</form>";

            $comment_query = "SELECT * FROM comments WHERE note_id = {$row['id']}";
            $comment_result = pg_query($db_connection, $comment_query);
            while ($comment_row = pg_fetch_assoc($comment_result)) {
                echo "<div class='comment'>";
                echo "<p>{$comment_row['content']}</p>";
                echo "<a class='action-link' href='edit_comment.php?id={$comment_row['id']}'>Редактировать</a>";
                echo "<a class='action-link' href='delete_comment.php?id={$comment_row['id']}'>Удалить</a>";
                echo "</div>";
            }

            echo "</div>";
        }

        pg_close($db_connection);
        ?>
    </div>
</body>
</html>
