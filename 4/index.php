<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<body>
<h1> Фамилия И. О. </h1>
<p> Дата и время:

<?php
        date_default_timezone_set("Asia/Yekaterinburg");
	$d=date("d.m.Y H:i");
	
	echo($d);
?>
<br><br>

<a href='./bd_user/'>Общее задание (Пользователи)</a><br>
<a href='./bd_bank/'>Вариант №3 (Банки)</a><br>

<br><a href='..'>Назад</a><br>


