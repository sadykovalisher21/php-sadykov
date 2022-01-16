<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
if(!$_SESSION["rule"]) header("Location: .");
?>

<?php
 session_start();
 if($_SESSION["rule"] == 2) {
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, 'SET NAMES cp1251');
  $rows=mysqli_query($conn, "SELECT username, rule FROM users WHERE username='".$_GET['username']."'");
  while ($st = mysqli_fetch_array($rows)) {
   $username=$_GET["username"];
   $rule = $st['rule'];
  }
  echo "<html><head><title>Редактирование данных</title></head><body>";
  echo "<H2>Редактирование данных:</H2>";
  echo "<form action='save_edit_users.php' metod='get'>";
  echo "Имя пользователя: <input name='username' size='20' type='text' value='".$username."'>";
  echo "<br>Пароль: <input name='password' size='20' type='password' value=''>";
  echo "<br>Права доступа: <input name='rule' size='10' type='text' value='".$rule."'>";
  echo "<br><input type='hidden' name='old_username' value='".$username."'>";
  
  echo "<input type='submit' name='' value='Сохранить'></form>";
  echo "<p><a href='.'> Вернуться </a></body></html>";
 }
 else {
  header("Location: .");
 }
?>