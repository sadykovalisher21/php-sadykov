<?php
session_start();
if($_SESSION["rule"] == 2) {
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("���������� ������������ � �������");
 $zapros="DELETE FROM bank WHERE id='" . $_GET['id']."'";
 mysqli_query($conn, $zapros);
}

header("Location: index.php");
exit;
?>

