<?php
session_start();
require('../connection.php');

if ($_SESSION['admin'] != 1){
    header('Location:index.php');
}
$result = $db->prepare("SELECT * FROM `theme` WHERE id = :id");
$params = [':id' => $_GET['id']];
$result->execute($params);
if ($result->rowCount()>0){
    $article = $result->fetch(PDO::FETCH_ASSOC);
}
$modeVar = ['1'=>"На модерации",'2'=>'Опубликованное','0'=>'Отклонённое'];
if (!empty($_POST)){
   $result =  $db->prepare("UPDATE `theme` SET `checked`= :checked WHERE id = :id");
    $result->execute([':checked'=>$_POST['mode'],':id'=>$_GET['id']]);
    header("Location: /AdminPanel/moder.php?id=".$_GET['id']);
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
<h3>Тема для модерации</h3>
<div><a href="admin.php">Вернуться ко всем темам</a></div>
<?php
//Вывод статью
echo "<h4>".$article['name']."</h4><div>Автор:".$article['owner_name'].". Дата публикации".$article['date']."</div><p>".$article['text']."</p><hr>";
?>
<h4>Модерировать</h4>
<form action="" method="post">
    <?php
    foreach ($modeVar as $key => $value):
    ?>
    <div><input type="radio" <?php if ($key == $article['checked']):?>checked="checked" <?php endif; ?> name='mode' value='<?php echo $key?>'><?php echo $value?></div>

<?php endforeach;?>
    <input type="submit">
</form>
<div><?php if (isset($good))echo $good;?></div>
</body>
</html>

