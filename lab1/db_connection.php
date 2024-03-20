<?php
$host = 'localhost';
$port = 5432;
$db = 'notesdb';
$username = 'postgres';
$password = 'password';

$db_connection = pg_connect("host=$host port=$port dbname=$db user=$username password=$password");

if (!$db_connection) {
    die("Ошибка подключения к базе данных");
}
?>
