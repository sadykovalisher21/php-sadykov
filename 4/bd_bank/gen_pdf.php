<?php
  $conn = mysqli_connect("eu-cdbr-west-02.cleardb.net","bfb0d61ccbcfdd","76448f94", "heroku_f9c5d8662f884a1") or die ("���������� ������������ � �������");
  mysqli_query($conn, "SET NAMES cp1251");

  define('FPDF_FONTPATH',"../../fpdf/font/");
  require("../../fpdf/fpdf.php");
  
  $pdf = new FPDF();
  $pdf -> AddPage();
 
  $pdf -> AddFont("Arial", "", "arial.php");
  $pdf -> SetFont("Arial", "", "18");

  $pdf -> Cell(125, 10, "������", 1, 1, "C");

  $pdf -> SetFont("Arial", "", "8");

  $pdf -> Cell(5, 5, "�", 1, 0, "C");
  $pdf -> Cell(20, 5, "������������ �����", 1, 0, "C");
  $pdf -> Cell(15, 5, "������", 1, 0, "C");
  $pdf -> Cell(20, 5, "����� ����������", 1, 0, "C");
  $pdf -> Cell(20, 5, "�������� ���������", 1, 0, "C");
  $pdf -> Cell(15, 5, "% �������", 1, 0, "C");
  $pdf -> Cell(30, 5, "����� ���� ������� ������ ����", 1, 1, "C");

  $pdf -> SetFont("Arial", "", "6");

  $query = mysqli_query($conn, "SELECT * FROM bank");
  for($i = 1; $fetch_bank = mysqli_fetch_array($query); $i++) {
    $id_bank = $fetch_bank["id"];
    $name_bank = $fetch_bank["name"];
    $country = $fetch_bank["country"];
    $type = $fetch_bank["type"];
    $price = $fetch_bank["price"];

    $query_deposit = mysqli_query($conn, "SELECT * FROM deposit WHERE id_bank = '" . $id_bank . "'");
    if($fetch_bank = mysqli_fetch_array($query_deposit)) {
      $name_deposit = $fetch_deposit["name"];
      $proc = $fetch_deposit["proc"];
    }
   
    $query_invest = mysqli_query($conn, "SELECT SUM(price) AS price_sum FROM invest WHERE id_deposit = '" . $id_deposit . "'");
    if($fetch_deposit = mysqli_fetch_array($query_deposit)) {
      $price_sum = $fetch_deposit["price_sum"];
    }

    $pdf -> Cell(5, 5, $i, 1, 0, "C");
    $pdf -> Cell(20, 5, $name_bank, 1, 0, "C");
    $pdf -> Cell(15, 5, $country, 1, 0, "C");
    $pdf -> Cell(20, 5, $type, 1, 0, "C");
    $pdf -> Cell(20, 5, $name_deposit, 1, 0, "C");
    $pdf -> Cell(15, 5, $proc, 1, 0, "C");
    $pdf -> Cell(30, 5, $price_sum, 1, 1, "C");
}

$pdf -> Output("sadykov_3.pdf", "D");
?>