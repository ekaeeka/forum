<?php

session_start();
//var_dump($_SESSION);
require('../connection.php');
if($_SESSION['profile']==false){
    header("Location: autorization_form.php");
}
if (isset($_POST['go'])){
    $name=$_POST['name'];
    $text=$_POST['text'];
    if($_SESSION['banned']==1){
        $error = "Вы были забанены и не можете добавлять темы";
    }
    else{
        if(!empty($name)&& !empty($text)){
            $query = $db->prepare("INSERT INTO `theme`( `name`, `text`, `date`, `owner`,`owner_name`, `checked`) VALUES (:name,:text,:date,:owner,:owner_name,1)");
            $params = [':name'=>$name,':text'=>$text,':date'=>date('Y-m-d'),':owner'=>$_SESSION['id'],':owner_name'=>$_SESSION['name']];
            $query->execute($params);
            $ok = "Вы добавили тему";
        }
        else{
            $error = "Поля должны быть заполнены";
        }
    }


}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="add_article.php" method="post">
    <h2>Добавление темы</h2>
    <input type="text" placeholder="Название темы" name="name" class="form"><br>
    <input type="text" placeholder="Текст темы" name="text" class="form"><br>
    <input type="submit" name="go" value="Отправить" class="button"><br>
</form>
<?php
if ($ok != null){
    echo $ok. " <a href='my_article.php'>Посмотреть свои статьи</a>";
}
elseif ($error!=null){
    echo "<br><div>".$error."</div>";
}
?>

</body>
</html>
