<?php
require_once '../../../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note_id = $_POST['note_id'];
    $note_content = $_POST['note_content'];

    $query = "UPDATE notes SET content = $1 WHERE id = $2";
    $result = pg_query_params($db_connection, $query, array($note_content, $note_id));

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Ошибка при обновлении заметки.";
    }
}

$note_id = $_GET['id'];

$query = "SELECT * FROM notes WHERE id = $1";
$result = pg_query_params($db_connection, $query, array($note_id));
$note = pg_fetch_assoc($result);

pg_close($db_connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать заметку</title>
    <link rel="stylesheet" href="../../css/edit_style.css">
</head>
<body>
    <h1>Редактировать заметку</h1>
    <form action="edit_note.php" method="post">
        <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
        <textarea name="note_content" rows="4" cols="50"><?php echo $note['content']; ?></textarea><br>
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>
