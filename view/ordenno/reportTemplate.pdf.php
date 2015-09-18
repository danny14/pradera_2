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
//$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,85);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),110,0,'C');

$pdf ->Ln(50);
$pdf->SetFillColor(175,238,238);
$pdf->Cell(255,10,'ORDENNO',1,1,'C',true);


  $pdf->Cell(60,10,  utf8_decode("FECHA_ORDENNO"),1,0,'C',true);
  $pdf->Cell(48,10,  utf8_decode("CANTIDAD_LECHE"),1,0,'C',true);
  $pdf->Cell(80,10,  utf8_decode("TRABAJADOR"),1,0,'C',true);
  $pdf->Cell(65,10,  utf8_decode("ANIMAL"),1,0,'C',true);
  $pdf->Ln();
  
foreach ($objOrdenno as $ordenno){
  $pdf->Cell(60,10,  utf8_decode($ordenno->$fecha_ordenno),1);
  $pdf->Cell(48,10,  utf8_decode($ordenno->$cantidad_leche),1);
  $pdf->Cell(80,10,  utf8_decode(ordennoTableClass::getNameFieldForaneaTrabajador($ordenno->$id_trabajador)),1);
  $pdf->Cell(65,10,  utf8_decode(ordennoTableClass::getNameFieldForaneaAnimal($ordenno->$id_animal)),1);
  $pdf->Ln();
  
}
$pdf->Output();
?>



