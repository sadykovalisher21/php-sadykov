<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
if(!$_SESSION["rule"]) header("Location: .");
?>

<html><body>
<?php
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("���������� ������������ � �������");
 mysqli_query($conn , 'SET NAMES cp1251');
 $zapros="UPDATE bank SET name='".$_GET['name'].
"', inn='".$_GET['inn']."', country='"
.$_GET['country']."', type='".$_GET['type'].
"', volume='".$_GET['volume']."' WHERE id='"
.$_GET['id']."'";
 mysqli_query($conn, $zapros);
if (mysqli_affected_rows($conn)>0) {
 echo '��� ���������. <a href="index.php"> ��������� </a>'; }
 else { echo '������ ����������. <a href="index.php">
���������</a> '; }
?>
</body></html>