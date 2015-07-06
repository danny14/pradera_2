<?php
use mvc\routing\routingClass as routing;
$id = tipo_insumoTableClass::ID;
$nombre = tipo_insumoTableClass::DESCRIPCION;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),90,8,70);

$pdf ->Ln(50);

$pdf->Cell(255,10,'TIPO_INSUMO',1,1,'C');




  $pdf->Cell(40,10,  utf8_decode("ID"),1);
  $pdf->Cell(45,10,  utf8_decode("DESCRIPCION"),1);

  $pdf->Ln();
  
foreach ($objTipo_insumo as $tipo_insumo){
  $pdf->Cell(40,10,  utf8_decode($tipo_insumo->$id),1);
  $pdf->Cell(45,10,  utf8_decode($tipo_insumo->$descripcion),1);

  $pdf->Ln();
  
}
$pdf->Output();
?>



