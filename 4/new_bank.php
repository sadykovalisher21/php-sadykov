<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<head> <title> Добавление новой записи </title> </head>
<body>
<H2>Добавление новой записи:</H2>
<form action="save_new_bank.php" metod="get">
<br>Наименование: <input name="name" size="20" type="text">
<br>ИНН: <input name="inn" size="20" type="text">
<br>Страна: <input name="country" size="10" type="text">
<br>Класс надежности: <input name="type" size="20" type="text">
<br>Объем активов: <input name="volume" size="20" type="text">
<p><input name="add" type="submit" value="Добавить">
<input name="b2" type="reset" value="Очистить"></p>
</form>
<p><a href="index.php"> Вернуться </a>
</body>
</html>