<?php
session_start();

require('../connection.php');

///Берём данные о статье из бд по id
$result = $db->prepare("SELECT * FROM `theme` WHERE id = :id");
$params = [':id' => $_GET['id']];
$result->execute($params);
if ($result->rowCount()>0){
    $article = $result->fetch(PDO::FETCH_ASSOC);
}

//Берём все комментарии к этой записи
$result = $db->prepare("SELECT * FROM `comment` WHERE id_theme = :id");
$params = [':id' => $_GET['id']];
$result->execute($params);
if ($result->rowCount()>0){
    $comments = $result->fetchAll(PDO::FETCH_ASSOC);
}

//Добавление комментария
if (isset($_POST['go'])){
    if ($_SESSION['profile']!=null){
        if($_SESSION['banned']==1){
            $error = "Вы были забанены и не можете оставлять комментарии к теме";
        }
        else{
            if (!empty($_POST['comment'])){
                $commentariy = $_POST['comment'];
                $query = $db->prepare("INSERT INTO `comment`( `id_theme`, `id_user`, `name_user`, `text`, `date`) VALUES (:theme,:user,:name_user,:text,:date)");
                $params = [':theme'=>$_GET['id'],':user'=>$_SESSION['id'],':name_user'=>$_SESSION['name'],':text'=>$commentariy,':date'=>date('Y-m-d')];
                $query->execute($params);
                header("Location: view_article.php?id=".$_GET['id']);
            }
            else{
                $error = "Напишите что нибуль в комментарий";
            }
        }

    }
    else{
        $error = "Вы должны быть зарегистрированы";
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
<?php
//Вывод статью
echo "<h4>".$article['name']."</h4><div>Автор:".$article['owner_name'].". Дата публикации".$article['date']."</div><p>".$article['text']."</p>";
?>
<h3>Комментарии</h3>

<?php
//Вывод комментариев если они есть
   if ($comments != null){
       foreach ($comments as $comment){
           echo "<div><div>".$comment['name_user']."</div><div>".$comment['date']."</div><div>".$comment['text']."</div></div><hr>";
       }
  }
   else{
       echo "Комментариев нет";
   }
?>

<form action="view_article.php?id=<?php echo $_GET['id']?>" method="post">
    <br>
    <div>Оставьте комментарий</div>
    <textarea name="comment"  cols="50" rows="10"></textarea><br>
    <input type="submit" placeholder="Отправить комментарий" name="go">
</form>
<?php
//Вывод ошибки если она есть
if ($error!=null){
    echo $error;
}
?>
</body>
</html>
