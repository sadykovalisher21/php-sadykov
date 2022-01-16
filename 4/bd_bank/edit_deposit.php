<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<head>
<title> Редактирование данных </title>
</head>
<body>
<?php
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, 'SET NAMES cp1251');
 $rows=mysqli_query($conn, "SELECT * FROM deposit WHERE id=".$_GET['id']);
 while ($st = mysqli_fetch_array($rows)) {
 $name=$st["name"];
 $proc = $st['proc'];
 $id_bank = $st['id_bank'];
 }
print "<form action='save_edit_deposit.php' metod='get'>";
print "Название: <input name='name' size='20' type='text'
value='".$name."'>";
print "<br>% годовых: <input name='proc' size='20' type='text'
value='".$proc."'>";

print "<br>id Сервисного центра: <select name='id_bank'>";
$result=mysqli_query($conn, "SELECT * FROM bank");
echo "<option value='".$id_bank."' selected hidden>".$id_bank."</option>";
foreach($result as $row)
  echo "<option value='".$row["id"]."'>".$row["id"]."</option>";
echo "</select>";

print "<input type='hidden' name='id' value='".$_GET['id']."'>";
print "<input type='submit' name='' value='Сохранить'>";
print "</form>";
print "<p><a href=\"index.php\"> Вернуться </a>";
?>
</body>
</html>