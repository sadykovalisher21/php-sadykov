<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
if(!$_SESSION["rule"]) header("Location: .");
?>

<?php
session_start();
if($_SESSION["rule"] != 2) header("Location: .");
?>

<html><body>
<?php
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, 'SET NAMES cp1251');
 $zapros="UPDATE users SET username='".$_GET['username']."', password='".md5($_GET['password'])."', rule='".$_GET['rule']."' WHERE username='".$_GET['old_username']."'";
 mysqli_query($conn, $zapros);
 if (mysqli_affected_rows($conn) > 0) {
  echo "Все сохранено. <a href='.'> Вернуться на главную</a>";
 }
 else {
  echo "Ошибка сохранения. <a href='.'> Вернуться на главную </a>";
 }
?>
</body></html>