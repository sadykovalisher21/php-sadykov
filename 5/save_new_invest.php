<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
if(!$_SESSION["rule"]) header("Location: .");
?>

<?php
 // Подключение к базе данных:
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, 'SET NAMES cp1251'); // Тип кодировки
 // Строка запроса на добавление записи в таблицу:
 $sql_add =  $sql_add = "INSERT INTO invest SET date='" . $_GET['date']
."', id_deposit='".$_GET['id_deposit']."', price='".$_GET['price']."'";
 mysqli_query($conn, $sql_add); // Выполнение запроса
 if (mysqli_affected_rows($conn)>0) // если нет ошибок при выполнении запроса
 { print "<p>Запись сохранена.";
 print "<p><a href=\"index.php\"> Вернуться на главную </a>"; }
 else { print "Ошибка сохранения. <a href=\"index.php\">
Вернуться на главную </a>"; }
?>