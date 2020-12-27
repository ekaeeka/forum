<?php
session_start();
require('connection.php');
if ($_SESSION["profile"] == null){
    echo '<a href="php/authorization_form.php">Авторизация</a>';
}
else{
    echo '<a href="php/my_article.php">Мои статьи</a>
<a href="php/session_stop.php">Выход</a>';
}
$result = $db->prepare("SELECT * FROM `theme` ");
$result->execute();
if ($result->rowCount()>0){
    $articles = $result->fetchAll(PDO::FETCH_ASSOC);
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
<?php
if ($articles!=null){

    foreach ($articles as $article){

        echo "<a  href='/php/view_article.php?id=".$article['id']."  '><h4>".$article['name']."</h4></a><div>Автор:".$article['owner_name']." .Дата публикации".$article['date']."</div><p>".$article['text']."</p><hr>";
    }
}
?>
</body>
</html>
