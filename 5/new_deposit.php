<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
if(!$_SESSION["rule"]) header("Location: .");
?>

<html>
<head> <title> Добавление новой записи </title> </head>
<body>
<?php
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, "SET NAMES cp1251");
?>
<H2>Добавление новой записи:</H2>
<form action="save_new_deposit.php" metod="get">
<br>Название: <input name="name" size="20" type="text">
<br>% годовых: <input name="proc" size="20" type="text">

<br>id Банка: <select name="id_bank">
<?php
  $result=mysqli_query($conn, "SELECT * FROM bank");
  echo "<option value='' selected disabled hidden>...</option>";
  foreach($result as $row)
    echo "<option value='".$row["id"]."'>".$row["id"]."</option>";
  echo "</select>";
?>

<p><input name="add" type="submit" value="Добавить">
<input name="b2" type="reset" value="Очистить"></p>
</form>
<p><a href="index.php"> Вернуться </a>
</body>
</html>