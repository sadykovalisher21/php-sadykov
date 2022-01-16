<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
 session_start();
 if($_SESSION["rule"] == 2) {
  $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
  mysqli_query($conn, 'SET NAMES cp1251');
  $sql_add = "INSERT INTO users SET username='" . $_GET['username']."', password='".md5($_GET['password'])."', rule='".$_GET['rule']. "'";
  mysqli_query($conn, $sql_add);
  if (mysqli_affected_rows($conn)>0) { // если нет ошибок при выполнении запроса
   echo "Запись сохранена.<br>";
   echo "<a href='.'>Вернуться </a>";
  }
  else {
   echo "Ошибка сохранения. <a href='.'>Вернуться </a>";
  }
 }
 else {
  header("Location: .");
 }
?>