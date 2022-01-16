<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
 session_start();
 if($_SESSION["rule"] == 2) {
  echo "<html><head><title>Добавление новой записи</title></head><body>";
  echo "<h2>Добавление новой записи:</h2>";
  echo "<form action='save_new_users.php' metod='get'>";
  echo "<br>Имя пользователя: <input name='username' size='20' type='text'>";
  echo "<br>Пароль: <input name='password' size='20' type='password'>";
  echo "<br>Права доступа: <input name='rule' size='10' type='text'><br><br>";
  echo "<input name='add' type='submit' value='Добавить'>";
  echo "<input name='b2' type='reset' value='Очистить'></form>";
  echo "<a href='index.php'>Вернуться</a></body></html>";
 }
 else {
  header("Location: .");
 }
?>