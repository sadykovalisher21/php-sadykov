<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<body>
<?php
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("���������� ������������ � �������");
 mysqli_query($conn, "SET NAMES cp1251");
?>
<h2>�����:</h2>
<table border="1">
<tr>
 <th> id </th>
 <th> ������������ </th> <th> ��� </th>
 <th> ������ </th> <th> ����� ���������� </th> <th> ����� ������� </th>
 <th> ������������� </th> <th> ���������� </th> </tr>
<?php
$result=mysqli_query($conn, "SELECT * FROM bank"); // ������ �� ������� �������� � �������������
while ($row=mysqli_fetch_array($result)){// ��� ������ ������ �� �������
 echo "<tr>";
 echo "<td>" . $row["id"] . "</td>";
 echo "<td>" . $row["name"] . "</td>";
 echo "<td>" . $row["inn"] . "</td>";
 echo "<td>" . $row["country"] . "</td>";
 echo "<td>" . $row["type"] . "</td>";
 echo "<td>" . $row["volume"] . "</td>";
 echo "<td><a href='edit_bank.php?id=" . $row["id"]
. "'>�������������</a></td>"; // ������ ������� ��� ��������������
 echo "<td><a href='delete_bank.php?id=" . $row["id"]
. "'>�������</a></td>"; // ������ ������� ��� �������� ������
 echo "</tr>";
}
echo "</table>";
$num_rows = mysqli_num_rows($result); // ����� ������� � ������� ��
print("<P>����� �������: $num_rows </p>");
?>
<a href="new_bank.php"> �������� ������ </a><br><br>

<h2>��������� ���������:</h2>
<table border="1">
<tr>
 <th> id </th>
 <th> �������� </th> <th> % ������� </th> <th> ������������ ����� </th>
 <th> ������������� </th> <th> ���������� </th> </tr>
<?php
$result=mysqli_query($conn, "SELECT * FROM deposit"); // ������ �� ������� �������� � �������������
while ($row=mysqli_fetch_array($result)){// ��� ������ ������ �� �������
 echo "<tr>";
 echo "<td>" . $row["id"] . "</td>";
 echo "<td>" . $row["name"] . "</td>";
 echo "<td>" . $row["proc"] . "</td>";
 echo "<td>" . mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM bank WHERE id='".$row["id_bank"]."'"))["name"] . "</td>";
 echo "<td><a href='edit_deposit.php?id=" . $row["id"]
. "'>�������������</a></td>"; // ������ ������� ��� ��������������
 echo "<td><a href='delete_deposit.php?id=" . $row["id"]
. "'>�������</a></td>"; // ������ ������� ��� �������� ������
 echo "</tr>";
}
echo "</table>";
$num_rows = mysqli_num_rows($result); // ����� ������� � ������� ��
print("<P>����� �������: $num_rows </p>");
?>
<a href="new_deposit.php"> �������� ������ </a><br><br>

<h2>������:</h2>
<table border="1">
<tr>
 <th> id </th>
 <th> ���� �������� </th> <th> ������������ �������� </th> <th> ��������� ����� ������, ���. </th>
 <th> ������������� </th> <th> ���������� </th> </tr>
<?php
$result=mysqli_query($conn, "SELECT * FROM invest"); // ������ �� ������� �������� � �������������
while ($row=mysqli_fetch_array($result)){// ��� ������ ������ �� �������
 echo "<tr>";
 echo "<td>" . $row["id"] . "</td>";
 echo "<td>" . date("d.m.Y", strtotime($row["date"])) . "</td>";
 echo "<td>" . mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM deposit WHERE id='".$row["id_deposit"]."'"))["name"] . "</td>";
 echo "<td>" . $row["price"] . "</td>";;
 echo "<td><a href='edit_invest.php?id=" . $row["id"]
. "'>�������������</a></td>"; // ������ ������� ��� ��������������
 echo "<td><a href='delete_invest.php?id=" . $row["id"]
. "'>�������</a></td>"; // ������ ������� ��� �������� ������
 echo "</tr>";
}
echo "</table>";
$num_rows = mysqli_num_rows($result); // ����� ������� � ������� ��
print("<P>����� �������: $num_rows </p>");
?>
<a href="new_invest.php"> �������� ������ </a><br><br>


<a href="gen_pdf.php"> ��������� PDF </a><br>
<a href="gen_xls.php"> ��������� Excel </a><br>

<br><a href='..'>�����</a><br>

</body> </html>
