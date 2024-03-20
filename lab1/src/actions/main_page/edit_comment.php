<?php
require_once '../../../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment_id = $_POST['comment_id'];
    $comment_content = $_POST['comment_content'];

    $query = "UPDATE comments SET content = $1 WHERE id = $2";
    $result = pg_query_params($db_connection, $query, array($comment_content, $comment_id));

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Ошибка при обновлении комментария.";
    }
}

$comment_id = $_GET['id'];

$query = "SELECT * FROM comments WHERE id = $1";
$result = pg_query_params($db_connection, $query, array($comment_id));
$comment = pg_fetch_assoc($result);

pg_close($db_connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать комментарий</title>
    <link rel="stylesheet" href="../../css/edit_style.css">
</head>
<body>
    <h1>Редактировать комментарий</h1>
    <form action="edit_comment.php" method="post">
        <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
        <textarea name="comment_content" rows="4" cols="50"><?php echo $comment['content']; ?></textarea><br>
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>
