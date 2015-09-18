<?php
use mvc\routing\routingClass as routing;
$id = tipo_insumoTableClass::ID;
$nombre = tipo_insumoTableClass::DESCRIPCION;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,85);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),120,0,'C');

$pdf->Ln(50);
$pdf->SetFillColor(175,238,238);
$pdf->Cell(255,10,'TIPO_INSUMO',1,1,'C',true);




  $pdf->Cell(40,10,  utf8_decode("ID"),1,0,'C',true);
  $pdf->Cell(45,10,  utf8_decode("DESCRIPCION"),1,0,'C',true);

  $pdf->Ln();
  
foreach ($objTipo_insumo as $tipo_insumo){
  $pdf->Cell(40,10,  utf8_decode($tipo_insumo->$id),1);
  $pdf->Cell(45,10,  utf8_decode($tipo_insumo->$descripcion),1);

  $pdf->Ln();
  
}
$pdf->Output();
?>



