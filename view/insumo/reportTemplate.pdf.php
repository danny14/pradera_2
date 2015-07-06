<?php
use mvc\routing\routingClass as routing;
$id = insumoTableClass::ID;
$nombre = insumoTableClass::NOMBRE;
$fecha_fabricacion = insumoTableClass::FECHA_FABRICACION;
$fecha_vencimiento = insumoTableClass::FECHA_VENCIMIENTO;
$valor = insumoTableClass::VALOR;
$id_tipo_insumo = insumoTableClass::ID_TIPO_INSUMO;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),90,8,70);

$pdf ->Ln(50);

$pdf->Cell(255,10,'INSUMO',1,1,'C');




  $pdf->Cell(40,10,  utf8_decode("ID"),1);
  $pdf->Cell(45,10,  utf8_decode("NOMBRE"),1);
  $pdf->Cell(40,10,  utf8_decode("FECHA_FABRICACION"),1);
  $pdf->Cell(50,10,  utf8_decode("FECHA_VENCIMIENTO"),1);
  $pdf->Cell(40,10,  utf8_decode("VALOR"),1);
  $pdf->Cell(40,10,  utf8_decode("ID_TIPO_INSUMO"),1);
  $pdf->Ln();
  
foreach ($objInsumo as $insumo){
  $pdf->Cell(40,10,  utf8_decode($insumo->$id),1);
  $pdf->Cell(45,10,  utf8_decode($insumo->$nombre),1);
  $pdf->Cell(40,10,  utf8_decode($insumo->$fecha_fabricacion),1);
  $pdf->Cell(50,10,  utf8_decode($insumo->$fecha_vencimiento),1);
  $pdf->Cell(40,10,  utf8_decode($insumo->$valor),1);
  $pdf->Cell(40,10,  utf8_decode($insumo->$id_tipo_insumo),1);
  $pdf->Ln();
  
}
$pdf->Output();
?>



