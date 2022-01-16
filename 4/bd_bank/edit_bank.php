<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<head>
<title> Редактирование данных </title>
</head>
<body>
<?php
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, 'SET NAMES cp1251');
 $rows=mysqli_query($conn, "SELECT * FROM bank WHERE id='".$_GET['id']."'");
 while ($st = mysqli_fetch_array($rows)) {
 $id=$st['id'];
 $name=$st['name'];
 $inn = $st['inn'];
 $country = $st['country'];
 $type = $st['type'];
 $volume = $st['volume'];
 }
print "<form action='save_edit_fridge.php' metod='get'>";
print "Наименование: <input name='name' size='20' type='text'
value='".$name."'>";
print "<br>ИНН: <input name='inn' size='20' type='text'
value='".$inn."'>";
print "<br>Страна: <input name='country' size='20' type='text'
value='".$country."'>";
print "<br>Класс надежности: <input name='type' size='20' type='text'
value='".$type."'>";
print "<br>Объем активов: <input name='volume' size='20' type='text'
value='".$volume."'>";
print "<input type='hidden' name='id' value='".$id."'> <br>";
print "<input type='submit' name='' value='Сохранить'>";
print "</form>";
print "<p><a href=\"index.php\"> Вернуться </a>";
?>
</body>
</html>