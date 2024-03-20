<?php
require_once '../../../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE login = $1";
    $result = pg_query_params($db_connection, $query, array($username));

    if ($result) {
        $row = pg_fetch_assoc($result);

        if ($row && password_verify($password, $row['hashed_password'])) {
            header("Location: ../main_page/index.php");
            exit();
        } else {
            echo "Неверное имя пользователя или пароль.";
        }
    } else {
        echo "Ошибка выполнения запроса.";
    }
}

pg_close($db_connection);
?>
