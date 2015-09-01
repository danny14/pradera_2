<?php
use mvc\routing\routingClass as routing;
$id = ordennoTableClass::ID;
$fecha_ordenno = ordennoTableClass::FECHA_ORDENNO;
$cantidad_leche = ordennoTableClass::CANTIDAD_LECHE;
$id_trabajador = ordennoTableClass::ID_TRABAJADOR;
$id_animal = ordennoTableClass::ID_ANIMAL;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,90);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),120,0,'C');

$pdf ->Ln(50);

$pdf->Cell(255,10,'ORDENNO',1,1,'C');




  $pdf->Cell(15,10,  utf8_decode("ID"),1);
  $pdf->Cell(30,10,  utf8_decode("FECHA_ORDENNO"),1);
  $pdf->Cell(40,10,  utf8_decode("CANTIDAD_LECHE"),1);
  $pdf->Cell(50,10,  utf8_decode("ID_TRABAJADOR"),1);
  $pdf->Cell(40,10,  utf8_decode("ID_ANIMAL"),1);
  $pdf->Ln();
  
foreach ($objOrdenno as $ordenno){
  $pdf->Cell(15,10,  utf8_decode($ordenno->$id),1);
  $pdf->Cell(30,10,  utf8_decode($ordenno->$fecha_ordenno),1);
  $pdf->Cell(40,10,  utf8_decode($ordenno->$cantidad_leche),1);
  $pdf->Cell(50,10,  utf8_decode($ordenno->$id_trabajador),1);
  $pdf->Cell(40,10,  utf8_decode($ordenno->$id_animal),1);
  $pdf->Ln();
  
}
$pdf->Output();
?>



