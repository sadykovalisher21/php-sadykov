<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<body>

<?php
  session_start();

  $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
  mysqli_query($conn, "SET NAMES cp1251");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $query=mysqli_query($conn, "SELECT * FROM users WHERE username='".$_POST["username"]."' AND password='".md5($_POST["password"])."'");
    if($fetch = mysqli_fetch_array($query)) {
      $_SESSION["username"] = $fetch["username"];
      $_SESSION["rule"] = $fetch["rule"];
      if(!$_SESSION["count"]) $_SESSION["count"] = 0;
    }
    else {
      echo "<html><head><title>Авторизация</title></head><body>";
      echo "Неверное имя пользователя или пароль!<br>";
      echo "<br><a href='.'> Вернуться </a>";
    }
  }
  elseif(!$_SESSION["username"]) { 
    echo "<html><head><title>Авторизация</title></head><body>";
    echo "<h1>Садыков А. А.</h1>";
    echo "<form method='post' action='". $PHP_SELF ."'>";
    echo "<p>Пользователь:</p><input type='text' name='username' size='16'>";
    echo "<p>Пароль:</p><input type='password' name='password' size='16'><br><br>";
    echo "<input type='submit' name='submit' value='Войти'></form>";
    echo "<br><a href='..'>Назад</a><br>";
  }
  
  if($_SESSION["username"]) {
    $query=mysqli_query($conn, "SELECT rule FROM users WHERE username='" . $_SESSION["username"] . "'");
    if($fetch = mysqli_fetch_array($query)) $_SESSION["rule"] = $fetch["rule"];

    echo "<html><head><title>База данных</title></head><body>";
    echo "<h2>Банки:</h2>";
    echo "<table border='1'>";
    echo "<tr><th> id </th>";
    echo "<th> Наименование </th> <th> ИНН </th>";
    echo "<th> Страна </th> <th> Класс недежности </th> <th> Объем активов </th>";
    echo "<th> Редактировать </th>";
    if($_SESSION["rule"] == 2) echo "<th>Уничтожить</th>";
    echo "</tr>";
    $result=mysqli_query($conn, "SELECT * FROM bank");
    while ($row=mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>" . $row["id"] . "</td>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td>" . $row["inn"] . "</td>";
      echo "<td>" . $row["country"] . "</td>";
      echo "<td>" . $row["type"] . "</td>";
      echo "<td>" . $row["volume"] . "</td>";
      echo "<td><a href='edit_bank.php?id=" . $row["id"]
      . "'>Редактировать</a></td>";
      if($_SESSION["rule"] == 2) echo "<td><a href='delete_bank.php?id=" . $row["id"]
      . "'>Удалить</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    $num_rows = mysqli_num_rows($result);
    echo "<p> Всего записей: $num_rows </p>";
    echo "<a href='new_bank.php'> Добавить запись </a><br><br>";

    echo "<h2>Программы депозитов:</h2>";
    echo "<table border='1'>";
    echo "<tr><th> id </th>";
    echo "<th> Название </th> <th> % Годовых </th> <th> id Банка </th>";
    echo "<th> Редактировать </th>";
    if($_SESSION["rule"] == 2) echo "<th> Уничтожить </th></tr>";
    $result=mysqli_query($conn, "SELECT * FROM deposit");
    while ($row=mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>" . $row["id"] . "</td>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td>" . $row["proc"] . "</td>";
      echo "<td>" . mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM bank WHERE id='".$row["id_bank"]."'"))["name"] . "</td>";
      echo "<td><a href='edit_deposit.php?id=" . $row["id"]
      . "'>Редактировать</a></td>";
      if($_SESSION["rule"] == 2) echo "<td><a href='delete_deposit.php?id=" . $row["id"]
      . "'>Удалить</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    $num_rows = mysqli_num_rows($result);
    echo "<p> Всего записей: $num_rows </p>";
    echo "<a href='new_deposit.php'> Добавить запись </a><br><br>";

    echo "<h2>Вклады:</h2>";
    echo "<table border='1'>";
    echo "<tr><th> id </th>";
    echo "<th> Дата создания вклада </th> <th> id Название программы </th> <th> Стартовая сумма вклада </th>";
    echo "<th> Редактировать </th>";
    if($_SESSION["rule"] == 2) echo "<th> Уничтожить </th> </tr>";
    $result=mysqli_query($conn, "SELECT * FROM invest");
    while ($row=mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>" . $row["id"] . "</td>";
      echo "<td>" . date("d.m.Y", strtotime($row["date"])) . "</td>";
      echo "<td>" . mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM deposit WHERE id='".$row["id_deposit"]."'"))["name"] . "</td>";
      echo "<td>" . $row["price"] . "</td>";
      echo "<td><a href='edit_invest.php?id=" . $row["id"]
      . "'>Редактировать</a></td>";
      if($_SESSION["rule"] == 2) echo "<td><a href='delete_invest.php?id=" . $row["id"]
      . "'>Удалить</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    $num_rows = mysqli_num_rows($result);
    echo "<p> Всего записей: $num_rows </p>";
    echo "<a href='new_invest.php'> Добавить запись </a><br><br>";

    if($_SESSION["rule"] == 2) {
      echo "<h2>Пользователи:</h2>";
      echo "<table border='1'>";
      echo "<tr><th>Имя пользователя</th><th>Пароль</th><th>Права доступа</th>";
      echo "<th>Редактировать</th><th>Уничтожить</th></tr>";
      $query=mysqli_query($conn, "SELECT * FROM users");
      while($fetch=mysqli_fetch_array($query)) {
        echo "<tr><td>" . $fetch["username"] . "</td>";
        echo "<td>" . $fetch["password"] . "</td>";
        echo "<td>" . $fetch["rule"] . "</td>";
        echo "<td><a href='edit_users.php?username=" . $fetch["username"] . "'>Редактировать</a></td>";
        echo "<td><a href='delete_users.php?username=" . $fetch["username"]. "'>Удалить</a></td></tr>";
      } 
      echo "</table>";
   
      $num_rows = mysqli_num_rows($query);
      echo "<p> Всего записей: $num_rows </p>";
      echo "<a href='new_users.php'>Добавить запись</a><br><br>";
    }

    echo "<br><a href='gen_pdf.php'> Сохранить PDF </a><br>";
    echo "<a href='gen_xls.php'> Сохранить Excel </a><br>";

    $_SESSION["count"]++;
    echo "<br>Подключений за сессию: " . $_SESSION["count"];
    echo "<br><a href='exit.php'>Выход</a><br>";

    echo "<br><a href='..'>Назад</a><br>";

    echo "</body></html>";
 }
?>