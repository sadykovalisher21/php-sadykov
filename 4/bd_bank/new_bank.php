<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<head> <title> ���������� ����� ������ </title> </head>
<body>
<H2>���������� ����� ������:</H2>
<form action="save_new_bank.php" metod="get">
<br>������������: <input name="name" size="20" type="text">
<br>���: <input name="inn" size="20" type="text">
<br>������: <input name="country" size="10" type="text">
<br>����� ����������: <input name="type" size="20" type="text">
<br>����� �������: <input name="volume" size="20" type="text">
<p><input name="add" type="submit" value="��������">
<input name="b2" type="reset" value="��������"></p>
</form>
<p><a href="index.php"> ��������� </a>
</body>
</html>