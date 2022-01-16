<?php
  $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","b374ee7921ac55","547aa47c", "heroku_1ad19f5ab79e862") or die ("Невозможно подключиться к серверу");
  mysqli_query($conn, "SET NAMES cp1251");

  define('FPDF_FONTPATH',"../../fpdf/font/");
  require("../../fpdf/fpdf.php");
  
  $pdf = new FPDF();
  $pdf -> AddPage();
 
  $pdf -> AddFont("Arial", "", "arial.php");
  $pdf -> SetFont("Arial", "", "18");

  $pdf -> Cell(195, 10, "Заявки на ремонт", 1, 1, "C");

  $pdf -> SetFont("Arial", "", "6");

  $pdf -> Cell(5, 5, "№", 1, 0, "C");
  $pdf -> Cell(9, 5, "Марка", 1, 0, "C");
  $pdf -> Cell(10, 5, "Модель", 1, 0, "C");
  $pdf -> Cell(22, 5, "Тип разморозки", 1, 0, "C");
  $pdf -> Cell(20, 5, "Срок гарантии, г.", 1, 0, "C");
  $pdf -> Cell(25, 5, "Название серв. центра", 1, 0, "C");
  $pdf -> Cell(20, 5, "Адрес", 1, 0, "C");
  $pdf -> Cell(18, 5, "Дата начала", 1, 0, "C");
  $pdf -> Cell(18, 5, "Дата окончания", 1, 0, "C");
  $pdf -> Cell(30, 5, "ФИО", 1, 0, "C");
  $pdf -> Cell(18, 5, "Стоимость, руб.", 1, 1, "C");

  $pdf -> SetFont("Arial", "", "5");

  $query = mysqli_query($conn, "SELECT * FROM request");
  for($i = 1; $fetch_request = mysqli_fetch_array($query); $i++) {
    $date_in = $fetch_request["date_in"];
    $date_out = $fetch_request["date_out"];
    $id_fridge = $fetch_request["id_fridge"];
    $id_service = $fetch_request["id_service"];
    $fio = $fetch_request["fio"];
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
      $address = $fetch_service["address"];
    }

    $pdf -> Cell(5, 5, $i, 1, 0, "C");
    $pdf -> Cell(9, 5, $name_fridge, 1, 0, "C");
    $pdf -> Cell(10, 5, $model, 1, 0, "C");
    $pdf -> Cell(22, 5, $type, 1, 0, "C");
    $pdf -> Cell(20, 5, $time, 1, 0, "C");
    $pdf -> Cell(25, 5, $name_service, 1, 0, "C");
    $pdf -> Cell(20, 5, $address, 1, 0, "C");
    $pdf -> Cell(18, 5, date("d.m.Y", strtotime($date_in)), 1, 0, "C");
    $pdf -> Cell(18, 5, date("d.m.Y", strtotime($date_out)), 1, 0, "C");
    $pdf -> Cell(30, 5, $fio, 1, 0, "C");
    $pdf -> Cell(18, 5, $price, 1, 1, "C");
}

$pdf -> Output("gazin_6.pdf", "D");
?>