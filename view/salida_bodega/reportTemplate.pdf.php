<?php
use mvc\routing\routingClass as routing;
$id = salidaBodegaTableClass::ID;
$fecha = salidaBodegaTableClass::FECHA;
$id_trabajador = salidaBodegaTableClass::ID_TRABAJADOR;



$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),90,8,70);

$pdf ->Ln(50);

$pdf->Cell(215,10,'SALIDA BODEGA',1,1,'C');




  $pdf->Cell(40,10,  utf8_decode("ID"),1);
  $pdf->Cell(45,10,  utf8_decode("FECHA "),1);
  $pdf->Cell(50,10,  utf8_decode("ID_TRABAJADOR"),1);
  
  $pdf->Ln();
foreach ($objSalidaBodega as $salidaBodega){
  
  $pdf->Cell(40,10,  utf8_decode($salidaBodega->id),1);
  $pdf->Cell(45,10,  utf8_decode($salidaBodega->fecha),1);
  $pdf->Cell(50,10,  utf8_decode($salidaBodega->id_trabajador),1);
  
  $pdf ->Ln();
  
}
$pdf->Output();
?>