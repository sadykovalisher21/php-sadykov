<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<head>
<title> �������������� ������ </title>
</head>
<body>
<?php
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("���������� ������������ � �������");
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
print "������������: <input name='name' size='20' type='text'
value='".$name."'>";
print "<br>���: <input name='inn' size='20' type='text'
value='".$inn."'>";
print "<br>������: <input name='country' size='20' type='text'
value='".$country."'>";
print "<br>����� ����������: <input name='type' size='20' type='text'
value='".$type."'>";
print "<br>����� �������: <input name='volume' size='20' type='text'
value='".$volume."'>";
print "<input type='hidden' name='id' value='".$id."'> <br>";
print "<input type='submit' name='' value='���������'>";
print "</form>";
print "<p><a href=\"index.php\"> ��������� </a>";
?>
</body>
</html>