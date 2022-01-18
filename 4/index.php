<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<body>
<?php
 $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, "SET NAMES cp1251");
?>
<h2>Банки:</h2>
<table border="1">
<tr>
 <th> id </th>
 <th> Наименование </th> <th> ИНН </th>
 <th> Страна </th> <th> Класс надежности </th> <th> Объем активов </th>
 <th> Редактировать </th> <th> Уничтожить </th> </tr>
<?php
$result=mysqli_query($conn, "SELECT * FROM bank"); // запрос на выборку сведений о пользователях
while ($row=mysqli_fetch_array($result)){// для каждой строки из запроса
 echo "<tr>";
 echo "<td>" . $row["id"] . "</td>";
 echo "<td>" . $row["name"] . "</td>";
 echo "<td>" . $row["inn"] . "</td>";
 echo "<td>" . $row["country"] . "</td>";
 echo "<td>" . $row["type"] . "</td>";
 echo "<td>" . $row["volume"] . "</td>";
 echo "<td><a href='edit_bank.php?id=" . $row["id"]
. "'>Редактировать</a></td>"; // запуск скрипта для редактирования
 echo "<td><a href='delete_bank.php?id=" . $row["id"]
. "'>Удалить</a></td>"; // запуск скрипта для удаления записи
 echo "</tr>";
}
echo "</table>";
$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего записей: $num_rows </p>");
?>
<a href="new_bank.php"> Добавить запись </a><br><br>

<h2>Программы депозитов:</h2>
<table border="1">
<tr>
 <th> id </th>
 <th> Название </th> <th> % годовых </th> <th> Наименование банка </th>
 <th> Редактировать </th> <th> Уничтожить </th> </tr>
<?php
$result=mysqli_query($conn, "SELECT * FROM deposit"); // запрос на выборку сведений о пользователях
while ($row=mysqli_fetch_array($result)){// для каждой строки из запроса
 echo "<tr>";
 echo "<td>" . $row["id"] . "</td>";
 echo "<td>" . $row["name"] . "</td>";
 echo "<td>" . $row["proc"] . "</td>";
 echo "<td>" . mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM bank WHERE id='".$row["id_bank"]."'"))["name"] . "</td>";
 echo "<td><a href='edit_deposit.php?id=" . $row["id"]
. "'>Редактировать</a></td>"; // запуск скрипта для редактирования
 echo "<td><a href='delete_deposit.php?id=" . $row["id"]
. "'>Удалить</a></td>"; // запуск скрипта для удаления записи
 echo "</tr>";
}
echo "</table>";
$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего записей: $num_rows </p>");
?>
<a href="new_deposit.php"> Добавить запись </a><br><br>

<h2>Вклады:</h2>
<table border="1">
<tr>
 <th> id </th>
 <th> Дата создания </th> <th> Наименование депозита </th> <th> Стартовая сумма вклада, руб. </th>
 <th> Редактировать </th> <th> Уничтожить </th> </tr>
<?php
$result=mysqli_query($conn, "SELECT * FROM invest"); // запрос на выборку сведений о пользователях
while ($row=mysqli_fetch_array($result)){// для каждой строки из запроса
 echo "<tr>";
 echo "<td>" . $row["id"] . "</td>";
 echo "<td>" . date("d.m.Y", strtotime($row["date"])) . "</td>";
 echo "<td>" . mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM deposit WHERE id='".$row["id_deposit"]."'"))["name"] . "</td>";
 echo "<td>" . $row["price"] . "</td>";;
 echo "<td><a href='edit_invest.php?id=" . $row["id"]
. "'>Редактировать</a></td>"; // запуск скрипта для редактирования
 echo "<td><a href='delete_invest.php?id=" . $row["id"]
. "'>Удалить</a></td>"; // запуск скрипта для удаления записи
 echo "</tr>";
}
echo "</table>";
$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего записей: $num_rows </p>");
?>
<a href="new_invest.php"> Добавить запись </a><br><br>


<a href="gen_pdf.php"> Сохранить PDF </a><br>
<a href="gen_xls.php"> Сохранить Excel </a><br>

<br><a href='..'>Назад</a><br>

</body> </html>
