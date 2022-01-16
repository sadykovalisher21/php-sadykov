<?php
 session_start();
 if($_SESSION["rule"] == 2) {
  $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
  $zapros="DELETE FROM users WHERE username='" . $_GET['username']."'";
  mysqli_query($conn, $zapros);

  if($_GET['username'] == $_SESSION['username']) session_destroy();
 }
 header("Location: .");
?>