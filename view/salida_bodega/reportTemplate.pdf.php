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

$pdf->Cell(110,10,'SALIDA BODEGA',1,1,'C');




  $pdf->Cell(20,10,  utf8_decode("ID"),1);
  $pdf->Cell(35,10,  utf8_decode("FECHA "),1);
  $pdf->Cell(50,10,  utf8_decode("ID_TRABAJADOR"),1);
  
  $pdf->Ln();
foreach ($objSalidaBodega as $reporteParto){
  
  $pdf->Cell(20,10,  utf8_decode($reporteParto->id),1);
  $pdf->Cell(35,10,  utf8_decode($reporteParto->fecha),1);
  $pdf->Cell(50,10,  utf8_decode($reporteParto->id_trabajador),1);
  
  $pdf ->Ln();
  
}
$pdf->Output();
?>