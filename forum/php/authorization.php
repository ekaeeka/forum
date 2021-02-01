<?php
session_start();
require('../connection.php');

$email = $_POST['email'];
$password = $_POST['password'];

$result = $db->prepare("SELECT `id`, `email`, `password`, `name`, `admin`,banned FROM users WHERE `email` = :email");
$params = [':email' => $email];
$result->execute($params);
if ($result->rowCount() > 0) {
    $res = $result->fetch(PDO::FETCH_ASSOC);
    if ($password==$res['password']){
        $_SESSION['id'] = $res['id'];
        $_SESSION['profile']=$email;
        $_SESSION['name']=$res['name'];
        $_SESSION['banned']=$res['banned'];
        if ($res['admin']==1){
            $_SESSION['admin']=1;
        }
        header('Location:my_article.php');

    }
    else{
        echo "Пароли не совпадают";
    }
} else {
    echo "Такого пользователя не существует";
}
