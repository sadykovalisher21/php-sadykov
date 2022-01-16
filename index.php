<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<body>
<h1> Садыков А. А. </h1>
<p> Дата и время:

<?php
        date_default_timezone_set("Asia/Yekaterinburg");
	$d=date("d.m.Y H:i");
	
	echo($d);
?>
<br><br>

<a href='./4/'>Лабораторная работа №4</a><br>
<a href='./5/'>Лабораторная работа №5</a><br>

</body>

