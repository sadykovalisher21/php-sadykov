<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
session_destroy();
header("Location: .");
?>