<?php
require_once '../../../db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $check_query = "SELECT * FROM users WHERE login = $1";
    $check_result = pg_query_params($db_connection, $check_query, array($username));

    if (pg_num_rows($check_result) > 0) {
        echo "Пользователь с таким именем уже существует. Пожалуйста, выберите другое имя.";
    } else {
        if ($password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (login, hashed_password) VALUES ($1, $2)";
            $insert_result = pg_query_params($db_connection, $insert_query, array($username, $hashed_password));

            if ($insert_result) {
                echo "Регистрация прошла успешно. Теперь вы можете войти.";
            } else {
                echo "Ошибка выполнения запроса.";
            }
        } else {
            echo "Пароль и подтверждение пароля не совпадают.";
        }
    }
}

pg_close($db_connection);
?>
