<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
if(!$_SESSION["rule"]) header("Location: .");
?>

<html>
<head>
<title> Редактирование данных </title>
</head>
<body>
<?php
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, 'SET NAMES cp1251');
 $rows=mysqli_query($conn, "SELECT * FROM invest WHERE id=".$_GET['id']);
 while ($st = mysqli_fetch_array($rows)) {
 $date=$st["date"];
 $id_deposit=$st["id_deposit"];
 $price=$st["price"];
 }
print "<form action='save_edit_invest.php' metod='get'>";
print "<br>Дата создания вклада: <input name='date' size='20' type='date'
value='".$date."'>";

print "<br>Наименование депозита: <select name='id_deposit'>";
$result=mysqli_query($conn, "SELECT * FROM deposit");
foreach($result as $row) {
  if($row["id"] == $id_deposit) echo "<option value='".$row["id"]."' selected>".$row["name"]."</option>";
  else echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
  }
echo "</select>";

print "<br>Стартовая сумма вклада, руб.: <input name='price' size='20' type='text'
value='".$price."'>";
print "<input type='hidden' name='id' value='".$_GET['id']."'>";
print "<input type='submit' name='' value='Сохранить'>";
print "</form>";
print "<p><a href=\"index.php\"> Вернуться </a>";
?>
</body>
</html>