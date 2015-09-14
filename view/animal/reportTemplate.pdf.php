<?php
use mvc\routing\routingClass as routing;

$id = animalTableClass::ID;
$nombre = animalTableClass::NOMBRE;
$genero = animalTableClass::GENERO;
$peso = animalTableClass::PESO;
$fecha_ingreso = animalTableClass::FECHA_INGRESO;
$numero_partos = animalTableClass::NUMERO_PARTOS;
$id_raza = animalTableClass::ID_RAZA;
$id_estado = animalTableClass::ID_ESTADO;




$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,85);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),120,0,'C');

$pdf ->Ln(50);
$pdf->SetFillColor(175,238,238);
$pdf->Cell(255,10,'ANIMAL',1,1,'C',true);




  $pdf->Cell(40,10,  utf8_decode("NOMBRE"),1,0,'C',TRUE);
  $pdf->Cell(20,10,  utf8_decode("GENERO"),1,0,'C',TRUE);
  $pdf->Cell(30,10,  utf8_decode("PESO"),1,0,'C',TRUE);
  $pdf->Cell(43,10,  utf8_decode("FECHA_INGRESO"),1,0,'C',TRUE);
  $pdf->Cell(45,10,  utf8_decode("NUMERO_PARTOS"),1,0,'C',TRUE);
  $pdf->Cell(45,10,  utf8_decode("RAZA"),1,0,'C',TRUE);
  $pdf->Cell(30,10,  utf8_decode("ESTADO"),1,0,'C',TRUE);
  $pdf->Ln();
foreach ($objAnimal as $animal){
  $pdf->Cell(40,10,  utf8_decode($animal->$nombre),1);
  $pdf->Cell(30,10,  utf8_decode($animal->$genero),1);
  $pdf->Cell(20,10,  utf8_decode($animal->$peso),1);
  $pdf->Cell(43,10,  utf8_decode($animal->$fecha_ingreso),1);
  $pdf->Cell(45,10,  utf8_decode($animal->$numero_partos),1);
  $pdf->Cell(45,10,  utf8_decode(animalTableClass::getNameFieldForaneaRaza($animal->$id_raza)),1);
  $pdf->Cell(30,10,  utf8_decode(animalTableClass::getNameFieldForaneaEstado($animal->$id_estado)),1);
  
  
  
  $pdf ->Ln();
  
  
}
$pdf->Output();

?>

