<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
if(!$_SESSION["rule"]) header("Location: .");
?>

<html>
<head> <title> ���������� ����� ������ </title> </head>
<body>
<?php
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("���������� ������������ � �������");
 mysqli_query($conn, "SET NAMES cp1251");
?>
<H2>���������� ����� ������:</H2>
<form action="save_new_deposit.php" metod="get">
<br>��������: <input name="name" size="20" type="text">
<br>% �������: <input name="proc" size="20" type="text">

<br>id �����: <select name="id_bank">
<?php
  $result=mysqli_query($conn, "SELECT * FROM bank");
  echo "<option value='' selected disabled hidden>...</option>";
  foreach($result as $row)
    echo "<option value='".$row["id"]."'>".$row["id"]."</option>";
  echo "</select>";
?>

<p><input name="add" type="submit" value="��������">
<input name="b2" type="reset" value="��������"></p>
</form>
<p><a href="index.php"> ��������� </a>
</body>
</html>