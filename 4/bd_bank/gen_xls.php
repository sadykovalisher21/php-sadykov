<?php
  header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
  header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  header("Content-Disposition: attachment; filename=gazin_6.xlsx");

  require "../../vendor/autoload.php";

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","b374ee7921ac55","547aa47c", "heroku_1ad19f5ab79e862") or die ("Невозможно подключиться к серверу");
  mysqli_query($conn, "SET NAMES cp1251");

  $spreadsheet = new Spreadsheet();
  
  $sheet = $spreadsheet -> getActiveSheet();

  $sheet -> setTitle("Заявки на ремонт");

  $sheet -> SetCellValue("A1", "Заявки на ремонт");
  $sheet -> mergeCells("A1:I1");
  $sheet -> getStyle("A1:I1") -> getAlignment() -> setHorizontal("center");

  $sheet -> getColumnDimension("A") -> setWidth(5);
  $sheet -> getColumnDimension("B") -> setWidth(15);
  $sheet -> getColumnDimension("C") -> setWidth(15);
  $sheet -> getColumnDimension("D") -> setWidth(18);
  $sheet -> getColumnDimension("E") -> setWidth(30);
  $sheet -> getColumnDimension("F") -> setWidth(15);
  $sheet -> getColumnDimension("G") -> setWidth(15);
  $sheet -> getColumnDimension("H") -> setWidth(50);
  $sheet -> getColumnDimension("I") -> setWidth(18);

  $sheet -> SetCellValue("A2", "№");
  $sheet -> SetCellValue("B2", "Марка");
  $sheet -> SetCellValue("C2", "Модель");
  $sheet -> SetCellValue("D2", "Срок гарантии, г.");
  $sheet -> SetCellValue("E2", "Адрес");
  $sheet -> SetCellValue("F2", "Дата начала");
  $sheet -> SetCellValue("G2", "Дата окончания");
  $sheet -> SetCellValue("H2", "ФИО");
  $sheet -> SetCellValue("I2", "Стоимость, руб.");

  $query = mysqli_query($conn, "SELECT * FROM request");
  for($i = 1; $fetch_request = mysqli_fetch_array($query); $i++) {
    $date_in = $fetch_request["date_in"];
    $date_out = $fetch_request["date_out"];
    $id_fridge = $fetch_request["id_fridge"];
    $id_service = $fetch_request["id_service"];
    $fio = iconv("windows-1251", "utf-8", $fetch_request["fio"]);
    $price = $fetch_request["price"];

    $query_fridge = mysqli_query($conn, "SELECT * FROM fridge WHERE id = '" . $id_fridge . "'");
    if($fetch_fridge = mysqli_fetch_array($query_fridge)) {
      $name_fridge = $fetch_fridge["name"];
      $model = $fetch_fridge["model"];
      $type = $fetch_fridge["type"];
      $time = $fetch_fridge["time"];
    }
   
    $query_service = mysqli_query($conn, "SELECT * FROM service WHERE id = '" . $id_service . "'");
    if($fetch_service = mysqli_fetch_array($query_service)) {
      $name_service = $fetch_service["name"];
      $address = iconv("windows-1251", "utf-8", $fetch_service["address"]);
    }

    $sheet -> SetCellValue("A".($i+2), $i);
    $sheet -> SetCellValue("B".($i+2), $name_fridge);
    $sheet -> SetCellValue("C".($i+2), $model);
    $sheet -> SetCellValue("D".($i+2), $time);
    $sheet -> SetCellValue("E".($i+2), $address);
    $sheet -> SetCellValue("F".($i+2), date("d.m.Y", strtotime($date_in)));
    $sheet -> SetCellValue("G".($i+2), date("d.m.Y", strtotime($date_out)));
    $sheet -> SetCellValue("H".($i+2), $fio);
    $sheet -> SetCellValue("I".($i+2), $price);
  }

  $writer = new Xlsx($spreadsheet);
  $writer -> save("php://output");

  exit();
  
?>
