<?php
session_start();

if ($_SESSION['profile']==false){
    header("Location: autorization_form.php");
}
require('../connection.php');
echo "Вы авторизовались как ".$_SESSION['name']. " <a href='session_stop.php'>Выйти из аккаунта</a>";
$query = $db->prepare( "SELECT * FROM `theme` WHERE owner = :owner");
$params = [':owner'=>$_SESSION['id']];
$query->execute($params);
if ($query->rowCount()>0){
    $articles = $query->fetchAll(PDO::FETCH_ASSOC);
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
<a href="../index.php">Посмотреть все темы</a>
<h3>Мои темы</h3>
<a href="add_article.php">Добавить новую тему</a>
<div>
<?php
  if ($articles!=null){

      foreach ($articles as $article){

          echo "<a  href='view_article.php?id=".$article['id']."  '><h4>".$article['name']."</h4></a><div>Автор:".$_SESSION['name']." .Дата публикации".$article['date']."</div><p>".$article['text']."</p><hr>";
      }
  }
  else{
      echo "<h3>У вас еще нет тем</h3>";
  }
?>
</div>
</body>
</html>

