<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
if(!$_SESSION["rule"]) header("Location: .");
?>

<?php
 // ����������� � ���� ������:
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("���������� ������������ � �������");
 mysqli_query($conn, 'SET NAMES cp1251'); // ��� ���������
 // ������ ������� �� ���������� ������ � �������:
 $sql_add =  $sql_add = "INSERT INTO invest SET date='" . $_GET['date']
."', id_deposit='".$_GET['id_deposit']."', price='".$_GET['price']."'";
 mysqli_query($conn, $sql_add); // ���������� �������
 if (mysqli_affected_rows($conn)>0) // ���� ��� ������ ��� ���������� �������
 { print "<p>������ ���������.";
 print "<p><a href=\"index.php\"> ��������� �� ������� </a>"; }
 else { print "������ ����������. <a href=\"index.php\">
��������� �� ������� </a>"; }
?>