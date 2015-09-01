<?php
use mvc\routing\routingClass as routing;
$id = salidaBodegaTableClass::ID;
$fecha = salidaBodegaTableClass::FECHA;
$id_trabajador = salidaBodegaTableClass::ID_TRABAJADOR;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,90);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),120,0,'C');

$pdf ->Ln(50);

$pdf->Cell(0,10,'SALIDA BODEGA',1,1,'C');


  $pdf ->Ln();
  $pdf->Cell(80,10,  utf8_decode("FECHA REGISTRO "),1);
  $pdf->Cell(180,10,  utf8_decode("TRABAJADOR DE TURNO"),1);
  
  $pdf ->Ln();
foreach ($objSalidaBodega as $salida_bodega){
  
  
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(80,10,  utf8_decode($salida_bodega->fecha),1);
  $pdf->Cell(180,10,  utf8_decode(salidaBodegaTableClass::getNameFieldForaneaTrabajador($salida_bodega->id_trabajador)),1);
  
  $pdf ->Ln();
  
}
$pdf->Output();
?>