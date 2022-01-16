<?php
  header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
  header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  header("Content-Disposition: attachment; filename=sadykov_3.xlsx");

  require "../../vendor/autoload.php";

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("Невозможно подключиться к серверу");
  mysqli_query($conn, "SET NAMES utf8");

  $spreadsheet = new Spreadsheet();
  
  $sheet = $spreadsheet -> getActiveSheet();

  $sheet -> setTitle("Вклады");

  $sheet -> SetCellValue("A1", "Заявки на ремонт");
  $sheet -> mergeCells("A1:G1");
  $sheet -> getStyle("A1:G1") -> getAlignment() -> setHorizontal("center");

  $sheet -> getColumnDimension("A") -> setWidth(5);
  $sheet -> getColumnDimension("B") -> setWidth(25);
  $sheet -> getColumnDimension("C") -> setWidth(20);
  $sheet -> getColumnDimension("D") -> setWidth(20);
  $sheet -> getColumnDimension("E") -> setWidth(25);
  $sheet -> getColumnDimension("F") -> setWidth(15);
  $sheet -> getColumnDimension("G") -> setWidth(30);

  $sheet -> SetCellValue("A2", "№");
  $sheet -> SetCellValue("B2", "Наименование банка");
  $sheet -> SetCellValue("C2", "Страна");
  $sheet -> SetCellValue("D2", "Класс надежности");
  $sheet -> SetCellValue("E2", "Название программы");
  $sheet -> SetCellValue("F2", "% Годовых");
  $sheet -> SetCellValue("G2", "Сумма всех вкладов такого типа, руб.");

  $query = mysqli_query($conn, "SELECT * FROM deposit");
  for($i = 1; $fetch_deposit = mysqli_fetch_array($query); $i++) {
    $id_deposit = $fetch_deposit["id"];
    $name_deposit = $fetch_deposit["name"];
    $id_bank = $fetch_deposit["id_bank"];
    $proc = $fetch_deposit["proc"];

    $query_bank = mysqli_query($conn, "SELECT * FROM bank WHERE id = '" . $id_bank . "'");
    if($fetch_bank = mysqli_fetch_array($query_bank)) {
      $name_bank = $fetch_bank["name"];
      $country = $fetch_bank["country"];
      $type = $fetch_bank["type"];
    }
   
    $query_invest = mysqli_query($conn, "SELECT SUM(price) AS price_sum FROM invest WHERE id_deposit='".$id_deposit."' GROUP BY id_deposit");
    if($fetch_invest = mysqli_fetch_array($query_invest)) {
      $price_sum = $fetch_invest["price_sum"];
    }

    $sheet -> SetCellValue("A".($i+2), $i);
    $sheet -> SetCellValue("B".($i+2), $name_bank);
    $sheet -> SetCellValue("C".($i+2), $country);
    $sheet -> SetCellValue("D".($i+2), $type);
    $sheet -> SetCellValue("E".($i+2), $name_deposit);
    $sheet -> SetCellValue("F".($i+2), $proc);
    $sheet -> SetCellValue("G".($i+2), $price_sum);

  }

  $writer = new Xlsx($spreadsheet);
  $writer -> save("php://output");

  exit();
  
?>
