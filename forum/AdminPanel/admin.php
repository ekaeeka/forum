<?php
session_start();
require('../connection.php');

if ($_SESSION['admin'] != 1){
    header('Location:index.php');
}
//Выбираем темы которые на модерации
$moderation = $db->prepare("SELECT * FROM theme WHERE checked = :checked");
$moderation->execute([':checked'=>1]);
if ($moderation->rowCount() > 0) {
    $moderation = $moderation->fetchAll(PDO::FETCH_ASSOC);
}
$refuse = $db->prepare("SELECT * FROM theme WHERE checked = :checked");
$refuse->execute([':checked'=>0]);
if ($refuse->rowCount() > 0) {
    $refuse = $refuse->fetchAll(PDO::FETCH_ASSOC);
}
$published = $db->prepare("SELECT * FROM theme WHERE checked = :checked");
$published->execute([':checked'=>2]);
if ($published->rowCount() > 0) {
    $published = $published->fetchAll(PDO::FETCH_ASSOC);
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
<h3>Темы</h3>
<div class="themes">
    <div class="moded">
        <h4>Темы на модерации</h4>
    <?php
    foreach ($moderation as $theme){
       echo "<div><div><a href='moder.php?id=".$theme['id']."'>".$theme['name']."</a></div><div>".$theme['date']."</div><div>".$theme['owner_name']."</div></div><hr>";
    }
    ?>
        <h4>Опубликованные темы</h4>
        <?php
        foreach ($published as $theme){
            echo "<div><div><a href='moder.php?id=".$theme['id']."'>".$theme['name']."</a></div><div>".$theme['date']."</div><div>".$theme['owner_name']."</div></div><hr>";
        }
        ?>
        <h4>Отклонённые темы</h4>
        <?php
        foreach ($refuse as $theme){
            echo "<div><div><a href='moder.php?id=".$theme['id']."'>".$theme['name']."</a></div><div>".$theme['date']."</div><div>".$theme['owner_name']."</div></div><hr>";
        }
        ?>
    </div>
</div>
</body>
</html>
