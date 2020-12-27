<?php
$host = 'localhost';
$db_name = 'forum';
$user = 'root';
$pass = '';
$charset = 'utf8';;

try {
    $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $db = new PDO($dsn, $user, $pass, $opt);
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}
