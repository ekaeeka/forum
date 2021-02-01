<?php
session_start();
if ($_SESSION['profile']){
    header('Location:my_article.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <title></title>
</head>
<body>
    <form action="authorization.php" method="post">
    <h2>Вход</h2>
    <input type="text" placeholder="Логин" name="email" class="form"><br>
    <input type="password" placeholder="Пароль" name="password" class="form"><br>
    <input type="submit" value="Войти" class="button"><br>
    </form>
<h2>Регистрация</h2>
<form action="register.php" method="post">
    <input type="text" name="name" placeholder="Имя" class="form"><br>
    <input type="text" name="last_name" placeholder="Фамилия" class="form"><br>
    <input type="text" name="email" placeholder="Email" class="form"><br>
    <input type="password" name="password" placeholder="Пароль" class="form"><br>
    <input type="submit" value="Регистрация"  class="button"> </form>

